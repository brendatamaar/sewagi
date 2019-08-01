<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoType extends Model
{
    public function photos()
    {
        return $this->morphMany('App\Models\PropertyPhoto', 'photable');
    }

    public function propertyPhoto($propertyId)
    {
        $propertyPhoto = $this->photos()->where('property_id', $propertyId);
        if ($propertyPhoto->count()) {
            return $propertyPhoto->first();
        } else {
            return $this->photos()->create([
                'property_id' => $propertyId
            ]);
        }
    }
}
