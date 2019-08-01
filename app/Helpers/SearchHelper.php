<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use GooglePlaces;
use App\Helpers\OpenRouteService;

class SearchHelper
{
    protected $request;
    protected $url;
    public $data = [
        'living_cond' => [],
        'type'        => [],
        'location'    => [],
        'place_id'    => null,
        'place_name'  => null,
        'keyword' => null,
        'page' => 1,
        'price' => [],
        'bedroom' => [],
        'maps' => null,
        'move_map' => false,
        'open_commute_filter' => false,
        'more_filter' => []
    ];

    public function generate($request)
    {
        $this->setParams($request);
        $this->buildUrl();
        return;
    }

    public function buildUrl()
    {
        $data = $this->data;
        $arrUri[] = 'search';
        $params = [];
        if (!empty($data['living_cond'])) {
            $arrUri[] = "for-".implode('+', $data['living_cond']);
        }
        if (!empty($data['type'])) {
            $arrUri[] = "type-".implode('+', $data['type']);
        }
        if (!empty($data['price'])) {
            $params['min_price'] = $data['price'][0];
            $params['max_price'] = $data['price'][1];
        }
        if (!empty($data['place_id'])) {
            $params['id'] = $data['place_id'];
        }
        if (!empty($data['commute_type'])) {
            $params['commute_type'] = $data['commute_type'];
        }
        if (!empty($data['time'])) {
            $params['time'] = $data['time'];
        }
        if (!empty($data['nearme'])) {
            $params['nearme'] = $data['nearme'];
        }
        if (!empty($data['keyword'])) {
            $params['q'] = $data['keyword'];
        }
        if (!empty($data['page'])) {
            $params['page'] = $data['page'];
        }
        if (!empty($data['bedroom'])) {
            $params['bedroom'] = implode(',', $data['bedroom']);
        }
        if (!empty($data['maps'])) {
            $params['maps'] = $data['maps'];
        }
        if (!empty($data['commute_detail'])) {
            $params['open_commute_filter'] = true;
        }

        $url = implode('/', $arrUri);
        $url .= (!empty($params)) ? "?".http_build_query($params) : "";
        $this->url = $url;
        return;
    }

    public function readUrl($request)
    {
        $segments = $request->segments();
        foreach ($segments as $segment) {
            $slices = explode('-', $segment);
            $key    = array_shift($slices);
            $values = implode('-', $slices);
            switch ($key) {
                case 'for':
                    $this->data['living_cond'] = explode('+', $values);
                    break;
                case 'type':
                    $this->data['type'] = explode('+', $values);
                    break;
            }
        }
        if ($request->has('open_commute_filter')) {
            $this->data['open_commute_filter'] = $request->open_commute_filter;
            $this->filterOpenCommuteFilter($request);
        }
        if ($request->has('q')) {
            $this->data['keyword'] = $request->q;
        }
        if ($request->has('id')) {
            $this->data['place_id'] = $request->id;
        }
        if ($request->has('page')) {
            $this->data['page'] = $request->page;
        }
        if ($request->has('min_price')) {
            $this->data['price'][0] = $request->min_price;
        }
        if ($request->has('max_price')) {
            $this->data['price'][1] = $request->max_price;
        }
        if ($request->has('id')) {
            $this->data['place_id'] = $request->id;
            $this->filterPlaceDetail($request->id);
        }
        if ($request->has('bedroom')) {
            $this->data['bedroom'] = explode(',', $request->bedroom);
        }
        if ($request->has('time') && $request->has('commute_type')) {
            $this->filterCommuteDetail($request);
            $this->data['time'] = $request->time;
            $this->data['commute_type'] = $request->commute_type;
        }
        if ($request->has('maps')) {
            $this->data['maps'] = $request->maps;
        }
        if ($request->has('nearme')) {
            $this->data['nearme'] = $request->nearme;
        }

        return $this->getData();
    }

