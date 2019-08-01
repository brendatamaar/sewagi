<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BedroomAmenity extends Model
{
    protected $guarded = ['created_at', 'updated_at'];
    protected $fillable = [
        'bedroom_id',
        'amenity_id'
    ];
}
