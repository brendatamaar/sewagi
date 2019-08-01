<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class BookNow extends Model
{
    use Notifiable;
    
    protected $table = 'instant_bookings';
    protected $guarded = ['created_at', 'updated_at'];
    
    public function createNew($data)
    {
        $newData = [
            'user_id'           => $data['user_id'],
            'property_id'       => $data['property_id'],
            'bedroom_id'        => $data['bedroom_id'],
            'living_condition'  => $data['living_condition'],
            'length'            => $data['length'],
            'price'             => $data['price']
        ];
        
        return Self::create($newData);
    }

    public function notif()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable');
    }
}

