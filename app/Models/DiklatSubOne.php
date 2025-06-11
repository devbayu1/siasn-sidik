<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DiklatSubOne extends Model
{
    protected $fillable = ['diklat_id', 'name', 'slug'];

    public function diklat()
    {
        return $this->belongsTo(Diklat::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getDiklatNameAttribute()
    {
        return $this->diklat ? $this->diklat->name : 'Diklat Tidak Ditemukan';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = Str::slug($post->name) . '-' . Str::random(5);
        });
    }
}
