<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Amenity;
use App\Models\Property;

class PropertyAmenity extends Model
{
    protected $fillable = [
        'id',
        'property_id',
        'amenity_id'
    ];

    public function property()
    {
        return $this->belongsToMany('App\Models\Property');
    }

    public function createNew($data)
    {
        foreach($data['amenity_id'] as $loop)
        {
            $newData=[
                'property_id' => $data['id'],
                'amenity_id' => $loop,
            ];
            PropertyAmenity::create($newData);
        }
    }
    
    public function deleteByPropertyId($id)
    {
        $model = $this->where('property_id', $id);
        return $model->delete();
    }
}
