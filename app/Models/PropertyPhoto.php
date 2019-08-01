<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Imagable;

class PropertyPhoto extends Model
{
    use Imagable;
    protected $fillable = [
        'property_id',
        'photable_id',
        'photable_type',
    ];
    protected $appends = ['name'];

    public function photable()
    {
        return $this->morphTo();
    }

    public function types()
    {
        return $this->where('photable_type', 'App\Models\PhotoType');
    }

    public function bedrooms()
    {
        return $this->where('photable_type', 'App\Models\BedRoom');
    }

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imagable');
    }

    public function medium_images()
    {
        return $this->images()->where('thumbnail', 'medium');
    }

    public function thumb_images()
    {
        return $this->images()->where('thumbnail', 'thumb');
    }

    public function getNameAttribute()
    {
        return $this->photable->name;
    }

    public function properties(){
    	return $this->belongsTo('App\Models\Property');
    }

    public function getPhotos($property_id)
    {
        $types = \App\Models\PhotoType::all();
        foreach ($types as $type) {
            $type->photos()->firstOrCreate(['property_id' => $property_id]);
        }
        $bedrooms = \App\Models\Bedroom::where('property_id', $property_id)->get();
        foreach ($bedrooms as $bedroom) {
            $bedroom->photos()->firstOrCreate(['property_id' => $property_id]);
        }
        
        return $this->where('property_id', $property_id)->with(['photable'])->get();
    }

    public function getByTypes($property_id)
    {
        // $photos = $this->types()->where('property_id', $property_id)->with(['images' => function ($image)
        $photos = $this->types()->where('property_id', $property_id)->with(['photable', 'images' => function ($image)
        {
            return $image->GroupByFileName();
        }]);

        if ($photos->count()) {
            return $photos->get();
        } else {
            $types = \App\Models\PhotoType::all();
            foreach ($types as $type) {
                $type->photos()->create(['property_id' => $property_id]);
            }
            return $photos->get();
        }
    }

    public function getByBedrooms($property_id)
    {
        $bedrooms = \App\Models\Bedroom::where('property_id', $property_id)->get();
        foreach ($bedrooms as $bedroom) {
            $bedroom->photos()->firstOrCreate(['property_id' => $property_id]);
        }
        return $this->bedrooms()->where('property_id', $property_id)->get();
    }

    /**
     * [setAsThumbnail set as Main image]
     * @param string $id [ID of property_photos]
     */
    public function setAsThumbnail($id)
    {
        $data = $this->find($id);
        if ($data) {
            $this->where('property_id', $data->property_id)->update(['is_thumbnail' => 0]);
            $data->is_thumbnail = 1;
            return $data->save();
        }
        return false;
    }
}
