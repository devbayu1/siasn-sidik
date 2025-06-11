<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Diklat extends Model
{
    protected $fillable = ['name', 'slug'];

    public function subOnes()
    {
        return $this->hasMany(DiklatSubOne::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = Str::slug($post->name) . '-' . Str::random(5);
        });
    }
}
