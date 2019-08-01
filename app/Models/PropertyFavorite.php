<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyFavorite extends Model
{
    protected $fillable = [
        'user_id',
        'property_id'
    ];

    public function deleteByPropertyId($pid)
    {
        return $this->whereUserId(auth()->user()->id)
            ->wherePropertyId($pid)
            ->delete();
    }
}
