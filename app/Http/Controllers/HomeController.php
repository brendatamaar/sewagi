<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterCommunityRequest;
use App\Models\Community;
use App\Models\PageTitle;
use App\Models\ClientReview;
use App\Models\WorkingField;
use App\Models\Property;
use App\Models\Locale;
use App\Models\PropertyRequest;
use Cookie;
use Session;
class HomeController extends Controller
{

    public function __construct(PageTitle $pageTitle,Community $community, WorkingField $workingField, Property $property, PropertyRequest $propertyRequest, Locale $locale) {
        $this->pageTitle = $pageTitle;
        $this->community = $community;
        $this->workingField = $workingField;
        $this->property = $property;
        $this->locale = $locale;
        $this->propertyRequest = $propertyRequest;
    }

    public function setLang($locale){
        Session::put('locale', $locale);
        return redirect()->back();
    }

    public function index()
    {
        $pageTitle = $this->pageTitle->getRandom('homepage');

        $background = randomBackground('img/background/homepage');
        $reviews = ClientReview::getAll();
        $featured = $this->property->with('photos.thumb_images')->whereIsFeatured(true)->get();

        return view('homepage.index', compact('pageTitle', 'background','reviews','featured'));
    }

    public function setCookie() {
        Cookie::queue(Cookie::forever('cookie-policy', true));
        return response()->json([
            'status' => true
        ]);
    }

    public function getCookie(Request $request) {
        $value = $request->cookie('cookie-policy');
        if(isset($value)){
            $data = ['status' => true];
        } else {
            $data = ['status' => false];
        }
        return response()->json($data);
    }

    public function sendPropertyRequest(Request $request)
    {
        $data = [
            'status' => true
        ];

        if (! $this->propertyRequest->createNew($request->all())) {
            $data = [
                'status' => false,
            ];
        }

        return response()->json($data);
    }

    public function registerCommunity(RegisterCommunityRequest $request)
    {
        try {
            $community = $this->community->createNew($request);
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

    public function showing_agent() {
        $data = [];
        $locale = $this->locale->getLocaleByPage('home');

        $background = randomBackground('img/background/showing-agent/');

        return view('working.showing_agent', $data, compact('locale', 'background'));
    }

    public function company_client() {
        $data = [];
        $locale = $this->locale->getLocaleByPage('home');
        $locale_modalbox = $this->locale->getLocaleByPage('_partials/modalbox');
        $locale_footer = $this->locale->getLocaleByPage('_partials/footer');
        $locale_recommend = $this->locale->getLocaleByPage('working/recommend_us');
        $locale_question = $this->locale->getLocaleByPage('working/question');
        $locale_question = $this->locale->getLocaleByPage('working/question');
        $locale_company_client = $this->locale->getLocaleByPage('working/company_client');

        $background = randomBackground('img/background/company-client/');

        return view('working.company_client', $data, compact('locale_company_client', 'locale', 'locale_modalbox', 'locale_footer', 'locale_recommend', 'locale_question', 'background'));
    }

    public function homeowner() {
        $pageTitle = $this->pageTitle->getRandom('property-lister-homeowner');

        $locale = $this->locale->getLocaleByPage('home');
        $background = randomBackground('img/background/homeowner/');
        $page = 'homeowner';

        return view('property.index', compact('pageTitle', 'background','page', 'locale'));
    }

    public function property_agent() {
        $pageTitle = $this->pageTitle->getRandom('property-lister-property-agent');

        $locale = $this->locale->getLocaleByPage('home');
        $background = randomBackground('img/background/property-agent/');

        $page = 'agent';

        return view('property.index', compact('pageTitle', 'background','page', 'locale'));
    }

    public function building_management() {
        $pageTitle = $this->pageTitle->getRandom('property-lister-building-management');

        $locale = $this->locale->getLocaleByPage('home');
        $background = randomBackground('img/background/building-management/');

        $page = 'building-management';

        return view('property.index', compact('pageTitle', 'background','page', 'locale'));
    }

    public function housemate() {
        $pageTitle = $this->pageTitle->getRandom('property-lister-housemate');

        $locale = $this->locale->getLocaleByPage('home');
        $background = randomBackground('img/background/housemate/');

        $page = 'housemate';

        return view('property.index', compact('pageTitle', 'background','page', 'locale'));
    }
}
