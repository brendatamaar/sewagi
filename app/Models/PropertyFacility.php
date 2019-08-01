<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Facility;
use App\Models\Property;

class PropertyFacility extends Model
{
    protected $fillable=[
        'id',
        'property_id',
        'facility_id'
    ];

    public function property()
    {
        return $this->belongsToMany('App\Models\Property');
    }

    public function createNew($data)
    {
        foreach($data['facility_id'] as $loop)
        {
            $newData=[
                'property_id' => $data['id'],
                'facility_id' => $loop,
            ];
            PropertyFacility::create($newData);
        }
    }
    
    public function deleteByPropertyId($id)
    {
        $model = $this->where('property_id', $id);
        return $model->delete();
    }
}
