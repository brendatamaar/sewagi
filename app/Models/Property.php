<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ScoutElastic\Searchable;
use App\Indexes\PropertyIndex;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\DataTables\DataTables;
use App\Models\PropertyAmenity;
use App\Models\PropertyFacility;
use App\Models\PropertyStyle;
use App\Models\PropertyDetailView;
use App\Models\RecentSearch;
use App\Traits\Fileable;
use GooglePlaces;
use Cache;

class Property extends Model
{
    use Searchable;
    use SoftDeletes;
    use Fileable;
    use MainModel;

    private $propertyAmenity;
    private $propertyFacility;
    private $propertyStyle;
    private $propertyDetailView;
    private $recentSearch;

    protected $dataTables;
    protected $fillable = [
        'title',
        'description',
        'type',
        'unit_size',
        'building_size',
        'is_co_living',
        'is_entire_space',
        'bedrooms',
        'bathrooms',
        'available_room',
        'rented_room',
        'total_room',
        'estimated_price',
        'land_area_type',
        'arrangement',
        'floor_range',
        'storey',
        'is_pet_friendly',
        'address',
        'property_number',
        'province',
        'property_detail',
        'city',
        'district',
        'village',
        'postcode',
        'latitude',
        'longitude',
        'furniture',
        'belong_to',
        'status',
        'ownership_status',
        'is_insured',
        'is_draft',
        'is_featured',
        'approved_at',
        'user_id'
    ];
    protected $appends = ['location', 'slug_url', 'amenities', 'facilities', 'styles', 'viewed'];

    public function propertyPrice()
    {
        return $this->hasMany('App\Models\PropertyPrice');
    }

    public function propertyAmenity()
    {
        return $this->hasMany('App\Models\PropertyAmenity');
    }

    public function propertyStyle()
    {
        return $this->hasMany('App\Models\PropertyStyle');
    }

    protected $indexConfigurator = PropertyIndex::class;
    protected $mapping = [
        'properties' => [
            'id'       => ['type' => 'integer'],
            'location' => ['type' => 'geo_point'],
            'approved_at' => [
                'type'   => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss||yyyy-MM-dd||epoch_millis'
            ],
            'created_at' => [
                'type'   => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss||yyyy-MM-dd||epoch_millis'
            ],
            'updated_at' => [
                'type'   => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss||yyyy-MM-dd||epoch_millis'
            ],
            'property_number' => [
                'type' => 'text'
            ]
        ]
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->dataTables = new DataTables;
        $this->propertyAmenity = new PropertyAmenity;
        $this->propertyFacility = new PropertyFacility;
        $this->propertyStyle = new PropertyStyle;
        $this->propertyDetailView = new PropertyDetailView;
        $this->recentSearch = new RecentSearch;
    }

    public function photos()
    {
        return $this->hasMany('App\Models\PropertyPhoto');
    }

    public function getLocationAttribute()
    {
        return [
            'lat' => (!empty($this->latitude) ? $this->latitude : 0),
            'lon' => (!empty($this->longitude) ? $this->longitude : 0)
        ];
    }

    public function getSlugUrlAttribute()
    {
        return str_slug($this->title);
    }

    public function getAmenitiesAttribute()
    {
        $amenities = $this->propertyAmenity->wherePropertyId($this->id)->get();
        return $amenities->map(function ($item, $key) {
            return $item->amenity_id;
        });
    }

    public function getFacilitiesAttribute()
    {
        $facilities = $this->propertyFacility->wherePropertyId($this->id)->get();
        return $facilities->map(function ($item, $key) {
            return $item->facility_id;
        });
    }

    public function getStylesAttribute()
    {
        $styles = $this->propertyStyle->wherePropertyId($this->id)->get();
        return $styles->map(function ($item, $key) {
            return $item->style_id;
        });
    }

    public function getViewedAttribute()
    {
        $viewed = $this->propertyDetailView->wherePropertyId($this->id)->get();
        return $viewed->sum('count');
    }

    public function scopeFavourites($query)
    {
        $properties = auth()->user()->property_favorites;
        return $query->with('photos.thumb_images')->whereIn('id', $properties);
    }

    public function nearby($lat, $lng, $paginate = false)
    {
        $location = [
            'lat' => $lat,
            'lon' => $lng
        ];
        $properties = $this->search('*')->with('photos.thumb_images')
            ->where('available_room', '>', 0)
            ->whereGeoDistance('location', $location, '2000m');
        if ($paginate) {
            return $properties->paginate(16);
        }

        return $properties->take(2)->get();
    }

    public function popular($limit = 2, $paginate = false)
    {
        $properties = $this->search('*')->with('photos.thumb_images')
            ->where('available_room', '>', 0)
            ->orderBy('viewed', 'DESC');
        if ($paginate) {
            return $properties->paginate(16);
        }

        return $properties->take($limit)->get();
    }

