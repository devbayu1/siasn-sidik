<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'mosque_id',
        'type',
        'group',
        'name',
        'slug',
        'value',
        'image',
    ];

}
