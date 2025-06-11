<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'icon',
        'title',
        'description',
        'order',
    ];
}
