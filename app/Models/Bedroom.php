<?php

namespace App\Models;
use App\Models\Property;
use App\Models\BedroomAmenity;
use App\Models\BedroomVariant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use App\Traits\Imagable;

class Bedroom extends Model
{
    use MainModel;
    use Imagable;
    
    protected $table = 'bedrooms';
    protected $guarded = ['created_at', 'updated_at'];
    protected $fillable = [
        'property_id',
        'type',
        'name',
        'size',
        'quantity',
        'furniture',
        'is_loft',
        'bed_arrangement'
    ];

    public function properties(){
    	return $this->belongsTo('App\Models\Property');
    }

    public function variants(){
    	return $this->hasMany('App\Models\BedroomVariant');
    }

    public function amenities()
    {
        return $this->hasMany('App\Models\BedroomAmenity');
    }

    public function amenitiesBedroom()
    {
        return $this->belongsToMany('App\Models\Amenity', 'bedroom_amenities');
    }

    public function photos()
    {
        return $this->morphMany('App\Models\PropertyPhoto', 'photable');
    }

    public function massCreate($data){
        $detail = json_decode($data['detail_bedroom']);
        $property_id = $data['id'];
        foreach($detail as $key => $value){
            $newData = [
                'property_id' => $property_id,
                'type'  => $this->convertBedroomType($value->bedroom_type),
                'name'  => $value->bedroom_name,
                'size'  => $value->bedroom_size,
                'quantity'  => $value->bedroom_qty,
                'furniture'  => strtolower($value->bedroom_furniture),
                'is_loft'  => ($value->is_loft != '') ? 1 : 0,
                'bed_arrangement'  => $this->convertBedroomArrangement($value->bedroom_arrangement)
            ];
            $obj = $this->createNew($newData);
            foreach($value->amenities as $k => $v){
                $bedroomAmenityData = [
                    'bedroom_id' => $obj->id,
                    'amenity_id' => $v,
                ];
                BedroomAmenity::create($bedroomAmenityData);
            }
            foreach($value->room_numbering as $k => $v){
                $roomNumberingData = [
                    'bedroom_id' => $obj->id,
                    'name' => $v->room_name,
                    'is_active' => $v->room_availability,
                ];
                BedroomVariant::insert($roomNumberingData);
            }
        }
    }
    public function createNew($data){
        $newData=[
            'property_id' => $data['property_id'],
            'type'  => $data['type'],
            'name'  => $data['name'],
            'size'  => $data['size'],
            'quantity'  => $data['quantity'],
            'furniture'  => $data['furniture'],
            'is_loft'  => $data['is_loft'],
            'bed_arrangement'  => $data['bed_arrangement'],
        ];
        return Self::create($newData);
    }
    public function convertBedroomType($str){
        $result = $str;
        switch($str){
            case 'Master Bedroom':
                $result = 'master';
                break;
            case 'Standard Bedroom':
                $result = 'standard';
                break;
            case 'Pocket Bedroom':
                $result = 'pocket';
                break;
        }
        return $result;
    }
    public function convertBedroomArrangement($str){
        $result = $str;
        switch($str){
            case 'Twin Bed':
                $result = 'twin';
                break;
            case 'Single Size Bed':
                $result = 'single';
                break;
            case 'Queen Size Bed':
                $result = 'queen';
                break;
            case 'King Size Bed':
                $result = 'king';
                break;
            default:
                $result = NULL;
                break;
        }
        return $result;
    }
    public function saveAmenities($array)
    {
        if (!empty($array)) {
            foreach ($array as $val) {
                $data = [
                    'amenity_id' => $val
                ];
                $this->amenities()->create($data);
            }
        }
    }
    public function getPropertyBedrooms($propertyId)
    {
        return $this->with(['amenities'])
                        ->where('property_id', $propertyId)
                        ->get();
    }
    public function getAmenityValuesAttribute()
    {
        return Arr::pluck($this->amenities, 'amenity_id');
    }
    public function propertyPhoto($propertyId)
    {
        $propertyPhoto = $this->photos()->where('property_id', $propertyId);
        if ($propertyPhoto->count()) {
            return $propertyPhoto->first();
        } else {
            return $this->photos()->create([
                'property_id' => $propertyId
            ]);
        }
    }
    public function generateName($request)
    {
        $current  = $this->find($request->id);        
        $query    = $this->where('property_id', $request->property_id)->where('type', $request->type);
        $pre      = ucfirst($request->type);
        $quantity = (int)$request->quantity;
        
        if ($current->type != $request->type || $current->quantity != $request->quantity) {
            if ($quantity > 1) {
                $query->where('quantity', 1);
            } else {
                $query->where('quantity', '>', 1);
            }
            $type  = ($request->quantity > 1) ? "Type " : "";
            $count = $query->count();
            return $pre." Bedroom ".$type.($count+1);
        } else {
            return $current->name;
        }
    }
    public function checkValidate(int $propertyId)
    {
        $query = $this->where('property_id', $propertyId)
                    ->where('quantity', '>', 0);
        return $query->count();
    }
}