    public function mostSearched($limit = 5)
    {
        $popular = $this->recentSearch
            ->select(\DB::raw('place_id, ANY_VALUE(location) as place_name, count(*) as total'))
            ->groupBy('place_id')
            ->orderBy('total', 'DESC')
            ->take($limit)
            ->get();

        $that = $this;
        $properties = $popular->map(function ($q) {
            return $this->getPlaceDetail($q->place_id);
        })->map(function ($q) use ($that) {
            return $that->getPropertyByPlaceDetail(json_decode(json_encode($q)));
        });

        return $properties;
    }

    public function mostAvailable($limitDistrict = 1, $limitProperty = 2)
    {
        $district = $this->select(\DB::raw('count(id) as total, ANY_VALUE(district) as district, sum(available_room) as room'))
            ->where('available_room', '>', 0)
            ->groupBy('district')
            ->orderBy('total', 'DESC')
            ->take($limitDistrict)
            ->get();

        $districtIds = $district->map(function ($q) {
            return $q->district;
        });

        return $this->with('photos.thumb_images')->whereIn('district', $districtIds)->where('available_room', '>', 0)->take($limitProperty)->get();
    }

    public function recentSearch($limit = 1)
    {
        $recent = $this->recentSearch->whereUserId(auth()->user()->id)->take($limit)->orderBy('last_searched', 'DESC')->get();

        $that = $this;
        $properties = $recent->map(function ($q) {
            return $this->getPlaceDetail($q->place_id);
        })->map(function ($q) use ($that) {
            return $that->getPropertyByPlaceDetail(json_decode(json_encode($q)));
        });

        return count($properties) > 0 ? $properties[0] : [];
    }

    public function getPlaceDetail($id)
    {
        return Cache::rememberForever('google-place:' . $id, function () use ($id) {
            $response = GooglePlaces::placeDetails($id);
            if (!empty($response['result'])) {
                return $response['result'];
            }
        });
    }

    public function getPropertyByPlaceDetail($place, $limit = 2)
    {
        $properties = $this->search("*");
        $properties->with(['photos.thumb_images', 'propertyStyle.style'])
            ->where('available_room', '>', 0);

        $types = $place->types;
        $viewport = $place->geometry->viewport;
        if (in_array('political', $types) && !empty($viewport)) {
            $whereGeoBox = [
                'top_right'     => [
                    'lat' => $viewport->northeast->lat,
                    'lon' => $viewport->northeast->lng
                ],
                'bottom_left' => [
                    'lat' => $viewport->southwest->lat,
                    'lon' => $viewport->southwest->lng
                ],
            ];
            $properties->whereGeoBoundingBox('location', $whereGeoBox);
        } else {
            $location = $place->geometry->location;
            $whereDistance = [
                'lat' => $location->lat,
                'lon' => $location->lng
            ];
            $properties->whereGeoDistance('location', $whereDistance, '2000m');
        }

        return $properties->take($limit)->get();
    }

    public function ajaxSearch($params)
    {
        $properties = $this->doAjaxSearch($params);

        return $properties->paginate(16, "page", $params->page);
    }

    public function getMinMaxPrice($params)
    {
        $properties = $this->doAjaxSearch($params, false);

        $where = $properties->wheres;
        $query = $this->searchRaw([
            "query" => [
                "bool" => $where
            ],
            "aggs" => [
                "co_living_min_price" => ["min" => ["field" => "co_living_min_price"]],
                "co_living_max_price" => ["max" => ["field" => "co_living_min_price"]],
                "entire_space_min_price" => ["min" => ["field" => "entire_space_min_price"]],
                "entire_space_max_price" => ["max" => ["field" => "entire_space_min_price"]],
            ]
        ]);

        if (!empty($query['aggregations'])) {
            $colivingMin = $query['aggregations']['co_living_min_price']['value'];
            $colivingMax = $query['aggregations']['co_living_max_price']['value'];
            $entireMin = $query['aggregations']['entire_space_min_price']['value'];
            $entireMax = $query['aggregations']['entire_space_max_price']['value'];

            return [
                'min_price' => min([$colivingMin, $colivingMax, $entireMin, $entireMax]) ?? 500000,
                'max_price' => max([$colivingMin, $colivingMax, $entireMin, $entireMax]) ?? 50000000
            ];
        }
    }

