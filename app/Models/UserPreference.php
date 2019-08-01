<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends DefaultModel
{
    public function saveData($data)
    {
        $newData = [
            'type'      => $data['type'],
            'option_1'  => $data['option_1'],
            'option_2'  => $data['option_2'],
            'option_3'  => $data['option_3'],
            'option_4'  => $data['option_4'],
        ];
        return Self::updateOrCreate([
            'user_id' => $data['user_id'],
        ], $newData);
    }
}
