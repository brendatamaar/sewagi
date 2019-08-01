<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Style;
use App\Models\Property;

class PropertyStyle extends Model
{
    protected $fillable = [
        'id',
        'property_id',
        'style_id'
    ];

    public function property()
    {
        return $this->belongsToMany('App\Models\Property');
    }

    public function createNew($data)
    {
        if (!empty($data['style_id'])) {
            foreach($data['style_id'] as $loop) {
                $newData=[
                    'property_id' => $data['id'],
                    'style_id' => $loop,
                ];
                PropertyStyle::create($newData);
            }
        }
    }
    
    public function deleteByPropertyId($id)
    {
        $model = $this->where('property_id', $id);
        return $model->delete();
    }

    public function style()
    {
        return $this->belongsTo('App\Models\Style');
    }
}
