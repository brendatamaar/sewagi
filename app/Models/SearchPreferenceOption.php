<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchPreferenceOption extends Model
{
    public function getLocale()
    {
        return $this->select('id', (session('locale')=='id' ? 'id_name as name' : 'name'), 'type')->get();
    }
}
