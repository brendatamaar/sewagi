<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\User;
use App\Models\ScheduleTour;
use App\Models\ScheduleTourOption;
use App\Models\Notification;
use App\Models\PropertyDetailView;
use App\Models\Amenity;
use App\Models\Bedroom;
use App\Models\Style;
use App\Models\Facility;
use App\Models\PropertyPhoto;
use App\Models\PropertyStyle;
use App\Models\PropertyAmenity;
use App\Models\PropertyFacility;
use App\Models\PhotoType;
use App\Models\PropertyPrice;
use App\Models\PropertyPriceDetail;
use App\Http\Requests\ScheduleTourRequest;
use App\Notifications\EmailScheduleTour;
use App\Models\BookNow;
use App\Http\Requests\BookNowRequest;
use App\Notifications\EmailBookNow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use Wablas\WablasClient;
use DB;
class PropertyController extends Controller
{
    private $photos_path;

    public function __construct(
        Property $property,
        ScheduleTour $scheduleTour,
        ScheduleTourOption $scheduleTourOption,
        User $user,
        Amenity $amenity,
        Bedroom $bedroom,
        Style $style,
        Facility $facility,
        PropertyStyle $propertyStyle,
        PropertyAmenity $propertyAmenity,
        PropertyFacility $propertyFacility,
        PhotoType $photoType,
        PropertyPhoto $propertyPhoto,
        PropertyPrice $propertyPrice,
        PropertyPriceDetail $propertyPriceDetail,
        PropertyDetailView $propertyDetailView,
        Notification $notification,
        BookNow $bookNow)
    {
        $this->property = $property;
        $this->scheduleTour = $scheduleTour;
        $this->scheduleTourOption = $scheduleTourOption;
        $this->propertyDetailView = $propertyDetailView;
        $this->user = $user;
        $this->amenity = $amenity;
        $this->bedroom = $bedroom;
        $this->style = $style;
        $this->facility = $facility;
        $this->propertyPhoto = $propertyPhoto;
        $this->propertyStyle = $propertyStyle;
        $this->propertyAmenity= $propertyAmenity;
        $this->propertyFacility = $propertyFacility;
        $this->notification = $notification;
        $this->photoType = $photoType;
        $this->propertyPrice =$propertyPrice;
        $this->propertyPriceDetail = $propertyPriceDetail;
        $this->bookNow = $bookNow;
    }

    public function detail($id)
    {
        if($user = Auth::user()){
            $check = $this->propertyDetailView->where('user_id',$user->id)->where('property_id',$id)->first();

            if(is_null($check)){
                $data['user_id'] = $user->id;
                $data['property_id'] = $id;
                $data['count'] = 1;
                $save = $this->propertyDetailView->createNew($data);
            }else{
                $check->count += 1;
                $check->save();
            }
        }
        $detail = $this->property->find($id);
        $sliderImages = array();
        $totalPhoto = 0;
        $types = array();

        if(!is_null($detail->photos) && count($detail->photos)>0){
            $totalPhoto = count($detail->photos[0]->medium_images);
            $sliderImages = $detail->photos[0]->medium_images;

            foreach($sliderImages as $key => $val){
                if(!in_array($val->imagable->name,$types))
                    $types[] = $val->imagable->name;
            }
        }
        $similarListing = $this->property->with('photos.thumb_images')->where('district', $detail->district)->where('type', $detail->type)->where('id','!=', $id)->get();

        $length = array();
        foreach($detail->priceDetail as $val){
            if(!in_array($val->length,$length)){
                $length[] = $val->length;
            }
        }

        $bedroomPhoto = array();
        foreach($detail->bedroom as $key => $value){
            foreach($detail->bedroom[$key]->photos as $k => $v){
                $bedroomPhoto = $detail->bedroom[$key]->photos[$k]->thumb_images;
                //foreach($detail->bedroom[$key]->photos[$k]->thumb_images as $val){
                    //var_dump($val);
                //}
            }
        }
        asort($length);
        //var_dump($detail->bedroom);die();
        return view('property.detail', compact('detail','totalPhoto','sliderImages','types','similarListing','length','bedroomPhoto'));
    }

