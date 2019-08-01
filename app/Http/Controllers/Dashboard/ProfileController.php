<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Company;
use App\Models\Language;
use App\Models\LegalDocument;
use App\Models\LocalBank;
use App\Models\Property;
use App\Models\SearchPreferenceOption;
use App\Models\SocialAccount;
use App\Models\User;
use App\Models\UserInformation;
use App\Models\VerificationCode;
use App\Notifications\EmailVerification;
use App\Notifications\SmsVerification;
use App\Helpers\QoalaService;
use Socialite;

class ProfileController extends Controller
{
    public function __construct(
        Country $country,
        Currency $currency,
        Company $company,
        Language $language,
        LegalDocument $legalDocument,
        LocalBank $localBank,
        Property $property,
        SearchPreferenceOption $searchPreferenceOption,
        SocialAccount $socialAccount,
        User $user,
        UserInformation $userInformation)
    {
        $this->company = $company;
        $this->country = $country;
        $this->currency = $currency;
        $this->language = $language;
        $this->legalDocument = $legalDocument;
        $this->localBank = $localBank;
        $this->property = $property;
        $this->searchPreferenceOption = $searchPreferenceOption;
        $this->socialAccount = $socialAccount;
        $this->user = $user;
        $this->userInformation = $userInformation;
    }

    public function profile()
    {
        $uid = auth()->user()->id;
        $user = $this->user->with(['documents', 'informations'])->find($uid);
        $countries = $this->country->get(['id', 'name', 'calling_code', 'flag']);
        $languages = $this->language->get(['id', 'name', 'code']);
        $company = $this->company->find($user->company_id) ?? [];
        $options = $this->searchPreferenceOption->all();
        $banks = $this->localBank->all();
        $countries = $this->country->all();
        $currencies = $this->currency->all();
        $social = $this->socialAccount->whereEmail($user->email)->get();
        $rentedRoom = $this->property->whereUserId($uid)->where('rented_room', '>', 0)->get();
        $enable_delete = count($rentedRoom) < 1 ? true: false;

        return view('user.profile', compact('user', 'countries', 'options', 'languages', 'company', 'banks', 'countries', 'currencies', 'social', 'enable_delete'));
    }

    public function savePhoto(Request $request)
    {
        return $this->user->savePhoto($request->photo, $request->type);
    }

    public function deletePhoto(Request $request, $id)
    {
        $user = auth()->user();
        $user->images()->whereId($id)->delete();

        return response()->json(['status' => true]);
    }

    public function deletePhotoProfile()
    {
        $user = auth()->user();
        $user->images()->where('imagable_id', $user->id)->delete();

        return response()->json(['status' => true]);
    }

    public function saveAdditionalInformation(Request $request)
    {
        return response()->json($this->userInformation->store($request->all()));
    }

    public function update(Request $request)
    {
        return response()->json($this->user->updateProfile($request->all()));
    }

    public function updateEmail(Request $request)
    {
        $user = $this->user->updateProfileEmail($request->all());
        $user->notify(new EmailVerification());

        return response()->json([
            'status' => true,
            'data'   => $user
        ]);
    }

    public function updatePhone(Request $request)
    {
        $user = $this->user->updateProfilePhone($request->all());
        $user->notify(new SmsVerification());

        $verificationCode = VerificationCode::where('user_id', $user->id)->where('type', 'phone')->orderBy('created_at', 'desc')->first();
        return response()->json([
            'status' => true,
            'data' => $user,
            'verification_code' => $verificationCode
        ]);
    }

    public function updatePassword(Request $request)
    {
        return $this->user->updateProfilePassword($request->all());
    }

    public function saveDocument(Request $request)
    {
        return $this->user->saveDocument($request->file, $request->type);
    }

    public function deleteDocument(Request $request, $id)
    {
        $user = auth()->user();
        $user->files()->whereId($id)->delete();

        return response()->json(['status' => true]);
    }

    public function saveLegal(Request $request)
    {
        return response()->json($this->legalDocument->saveData($request->all()));
    }

    public function updateCompany(Request $request)
    {
        return response()->json($this->company->updateData($request->all()));
    }

    public function verifyIdentity(Request $request) 
    {
        $params = ['is_confirmed_identity' => 1];
        $urlIdentity = file_get_contents($request->ktp);
        $identityImg = base64_encode($urlIdentity);
        $urlSeflie = file_get_contents($request->selfie);
        $selfieImg = base64_encode($urlSeflie);

        $verify = new QoalaService('ktp');
        $result = $verify->sendData('ktp', [
            'ktpImageBase64' => $identityImg,
            'ktpSelfieImageBase64' => $selfieImg
        ]);

        if ($result['status']) {
            $params['is_verified_identity'] = 1;
            $params['is_verified_selfie'] = 1;
        }

        $this->user->find(auth()->user()->id)->update($params);

        return response()->json($result);
    }

    public function redirectToProvider($provider)
    {
        $redirectUrl = url("connect/{$provider}/callback");
        return Socialite::driver($provider)
                ->redirectUrl($redirectUrl)
                ->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $redirectUrl = url("connect/{$provider}/callback");
        $credential = Socialite::driver($provider)->redirectUrl($redirectUrl)->user();
        $user = $this->user->findByColumn('email', $credential->email);

        if ($user) $this->socialAccount->saveData($provider, $credential);
        
        return redirect()->route('profile');
    }

    public function deactivateAccount()
    {
        return tap($this->user->find(auth()->user()->id))->update(['is_active' => 0])->fresh();
    }
}
