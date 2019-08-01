<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $fillable = [
        'user_id',
        'hobbies',
        'lifestyles',
        'profession',
        'languages',
        'emergency_contact'
    ];

    public function getHobbiesAttribute($value)
    {
        return json_decode($value);
    }

    public function getLifestylesAttribute($value)
    {
        return json_decode($value);
    }

    public function getProfessionAttribute($value)
    {
        return json_decode($value);
    }

    public function getLanguagesAttribute($value)
    {
        return json_decode($value);
    }

    public function getEmergencyContactAttribute($value)
    {
        return json_decode($value);
    }

    public function store($data)
    {
        return $this->updateOrCreate([
                'user_id' => auth()->user()->id,
            ],
            [
                'hobbies' => json_encode($data['hobbies']),
                'lifestyles' => json_encode($data['lifestyles']),
                'profession' => json_encode($data['profession']),
                'languages' => json_encode($data['languages']),
                'emergency_contact' => json_encode($data['emergency_contact']),
            ]);
    }
}
