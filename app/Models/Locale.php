<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    protected $guarded = ['created_at', 'updated_at'];
    protected $fillable = [
        'page',
        'key',
        'id_desc',
        'en_desc',
    ];

    public function getLocaleByPage($page='')
    {
        $locale = \Cache::remember('locale_page_'.$page.'_ID_'.session()->getId(), 60 * 60 * 2, function () use ($page) {
            $data = self::where('page', $page)->get();
            $array = [];
            foreach ($data as $value) {
                $array[$value->key] = [
                    'id' => $value->id_desc,
                    'en' => $value->en_desc,
                ];
            }
            return $array;
        });
        return $locale;
    }
}
