<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = [
        'size',
        'mime_type',
        'file_name',
        'path',
        'height',
        'width',
        'parent_id',
        'thumbnail',
        'type'
    ];
    protected $appends = ['url'];

    public function imagable()
    {
        return $this->morphTo();
    }

    public function getUrlAttribute()
    {
        return Storage::url($this->path);
    }

    public function scopeIsParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeGroupByFileName($query)
    {
        return $query->select('file_name')->groupBy('file_name');
    }
}
