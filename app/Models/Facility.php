<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    public function properties()
    {
        return $this->belongsToMany('App\Models\Property');
    }

    public function getLocale()
    {
        return $this->select('id', (session('locale')=='id' ? 'id_name as name' : 'name'))->get();
    }
}
