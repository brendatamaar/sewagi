<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SearchPreferenceHobby;
use App\Models\SearchPreferenceLifestyle;
use App\Models\SearchPreferenceProfession;

class SearchPreference extends Model
{
    private $searchPreferenceHobby;
    private $searchPreferenceLifestyle;
    private $searchPreferenceProfession;

    protected $fillable = [
        'user_id',
        'ip_address',
        'is_mostly_male',
        'is_mostly_female',
        'from',
        'min_age',
        'max_age'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->searchPreferenceHobby = new SearchPreferenceHobby;
        $this->searchPreferenceLifestyle = new SearchPreferenceLifestyle;
        $this->searchPreferenceProfession = new SearchPreferenceProfession;
    }

    public function saveData($data)
    {
        $userId = auth()->user()->id ?? null;
        $ip = request()->ip();

        $preference = $this->updateOrCreate(
            [
                'user_id' => $userId,
                'ip_address' => $ip
            ],
            [
                'is_mostly_male' => $data['is_mostly_male'],
                'is_mostly_female' => $data['is_mostly_female'],
                'from' => $data['from'] ?? null,
                'min_age' => $data['min_age'],
                'max_age' => $data['max_age']
            ]
        );

        $checkHobbies = $this->searchPreferenceHobby->whereSearchPreferenceId($preference->id)->get();
        if (count($checkHobbies) > 0) $this->searchPreferenceHobby->whereSearchPreferenceId($preference->id)->delete();

        $checkLifestyles = $this->searchPreferenceLifestyle->whereSearchPreferenceId($preference->id)->get();
        if (count($checkLifestyles) > 0) $this->searchPreferenceLifestyle->whereSearchPreferenceId($preference->id)->delete();

        $checkProfessions = $this->searchPreferenceProfession->whereSearchPreferenceId($preference->id)->get();
        if (count($checkProfessions) > 0) $this->searchPreferenceProfession->whereSearchPreferenceId($preference->id)->delete();

        $hobbies = collect($data['hobbies'])->map(function ($item) use ($preference) {
            return ['search_preference_id' => $preference->id, 'option_id' => $item];
        })->all();

        $lifestyles = collect($data['lifestyles'])->map(function ($item) use ($preference) {
            return ['search_preference_id' => $preference->id, 'option_id' => $item];
        })->all();

        $professions = collect($data['professions'])->map(function ($item) use ($preference) {
            return ['search_preference_id' => $preference->id, 'option_id' => $item];
        })->all();

        $this->searchPreferenceHobby->insert($hobbies);
        $this->searchPreferenceLifestyle->insert($lifestyles);
        $this->searchPreferenceProfession->insert($professions);
    }
}
