<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BedroomVariant extends Model
{
    protected $table = 'bedroom_variants';
    protected $fillable = [
        'bedroom_id',
        'name',
        'is_active'
    ];

    public function bedroom(){
    	return $this->belongsTo('App\Models\Bedroom');
    }
}
