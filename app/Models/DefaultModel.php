<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class DefaultModel extends Model
{
    protected $guarded = ['created_at', 'updated_at'];
}