    private function doAjaxSearch($params, $price = true)
    {
        $properties = $this->search("*");
        $properties->with(['photos.thumb_images', 'propertyStyle.style'])
            ->where('available_room', '>', 0);

        if (count($params->living_cond) == 1) {
            if (in_array('co-living', $params->living_cond)) $properties->where('is_co_living', 1);
            if (in_array('entire-space', $params->living_cond)) $properties->where('is_entire_space', 1);
        }
        if (@count($params->type)) $properties->whereIn('type', $params->type);
        if ($price) {
            if (@count($params->price)) {
                if (count($params->living_cond) == 1) {
                    if (in_array('co-living', $params->living_cond)) $properties->whereBetween('co_living_min_price', $params->price);
                    if (in_array('entire-space', $params->living_cond)) $properties->whereBetween('entire_space_min_price', $params->price);
                }
            }
        }
        if (@count($params->bedroom)) $properties->whereIn('bedrooms', $params->bedroom);

        if (@count($params->more_filter)) {
            if (!empty($params->more_filter->arrangement)) $properties->whereIn('arrangement', $params->more_filter->arrangement);
            if (!empty($params->more_filter->land_area)) $properties->whereIn('land_area_type', $params->more_filter->land_area);
            if (!empty($params->more_filter->property_furniture)) $properties->whereIn('furniture', $params->more_filter->property_furniture);
            if (!empty($params->more_filter->pet_friendly)) $properties->where('is_pet_friendly', 1);
            if (!empty($params->more_filter->floor_level)) {
                if (in_array('5', $params->more_filter->floor_level)) {
                    if (count($params->more_filter->floor_level) < 2) {
                        $properties->where('floor_range', '>', 5);
                    } else {
                        $properties->where('floor_range', '>', 5);
                        $properties->whereIn('floor_range', $params->more_filter->floor_level);
                    }
                } else {
                    $properties->whereIn('floor_range', $params->more_filter->floor_level);
                }
            }
        }

        if ($params->move_map) {
            $whereGeoBox = [
                'top_right'     => [
                    'lat' => $params->geocode->ne->lat,
                    'lon' => $params->geocode->ne->lng
                ],
                'bottom_left' => [
                    'lat' => $params->geocode->sw->lat,
                    'lon' => $params->geocode->sw->lng
                ],
            ];
            $properties->whereGeoBoundingBox('location', $whereGeoBox);
        } else {
            if (!empty($params->place_detail) && empty($params->commute_detail)) {
                $types = $params->place_detail->types;
                $viewport = $params->place_detail->geometry->viewport;
                if (in_array('political', $types) && !empty($viewport)) {
                    $whereGeoBox = [
                        'top_right'     => [
                            'lat' => $viewport->northeast->lat,
                            'lon' => $viewport->northeast->lng
                        ],
                        'bottom_left' => [
                            'lat' => $viewport->southwest->lat,
                            'lon' => $viewport->southwest->lng
                        ],
                    ];
                    $properties->whereGeoBoundingBox('location', $whereGeoBox);
                } else {
                    $location = $params->place_detail->geometry->location;
                    $whereDistance = [
                        'lat' => $location->lat,
                        'lon' => $location->lng
                    ];
                    $properties->whereGeoDistance('location', $whereDistance, '2000m');
                }
            }
            if (!empty($params->commute_detail)) {
                $geometry    = $params->commute_detail;
                $coordinates = $geometry->features[0]->geometry->coordinates;
                $polygon = $coordinates[0];
                $properties->whereGeoPolygon('location', $polygon);
            }
        }

        return $properties;
    }

