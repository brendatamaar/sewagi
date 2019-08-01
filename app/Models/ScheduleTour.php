<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Models\ScheduleTourOption;

class ScheduleTour extends Model
{
    use Notifiable;

    private $scheduleTourOption;
    
    protected $table = 'schedule_tours';
    protected $guarded = ['created_at', 'updated_at'];
    protected $appends = ['confirmed_date'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->scheduleTourOption = new ScheduleTourOption;
    }
    
    public function createNew($data)
    {
        $newData = [
            'user_id'           => $data['user_id'],
            'property_id'       => $data['property_id'],
            'bedroom_id'        => $data['bedroom_id'],
            'living_condition'  => $data['living_condition'],
            'length'            => $data['length'],
            'price'             => $data['price'],
            'type_tour'         => $data['type_tour']
        ];
        
        return Self::create($newData);
    }

    public function notif()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable');
    }

    public function options()
    {
        return $this->hasMany('App\Models\ScheduleTourOption');
    }

    public function tourStatus()
    {
        return $this->belongsTo('App\Models\ScheduleTourStatus', 'status');
    }

    public function property()
    {
        return $this->belongsTo('App\Models\Property');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function toUser()
    {
        return $this->belongsTo('App\Models\User', 'to_user_id');
    }

    public function bedroom()
    {
        return $this->belongsTo('App\Models\Bedroom');
    }

    public function getConfirmedDateAttribute()
    {
        return (is_null($this->confirmed_tour_id)) ? false : $this->scheduleTourOption->find($this->confirmed_tour_id)->time;
    }

    public function replyTour($id, $data)
    {
        if ($data['is_property_available']) {
            if ($data['confirmed_tour_id'] == null) {
                // send notif to sewagi
                $data['status'] = 6;
            } else {
                $data['status'] = 3;
            }
        }

        if (!$data['is_property_available']) {
            if ($data['is_property_indefinitely'] != null) {
                $data['status'] = 4;
            } else {
                $data['status'] = 5;
            }
        }

        return tap($this->find($id))->update($data)->fresh();
    }
}

