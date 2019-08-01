<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecentSearch extends Model
{
    protected $fillable = [
        'user_id',
        'instance_id',
        'place_id',
        'location',
        'full_location',
        'last_searched'
    ];

    public function saveSearch($data)
    {
        $userId = auth()->user()->id ?? null;

        return $this->updateOrCreate(
            [
                'user_id' => $userId,
                'instance_id' => $data['instance_id'],
                'place_id' => $data['place_id'],
            ],
            [
                'location' => $data['location'],
                'full_location' => $data['full_location'],
                'last_searched' => date('Y-m-d H:i:s')
            ]
        );
    }

    public function findByUserId($data)
    {
        $userId = auth()->user()->id ?? null;
        $results = $this->getQuery();

        if ($userId && $data['instance_id'] != null) {
            $results->whereUserId($userId)
                ->where('instance_id', $data['instance_id']);
        }
        
        if ($userId && $data['instance_id'] == null) {
            $results->whereUserId($userId);
        }

        if ($userId == null && $data['instance_id'] != null) {
            $results->where('instance_id', $data['instance_id']);
        }

        if ($userId == null && $data['instance_id'] == null) {
            return [];
        }

        $results = $results->take(8)
            ->orderBy('last_searched', 'DESC')
            ->get();

        return collect($results)->unique('place_id')->values()->all();
    }
}
