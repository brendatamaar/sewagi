<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Country extends DefaultModel
{
    public function import($data)
    {
        $this->truncate();
        $arrData = [];
        foreach ($data as $country) {
            $code = strtolower($country->alpha2Code);
            $arrData[] = [
                'name'         => $country->name,
                'alpha2_code'  => $country->alpha2Code,
                'alpha3_code'  => $country->alpha3Code,
                'region'       => $country->region,
                'demonym'      => $country->demonym,
                'calling_code' => "+".$country->callingCodes[0],
                'flag'         => "https://www.countryflags.io/{$code}/flat/64.png"
            ];
        }
        $collection = collect($arrData);
        foreach ($collection->chunk(100) as $chunk) {
            $this->insert($chunk->toArray());
        }
    }
    
    public function getAll()
    {
        return Cache::remember('country.all', 60, function () {
            return Self::where('demonym', '<>', '')
                ->orderBy('order')
                ->orderBy('demonym')    
                ->get();
        });
    }
}
