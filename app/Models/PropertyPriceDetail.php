<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Property;
use App\Models\Bedroom;

class PropertyPriceDetail extends Model
{
    protected $fillable=[
        'property_id',
        'length',
        'bedroom_id',
        'paid_once',
        'paid_twice',
        'paid_quarterly',
        'paid_monthly',
    ];

    public function property()
    {
        return $this->belongsToMany('App\Models\Property');
    }
    public function bedroom(){
        return $this->belongsTo('App\Models\Bedroom');
    }

    public function createNew($data)
    {
        $step = $data['step'];
        $detail = json_decode($data['detail_rent']);
        if($step == 8){
            foreach($detail as $k => $v){
                $newData=[
                    'property_id' => $data['id'],
                    'length' => $this->convertLengthValue($v->length),
                    'paid_once' => (int)$v->paid_method->paid_once,
                    'paid_twice' => (int)$v->paid_method->paid_twice,
                    'paid_quarterly' => (int)$v->paid_method->paid_quarterly,
                    'paid_monthly' => (int)$v->paid_method->paid_monthly,
                ];
                PropertyPriceDetail::create($newData);
            }
        }
        else if($step == 9){
            foreach($detail as $k => $v){
                foreach($v->paid_method as $value){
                    $newData=[
                        'property_id' => $data['id'],
                        'length' => $this->convertLengthValue($v->length),
                        'bedroom_id' => $value->bedroom_id,
                        'paid_once' => isset($value->paid_once) ? (int)$value->paid_once : 0,
                        'paid_twice' => isset($value->paid_twice) ? (int)$value->paid_twice : 0,
                        'paid_quarterly' => isset($value->paid_quarterly) ? (int)$value->paid_quarterly : 0,
                        'paid_monthly' => isset($value->paid_monthly) ? (int)$value->paid_monthly : 0,
                    ];
                    PropertyPriceDetail::create($newData);
                }
            }
        }
    }

    public function convertLengthValue($str){
        $result = $str;
        switch($str){
            case '1 year':
                $result = '12';
                break;
            case '9 months':
                $result = '9';
                break;
            case '6 months':
                $result = '6';
                break;
            case'3 months':
                $result = '3';
                break;
        }
        return $result;
    }
    public function deleteByPropertyIdAndLivingCondition($id, $livingCondition)
    {
        if($livingCondition == 'entire_space'){
            $model = $this->where('property_id', $id)->whereNull('bedroom_id');
        }
        if($livingCondition == 'co_living'){
            $model = $this->where('property_id', $id)->whereNotNull('bedroom_id');
        }
        return $model->delete();
    }
}
