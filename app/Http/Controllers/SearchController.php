<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Facility;
use App\Models\Locale;
use App\Models\Property;
use App\Models\Style;
use App\Models\SearchPreferenceOption;
use App\Helpers\SearchHelper;

class SearchController extends Controller
{
    private $amenity;
    private $facility;
    private $property;
    private $style;
    private $searchPreferenceOption;

    public function __construct(Amenity $amenity, Facility $facility, Property $property, SearchHelper $searchHelper, Style $style, SearchPreferenceOption $searchPreferenceOption, Locale $locale)
    {
        $this->amenity = $amenity;
        $this->facility = $facility;
        $this->property = $property;
        $this->searchHelper = $searchHelper;
        $this->style = $style;
        $this->searchPreferenceOption = $searchPreferenceOption;
        $this->locale = $locale;
    }

    /**
     * Handle Search from Homepage
     * @param Request $request
     * @return void
     */
    public function doSearch(Request $request)
    {
        $this->searchHelper->generate($request);
        $url = $this->searchHelper->getUrl();
        return redirect($url);
    }

    /**
     * Handle Default Search after redirect - AJAX     *
     * @param Request $request
     * @return void
     */
    public function doSearchAjax(Request $request)
    {
        $search = json_decode($request->search);
        $items = $this->property->ajaxSearch($search);
        $price = $this->property->getMinMaxPrice((object) $search);
        return response()->json(compact('items','price', 'search'));
    }
    
    /**
     * Handle Re filter Search on SearchPage - AJAX
     * @param Request $request
     * @return void
     */
    public function doReSearchAjax(Request $request)
    {
        $this->searchHelper->generate($request);

        // dd($this->searchHelper->data);

        $url  = $this->searchHelper->getUrl();
        $search = $this->searchHelper->getData();

        $items = $this->property->ajaxSearch(json_decode(json_encode($search)));
        $price = $this->property->getMinMaxPrice(json_decode(json_encode($search)));
        return response()->json(compact('url', 'items', 'price', 'search'));
    }
    /**
     * Show Search Result Page
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $this->searchHelper->readUrl($request);
        $search = $this->searchHelper->getData();
        return view('search', compact('search'));
    }

    public function getPrice(Request $request)
    {
        $this->searchHelper->generate($request);
        $search =$this->searchHelper->getData();
        $price = $this->property->getMinMaxPrice((object) $search);
        return response()->json(compact('url', 'price'));
    }

    public function ajax(Request $request)
    {
        return response()->json(['items' => $this->property->ajaxSearch($request->query())]);
    }

    public function getAmenities()
    {
        return response()->json(['items' => $this->amenity->getLocale()]);
    }

    public function getFacilities()
    {
        return response()->json(['items' => $this->facility->getLocale()]);
    }

    public function getStyles()
    {
        return response()->json(['items' => $this->style->getLocale()]);
    }

    public function getSearchOptions()
    {
        return response()->json(['items' => $this->searchPreferenceOption->getLocale()]);
    }
}
