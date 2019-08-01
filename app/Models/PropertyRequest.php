<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Amenity;
use App\Models\Property;

class PropertyRequest extends Model
{
    protected $fillable = [
        'id',
        'email',
        'phone_number',
        'user_id',
        'message',
    ];

    public function createNew($data)
    {
        if (isset($data['phone_country_code'], $data['phone_number'])) {
            $data['phone_number'] = $data['phone_country_code'].$data['phone_number'];
        }

        return $this->create($data);
    }
}