    public function ajaxDatatables($data)
    {
        $properties = $this->query();
        return $this->dataTables->of($properties)
            ->filter(function ($query) use ($data) {
                if ($data['title']) {
                    $query->where('title', 'like', "%{$data['title']}%");
                }
                if ($data['type']) {
                    $query->where('type', 'like', "%{$data['type']}%");
                }
                if ($data['is_co_living']) {
                    $query->where('is_co_living', '=', "{$data['is_co_living']}");
                }
                if ($data['is_entire_space']) {
                    $query->where('is_entire_space', '=', "{$data['is_entire_space']}");
                }
                if ($data['land_area_type'] && !empty($data['land_area_type'])) {
                    $query->where('land_area_type', 'like', "%{$data['land_area_type']}%");
                }
                if ($data['arrangement'] && !empty($data['arrangement'])) {
                    $query->where('arrangement', 'like', "%{$data['arrangement']}%");
                }
                if ($data['floor_range'] && !empty($data['floor_range'])) {
                    $query->where('floor_range', 'like', "%{$data['floor_range']}%");
                }
                if ($data['is_pet_friendly']) {
                    $query->where('is_pet_friendly', '=', "{$data['is_pet_friendly']}");
                }
                if ($data['status'] && !empty($data['status'])) {
                    $query->where('status', '=', "%{$data['status']}%");
                }
            })
            ->addColumn('draft', function ($property) {
                return '<input type="checkbox"' . ($property->is_draft ? 'checked' : '') . ' disabled />';
            })
            ->addColumn('action', function ($property) {
                return '<a href="' . route('property.view', ['id' => $property->id]) . '" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>
                <button class="btn btn-xs btn-danger deleteProperty" data-url="' . route('property.destroy', ['id' => $property->id]) . '"><i class="fa fa-trash"></i></button>';
            })
            ->rawColumns(['draft', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function stylesProperty()
    {
        return $this->belongsToMany('App\Models\Style', 'property_styles');
    }

    public function amenitiesProperty()
    {
        return $this->belongsToMany('App\Models\Amenity', 'property_amenities');
    }

    public function facilitiesProperty()
    {
        return $this->belongsToMany('App\Models\Facility', 'property_facilities');
    }

    public function bedroom()
    {
        return $this->hasMany('App\Models\Bedroom');
    }

    public function variants()
    {
        return $this->hasManyThrough('App\Models\BedroomVariant', 'App\Models\Bedroom');
    }

    public function priceDetail()
    {
        return $this->hasMany('App\Models\PropertyPriceDetail');
    }

    public function files()
    {
        return $this->morphMany('App\Models\File', 'fileable');
    }

    public function createNew($data)
    {
        $user = auth()->user();
        $newData = array_merge($data, [
            'user_id'         => $user->id,
            'unit_size'       => ($data['type'] == 'apartment') ? $data['size'] : 0,
            'building_size'   => ($data['type'] == 'house') ? $data['size'] : 0,
            'is_co_living'    => in_array('co-living', $data['living_cond']) ? 1 : 0,
            'is_entire_space' => in_array('entire-space', $data['living_cond']) ? 1 : 0,
            'approved_at'     => now()->toDateTimeString()
        ]);
        return $this->create($newData);
    }

    public function saveData($data)
    {
        $property = Self::find($data['id']);
        $newData = [];
        $step = $data['step'];
        switch ($step) {
            case 1:
                $newData = array_merge($data, [
                    'unit_size'       => ($data['type'] == 'apartment') ? $data['size'] : 0,
                    'building_size'   => ($data['type'] == 'house') ? $data['size'] : 0,
                    'is_co_living'    => in_array('co-living', $data['living_cond']) ? 1 : 0,
                    'is_entire_space' => in_array('entire-space', $data['living_cond']) ? 1 : 0,
                ]);
                break;
            case 2:
                $newData = [
                    'bedrooms'  => $data['bedrooms'],
                    'bathrooms' => $data['bathrooms']
                ];
                break;
            case 3:
                $newData = [
                    'address'         => $data['property_address'],
                    'property_number' => $data['property_number'],
                    'property_detail' => $data['property_details'],
                    'city'            => $data['city'],
                    'district'        => $data['district'],
                    'postcode'        => $data['post_code'],
                    'latitude'        => $data['latitude'],
                    'longitude'       => $data['longitude'],
                    'province'        => $data['province'],
                    'village'         => $data['village']
                ];
                break;
            case 4:
                if ($property->type == 'house') {
                    $newData = [
                        'title'           => $data['title'],
                        'description'     => $data['description'],
                        'land_area_type'  => $data['land_area_type'],
                        'arrangement'     => $data['arrangement'],
                        'storey'          => $data['storey'],
                        'is_pet_friendly' => (isset($data['is_pet_friendly'])) ? 1 : 0
                    ];
                } else {
                    $newData = [
                        'title'           => $data['title'],
                        'description'     => $data['description'],
                        'floor_range'     => $data['floor_range'],
                        'is_pet_friendly' => (isset($data['is_pet_friendly'])) ? 1 : 0
                    ];
                }
                break;
            case 5:
                $newData = [
                    'furniture' => $data['furniture']
                ];
                break;
            case 7:
                if (isset($data['belong_to'])) {
                    $newData['belong_to'] = $data['belong_to'];
                }
                if (isset($data['ownership_status'])) {
                    $newData['ownership_status'] = $data['ownership_status'];
                }
                if (isset($data['insurance_status'])) {
                    $newData['is_insured'] = $data['insurance_status'];
                }
                if (isset($data['estimated_price'])) {
                    $newData['estimated_price'] = $data['estimated_price'];
                }
                break;
            case 10:
                $newData = [
                    'is_draft' => 0
                ];
                break;
            default:
                $status = false;
        }
        return Self::updateOrCreate([
            'id' => $data['id']
        ], $newData);
    }

    public function updateRoom()
    {
        $newData = [
            'available_room'  => $data['available_room'],
            'rented_room'  => $data['rented_room'],
            'total_room'  => $data['total_room'],
        ];
    }

    public function inclusiveService()
    {
        return $this->hasMany('App\Models\InclusiveService');
    }
}
