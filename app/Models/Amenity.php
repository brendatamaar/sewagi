<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Property;

class Amenity extends Model
{
    public function properties()
    {
        return $this->belongsToMany('App\Models\Property');
    }

    public function bedroom()
    {
        return $this->belongsToMany('App\Models\Bedroom');
    }

    public function getLocale()
    {
        return $this->select('id', (session('locale')=='id' ? 'id_name as name' : 'name'), 'entity', 'type', 'icon')->get();
    }
}
