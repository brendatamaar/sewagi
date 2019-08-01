<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageTitle extends Model
{
    public function getRandom($page){
        $lang = session('locale') ? session('locale') : 'en';
        $field = $lang.'_title';
        $title = PageTitle::where('page','=',$page)->inRandomOrder()->take(1)->first();
        return $title->{$field};
    }
}