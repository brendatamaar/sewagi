<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationCode extends DefaultModel
{
    protected $guarded = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeActive($q)
    {
        return $q->where('expired_at', '>=', now());
    }

    public function getActive($code)
    {
        return $this->where('code', $code)
            ->active()
            ->first();
    }

    public function createNew($data)
    {
        $newData = [
            'user_id'       => $data['user_id'],
            'type'          => $data['type'],
            'code'          => $data['code'],
            'expired_at'    => $data['expired_at'],
        ];
        return Self::updateOrCreate(
            ['user_id' => $data['user_id'], 'type' => $data['type']],
            $newData
        );
    }
}
