<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyDetailView extends Model
{    
    protected $table = 'property_views';
    protected $guarded = ['created_at', 'updated_at'];

    public function property()
    {
        return $this->belongsTo('App\Models\Property');
    }
    
    public function createNew($data)
    {
        $newData = [
            'user_id'           => $data['user_id'],
            'property_id'       => $data['property_id'],
            'count'             => $data['count']
        ];
        
        return Self::create($newData);
    }

    public function findWithProperty($limit = 2)
    {
        $properties = $this->with(['property', 'property.photos.thumb_images'])->whereUserId(auth()->user()->id)->take($limit)->orderBy('last_viewed', 'DESC')->get();
        return $properties->map(function($q) {
            return $q->property;
        });
    }
}

