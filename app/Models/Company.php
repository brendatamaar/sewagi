<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use Laratrust\Traits\LaratrustUserTrait;


class Company extends Model
{
    protected $guarded = ['created_at', 'updated_at'];
    protected $fillable = [
        'user_id',
        'name',
        'street',
        'street_no',
        'detail',
        'city',
        'district',
        'postcode',
        'phone_number',
        'website'
    ];
    
    public static function createNew($data)
    {
        $newData = [
            'name'          => $data['name'],
            'street'        => $data['street'],
            'street_no'     => $data['street_no'],
            'detail'        => $data['detail'],
            'city'          => $data['city'],
            'district'      => $data['district'],
            'postcode'      => $data['postcode'],
            'phone_number'  => $data['phone_number_company'],
            'website'       => $data['website'],
        ];
        return Self::create($newData);
    }

    public function updateData($data)
    {
        $result = $this->find($data['id'])
            ->update([
                'name' => $data['name'],
                'street' => $data['street'],
                'street_no' => $data['street_no'],
                'detail' => $data['detail'],
                'city' => $data['city'],
                'district' => $data['district'],
                'postcode' => $data['postcode'],
                'phone_number' => $data['phone_number'],
                'website' => $data['website'],
            ]);

        return $result;
    }
}
