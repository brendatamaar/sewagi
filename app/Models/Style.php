<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Property;

class Style extends Model
{
    protected $table = "styles";

    public function properties()
    {
        return $this->belongsToMany('App\Models\Property');
    }

    public function getLocale()
    {
        return $this->select('id', (session('locale')=='id' ? 'id_name as name' : 'name'), 'image')->get();
    }
}