    public function getBedroomPrice(Request $request)
    {
        try {
            $bedroom = explode("-",$request->bedroom_id);
            $bedroom_id = $bedroom[0];

            if($request->bedroom_id){
                $price = $this->propertyPriceDetail->where('property_id',$request->property_id)->where('bedroom_id',$bedroom_id)->where('length',$request->length)->get();
            }else{
                $price = $this->propertyPriceDetail->where('property_id',$request->property_id)->where('living_cond','entire_space')->where('length',$request->length)->get();
            }

            return response()->json([
                'status' => true,
                'data' => $price,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
    public function getLengthOfStay(Request $request)
    {
        try {
            if($request->living_type == 'co-living'){
                $length = $this->propertyPriceDetail->select('length')->where('property_id',$request->property_id)->where('living_cond',$request->living_type)->get();
            }else{
                $living_type = 'entire_space';
                $length = $this->propertyPriceDetail->select('length')->where('property_id',$request->property_id)->where('living_cond',$living_type)->get();
            }

            $arrLength = array();
            foreach($length as $val){
                if(!in_array($val->length,$arrLength)){
                    $arrLength[] = $val->length;
                }
            }
            sort($arrLength);
            return response()->json([
                'status' => true,
                'data' => $arrLength,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
    public function getBedroomType(Request $request)
    {
        try {
            if($request->living_type == 'co-living'){
                $bedrooms = DB::table('property_price_details')
                            ->join('bedrooms','property_price_details.bedroom_id','=','bedrooms.id')
                            ->join('bedroom_variants','bedrooms.id','=','bedroom_variants.bedroom_id')
                            ->select('bedrooms.name','bedrooms.id','property_price_details.paid_monthly')
                            ->where('property_price_details.property_id',$request->property_id)
                            ->where('property_price_details.living_cond',$request->living_type)
                            ->where('property_price_details.length',$request->length_stay)
                            ->where('bedroom_variants.is_active','=',1)
                            ->where('bedrooms.quantity_available','>',0)
                            ->get();

                $name = array();
                $bedroomArr = array();

                foreach($bedrooms as $val){
                    if(!in_array($val->name, $name)){
                        $bedroomArr[] = $val;
                        $name[] = $val->name;
                    }
                }
                usort($bedroomArr, function($a, $b) {
                    return $a->paid_monthly <=> $b->paid_monthly;
                });

                return response()->json([
                    'status' => true,
                    'data' => $bedroomArr,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
    public function scheduleTours(ScheduleTourRequest $request)
    {
        try {
            $schedule = $this->scheduleTour->createNew($request);

            foreach($request->time as $value){
                $time = date("Y-m-d H:i:s",strtotime($value));
                $this->scheduleTourOption->schedule_tour_id = $schedule->id;
                $this->scheduleTourOption->time = $time;

                $scheduleOption = $this->scheduleTourOption->createNew($this->scheduleTourOption);
            }

            $property = $this->property->find($schedule->property_id);

            $users = $this->user->whereIn('id',[$property->user_id,2])->get();
            $schedule = $this->scheduleTour->find($schedule->id);
            $notify = array();

            foreach($users as $user){
                $schedule->notify(new EmailScheduleTour($user));

                $notify[] = new Notification(array(
                    'from_user_id' => $request->user_id,
                    'to_user_id' => $user->id,
                    'type' => 'test',
                    'subject' => 'subject',
                    'message' => 'message',
                ));

                $apiToken = "QhdsWwXexjOK9DP29xN5W5s6nn7y4MPmYefXKV3ipZuShPmKX9HjzND9YS3gBK5z";
                $wablasClient = new WablasClient($apiToken);

                $wablasClient->addRecipient($user->phone_number);

                $message = 'type your message here.';
                $wablasClient->sendMessage($message);
            }
            $schedule->notif()->saveMany($notify);

            return response()->json([
                'status' => true,
                'message' => 'test'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function instantBooking(BookNowRequest $request)
    {
        try {
            $bookNow = $this->bookNow->createNew($request);

            $property = $this->property->find($bookNow->property_id);

            $users = $this->user->whereIn('id',[$bookNow->user_id,2])->get();
            $bookNow = $this->bookNow->find($bookNow->id);
            $notify = array();

            foreach($users as $user){
                $bookNow->notify(new EmailBookNow($user));

                $notify[] = new Notification(array(
                    'from_user_id' => $request->user_id,
                    'to_user_id' => $user->id,
                    'type' => 'test',
                    'subject' => 'subject',
                    'message' => 'message',
                ));

                $apiToken = "QhdsWwXexjOK9DP29xN5W5s6nn7y4MPmYefXKV3ipZuShPmKX9HjzND9YS3gBK5z";
                $wablasClient = new WablasClient($apiToken);

                $wablasClient->addRecipient($user->phone_number);

                $message = 'type your message here.';
                $wablasClient->sendMessage($message);
            }
            $bookNow->notif()->saveMany($notify);

            return response()->json([
                'status' => true,
                'message' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function create(Request $request, $step) {
        if(!Auth::user()){
            $request->session()->flash('error-login');
            return redirect()->back();
        } else {
            $propertyId = $request->id || session('property_id');
            if ($request->id){
                $property = Property::find($request->id);
            }
            elseif (session('property_id')){
                $property = Property::find(session('property_id'));
            }

            $reviewPropertyTypeLivingCondition = false;
            $reviewBedroomBathroom = false;
            $reviewLocation = false;
            $reviewDescriptionHouseRules = false;
            $reviewAmenitiesFacilities = false;
            $reviewPhotos = false;
            $reviewLegalDetails = false;
            $reviewPaymentPreferenceForCoLiving = false;

            if (!isset($property)){
                $property = new Property;
                // if ($step > 1){
                //     return redirect('/add-property/1');
                // }
            }
            else{
                if(Auth::user()->id == $property->user_id){
                    if ($property->type != '' && ($property->is_co_living == 1 || $property->is_co_living == 1)){
                        $reviewPropertyTypeLivingCondition = true;
                    }
                    if ($property->bedrooms > 0 && $property->bathrooms > 0){
                        $reviewBedroomBathroom = true;
                    }
                    if (!empty($property->address)){
                        $reviewBedroomBathroom = true;
                    }
                    if (!empty($property->address)){
                        $reviewLocation = true;
                    }
                    if (!empty($property->description)){
                        $reviewDescriptionHouseRules = true;
                    }
                    if ($property->amenities->count() > 0 && $property->facilities->count() > 0){
                        $reviewAmenitiesFacilities = true;
                    }
                    if ($property->photos->count() > 0){
                        $reviewPhotos = true;
                    }
                    if (!empty($property->belong_to)){
                        $reviewLegalDetails = 1;
                    }
                    if ($property->propertyPrice->count() > 0){
                        $reviewPaymentPreferenceForCoLiving = true;
                    }
                }
                else{
                    return redirect('/add-property/1');
                }
            }

            $data = array(
                'step'                              => $step,
                'amenityList'                       => $this->amenity->where('entity', 'bedroom')->get(),
                'bedroomAmenity'                    => $this->amenity->where('entity', 'bedroom')->get(),
                'propertyAmenity'                   => $this->amenity->where('entity', 'property')->get(),
                'style'                             => $this->style->all(),
                'facility'                          => $this->facility->all(),
                'property'                          => $property,
                'reviewPropertyTypeLivingCondition' => $reviewPropertyTypeLivingCondition,
                'reviewBedroomBathroom'             => $reviewBedroomBathroom,
                'reviewLocation'                    => $reviewLocation,
                'reviewDescriptionHouseRules'       => $reviewDescriptionHouseRules,
                'reviewAmenitiesFacilities'         => $reviewAmenitiesFacilities,
                'reviewPhotos'                      => $reviewPhotos,
                'reviewLegalDetails'                => $reviewLegalDetails,
                'reviewPaymentPreferenceForCoLiving'=> $reviewPaymentPreferenceForCoLiving
            );
        }
        return view('property.create')->with($data);
    }

    public function store($step, Request $request){
        $userId = Auth::user();
        if($userId){
            $userId = Auth::User()->id;
        } else{
            return response()->json($data);
        }
        switch ($step) {
            case 1:
                if($request->type && ($request->unit_size || $request->building_size) && ($request->is_co_living || $request->is_entire_space)){
                    $obj = $this->property->saveData($request->all(), $step, $userId);
                    return redirect('/add-property/2')->with('property_id', $obj->id);
                } else {
                    return redirect('/add-property/1');
                }
                break;
            case 2:
                $bedroom = $this->bedroom->massCreate($request->all());
                $prop = $this->property->saveData($request->all(), $step, $userId);
                return redirect('/add-property/3')->with('property_id', $request->property_id);
                break;
            case 3:
                if($request->property_address && $request->property_number && $request->property_details && $request->city && $request->district && $request->post_code && $request->latitude && $request->longitude && $request->village && $request->province){
                    $obj = $this->property->saveData($request->all(), $step, $userId);
                }
                return redirect('/add-property/4')->with('property_id', $request->property_id);
                break;
            case 4:
                $input_style= $this->propertyStyle->createNew($request->all());
                if($request->title && $request->description && $request->land_area_type && $request->arrangement && $request->floor_range){
                    $obj = $this->property->saveData($request->all(), $step, $userId);
                    $data['status'] = true;
                }
                return redirect('/add-property/5')->with('property_id', $obj->id);
                break;
            case 5:
                $input_amenity= $this->propertyAmenity->createNew($request->all());
                $input_facility= $this->propertyFacility->createNew($request->all());
                if($request){
                    $obj = $this->property->saveData($request->all(), $step, $userId);
                    $data['status'] = true;
                }
                return redirect('/add-property/6')->with('property_id', $obj->id);
                break;
            case 6:
                // $file = $request->file('file');

                // $extension = File::extension($file['name']);
                // $directory = path('public').'uploads/'.sha1(time());
                // $filename = sha1(time().time()).".{$extension}";

                // $upload_success = propertyPhoto::upload('file', $directory, $filename);

                // if( $upload_success ) {
                //     return Response::json('success', 200);
                // } else {
                //     return Response::json('error', 400);
                // }
                return response()->json([
                    'request' => $request
                ]);
                return redirect('/add-property/7')->with('property_id', $obj->id);
                break;
            case 7:
                if($request){
                    $obj = $this->property->saveData($request->all(), $step, $userId);
                }
                if ($obj->is_entire_space == 1){
                    return redirect('/add-property/8')->with('property_id', $obj->id);
                }
                else{
                    return redirect('/add-property/9')->with('property_id', $obj->id);
                }
                break;
            case 8:
                $bedroom = bedroom::where('property_id', $request->property_id)->get();
                $living_condition = "co-living";
                if($request){
                    $inputPrice = $this->propertyPrice->createNew($request->all(),$living_condition);
                    $inputPriceDetail = $this->propertyPriceDetail->createNew($request->all());
                }
                if ($inputPrice->is_co_living == 1){
                    return redirect('/add-property/9')->with('property_id', $request->property_id);
                }
                else{
                    return redirect('/add-property/10')->with('property_id', $request->property_id);
                }
                break;
            case 9:
                $bedroom = bedroom::where('property_id', $request->property_id)->get();
                $living_condition = "entire-space";
                if($request){
                    $inputPrice = $this->propertyPrice->createNew($request->all(),$living_condition);
                    $inputPriceDetail = $this->propertyPriceDetail->createNew($request->all());
                }
                return redirect('/add-property/10')->with('property_id', $request->property_id);
                break;
            case 8:
                dd($request);
                break;
            default:
                return redirect('/add-property/1');
        }
    }
}
