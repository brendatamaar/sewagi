<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $table = 'community';
    protected $guarded = ['created_at', 'updated_at'];
    
    public function createNew($data)
    {
        $userData = [
            'first_name'        => $data['first_name'],
            'last_name'         => $data['last_name'],
            'nationality_id'    => $data['nationality_id'],
            'phone_number'      => $data['phone_number'],
            'email'             => $data['email'],
            'area_live'         => $data['area_live'],
            'area_practice'     => $data['area_practice'],
            'employment_status' => $data['employment_status'],
            'working_field'     => $data['working_field'],
            'latest_education'  => $data['latest_education'],
            'english_spoken'    => $data['english_spoken'],
            'english_written'   => $data['english_written'],
            'description'       => $data['description'],
            'url'               => $data['url'],
        ];
        
        return Self::create($userData);
    }
}

