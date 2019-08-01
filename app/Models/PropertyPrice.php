<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Property;
class PropertyPrice extends Model
{
    protected $fillable=[
        'property_id',
        'living_condition',
        'is_include_internet',
        'is_include_park',
        'is_include_tv_cable',
        'is_include_cleaning',
        'service_fee',
        'charge_fee'
    ];

    public function property()
    {
        return $this->belongsTo('App\Model\Property');
    }

    public function createNew($data)
    {
        $newData=[
            'property_id'=> $data['id'],
            'living_condition' => $data['living_condition'],
            'is_include_internet' => (isset($data['is_internet'])) ? 1 : 0,
            'is_include_park' => (isset($data['is_parking'])) ? 1 : 0,
            'is_include_tv_cable' => (isset($data['is_tv_cable'])) ? 1 : 0,
            'is_include_cleaning' => (isset($data['is_cleaning'])) ? 1 : 0,
            'service_fee' => (isset($data['service_fee'])) ? $data['service_fee'] : 0,
            'charge_fee' => (isset($data['charge_fee'])) ? 1 : 0
        ];
        return PropertyPrice::create($newData);
    }
    public function deleteByPropertyIdAndLivingCondition($id, $livingCondition)
    {
        if($livingCondition == 'entire_space'){
            $model = $this->where('property_id', $id)->where('living_condition', 'entire-space');
        }
        if($livingCondition == 'co_living'){
            $model = $this->where('property_id', $id)->where('living_condition', 'co-living');
        }
        return $model->delete();
    }
}
