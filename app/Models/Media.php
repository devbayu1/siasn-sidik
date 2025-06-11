<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Media extends Model
{
    protected $fillable = [
        'title',
        'description',
        'slug',
        'type',
        'file_path',
    ];

    protected static function booted()
    {
        static::creating(function ($media) {
            $media->slug = Str::slug($media->title);
        });
    }

}
