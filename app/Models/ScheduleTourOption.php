<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleTourOption extends Model
{
    protected $fillable = ['schedule_tour_id', 'time'];
    
    public function createNew($data)
    {
        $newData = [
            'schedule_tour_id'  => $data['schedule_tour_id'],
            'time'              => $data['time']
        ];
        
        return Self::create($newData);
    }

    public function updateSchedule($data)
    {
        $scheduleId = (int) $data['schedule_id'];
        $that = $this;

        $this->whereScheduleTourId($scheduleId)->delete();

        $options = collect($data['options'])->map(function($q) use ($that, $scheduleId) {
            $data = [
                'schedule_tour_id' => $scheduleId,
                'time' => date('Y-m-d H:i:s', strtotime($q))
            ];

            return $that->create($data);
        })->toArray();
        
        return $options;
    }
}

