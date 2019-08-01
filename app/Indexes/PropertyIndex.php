<?php

namespace App\Indexes;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class PropertyIndex extends IndexConfigurator
{
    use Migratable;

    protected $name = 'property_index';

    /**
     * @var array
     */
    protected $settings = [
        "analysis" => [
            "analyzer" => [
                "es_std" => [
                    "type" => "standard",
                    "stopwords" => "_english_"
                ]
            ],
            "normalizer" => [
                "my_normalizer" => [
                    "type"        => "custom",
                    "char_filter" => [],
                    "filter"      => ["lowercase", "asciifolding"]
                ]
            ]
        ]
    ];
}