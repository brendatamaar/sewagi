<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $guarded = ['created_at', 'updated_at'];
    
    public function createNew($data)
    {
        $newData = [
            'from_user_id'  => $data['from_user_id'],
            'to_user_id'    => $data['to_user_id'],
            'type'          => $data['type'],
            'subject'       => $data['subject'],
            'message'       => $data['message']
        ];
        
        return Self::create($newData);
    }

    public function notifiable() {
        return $this->morphTo();
    }
}

