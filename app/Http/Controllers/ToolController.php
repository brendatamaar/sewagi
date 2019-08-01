<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    public function previewPdf()
    {
        $im = new imagick('https://sewagi-dev.s3.amazonaws.com/files/2019/05/21/bbd3076a65bfc0cb125f94a1aa05f9ef38351a64/review-12032019pdf[0]');
        $im->setImageFormat('jpg');
        header('Content-Type: image/jpeg');
        echo $im;
    }

    public function elastic()
    {
        /* Example Query From Search */
        $properties = $this->property->search('*')
                ->where('district', 'pademangan');
        
        /* Query Get Aggregations */
        $where = $properties->wheres;
        $query = $this->property->searchRaw([
            "query" => [
                "bool" => $where
            ],
            "aggs" => [
                "co_living_min_price" => [ "min" => [ "field" => "co_living_min_price" ] ],
                "co_living_max_price" => [ "max" => [ "field" => "co_living_min_price" ] ],
                "entire_space_min_price" => [ "min" => [ "field" => "entire_space_min_price" ] ],
                "entire_space_max_price" => [ "max" => [ "field" => "entire_space_min_price" ] ],
            ]
        ]);

        if (!empty($query['aggregations'])) {
            return $query['aggregations'];
        }
    }
}