    public function setParams($request)
    {
        // if ($request->has('open_commute_filter')) {
        //     $this->data['open_commute_filter'] = $request->open_commute_filter;
        //     $this->filterOpenCommuteFilter($request);
        // }
        $this->filterLivingCondition($request);
        $this->filterPropertyType($request);
        $this->filterPriceRange($request);
        $this->filterBedroom($request);
        $this->handleMoreFilter($request);
        if (!empty($request->place_id)) {
            $this->data['place_id'] = $request->place_id;
            $this->filterPlaceDetail($request->place_id);
        }
        if ($request->has('q')) {
            $this->data['keyword'] = $request->q;
        }
        if ($request->has('page')) {
            $this->data['page'] = $request->page;
        }
        if ($request->has('maps')) {
            $this->data['maps'] = $request->maps;
        }
        $this->filterCommuteTime($request);
        if ($request->has('id')) {
            $this->data['place_id'] = $request->id;
            $this->filterPlaceDetail($request->id);
        }
        $this->filterCommuteDetail($request);
        if ($request->has('move_map')) {
            $this->data['move_map'] = $request->move_map;
            $this->data['geocode'] = $request->move_map ? $request->geocode : false;
        }
        if ($request->has('nearme')) {
            $this->data['nearme'] = $request->nearme;
        }
    }

    public function getData()
    {
        return $this->data;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function filterLivingCondition($request)
    {
        if ($request->has('cond_co_living')) {
            $this->data['living_cond'][] = 'co-living';
        }
        if ($request->has('cond_entire_space')) {
            $this->data['living_cond'][] = 'entire-space';
        }
    }

    public function filterPropertyType($request)
    {
        if ($request->has('type_house')) {
            $this->data['type'][] = 'house';
        }
        if ($request->has('type_apartment')) {
            $this->data['type'][] = 'apartment';
        }
    }

    public function filterPlaceName($request)
    {

    }

    public function filterPriceRange($request)
    {
        if ($request->has('min_price')) {
            $this->data['price'][0] = $request->min_price;
        }
        if ($request->has('max_price')) {
            $this->data['price'][1] = $request->max_price;
        }
    }

    public function filterBedroom($request)
    {
        for ($i = 1;$i <= 5;$i++) {
            if ($request->has('bedroom_'.$i)) {
                $this->data['bedroom'][] = $i;
            }
        }
    }

    public function handleMoreFilter($request)
    {
        $this->data['more_filter'] = (object) $request->moreFilter;
    }

    public function filterPlaceDetail($id)
    {
        if (!empty($id)) {
            $data = Cache::rememberForever('google-place:'.$id, function () use ($id) {
                $response = GooglePlaces::placeDetails($id);
                if (!empty($response['result'])) {
                    return $response['result'];
                }
            });
            $this->data['place_detail'] = $data;
        }
    }

    public function filterCommuteTime($request)
    {
        if (!empty($request->is_commute) && !empty($this->data['place_id'])) {
            $this->data['time'] = $request->time;
            $this->data['commute_type'] = $request->commute_type;
        }
    }

    public function filterCommuteDetail($request)
    {
        $is_commute = ($request->is_commute OR $request->open_commute_filter);
        if ($is_commute && !empty($this->data['place_detail']) && !empty($request->time) && !empty($request->commute_type)) {
            $placeDetail = (object)$this->data['place_detail'];
            $placeId = $placeDetail->place_id;
            $time = $request->time;
            $commuteType = $request->commute_type;
            $data = Cache::remember('commute-detail:'.$placeId.':'.$time.':'. $commuteType, 1, function () use ( $placeDetail, $time, $commuteType) {
                $location = $placeDetail->geometry['location'];
                $lat = $location['lat'];
                $lng = $location['lng'];
                $client = new OpenRouteService(compact('lat', 'lng', 'time', 'commuteType'));
                return $client->generate();
            });
            $this->data['commute_detail'] = $data;
        }
    }

    public function filterOpenCommuteFilter($request)
    {
        // $request->merge([
        //     'q' => 'Jakarta, Indonesia',
        //     'time' => 5,
        //     'commute_type' => 'car',
        //     'id' => 'ChIJnUvjRenzaS4RoobX2g-_cVM',
        //     'maps' => 1,
        //     'nearme' => 1,
        // ]);
    }
}
