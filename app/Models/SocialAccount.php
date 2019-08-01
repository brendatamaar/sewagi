<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends DefaultModel
{
    public function saveData($provider, $data)
    {
        switch ($provider) {
            case 'google':
                $newData = [
                    'email'      => $data->email,
                    'first_name' => $data->user['given_name'],
                    'last_name'  => $data->user['family_name']
                ];
                break;
            case 'facebook':
                $newData = [
                    'email'      => $data->email,
                    'first_name' => $data->name
                ];
                break;
            case 'linkedin':
                $newData = [
                    'email'      => $data->email,
                    'first_name' => $data->first_name,
                    'last_name'  => $data->last_name,
                ];
                break;
        }
        return Self::firstOrCreate([
            'provider' => $provider,
            'provider_id' => $data->id,
        ], $newData);
    }
}
