<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Institute;
use App\Models\Education;
use App\Models\Major;
use App\ReligionEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Employee extends Model
{
    protected $fillable = [
        'uuid',
        'pns_id',
        'old_nip',
        'nip',
        'name',
        'degree_prefix',
        'degree_suffix',
        'national_id',
        'birth_place',
        'birth_date',
        'gender',
        'religion',
        'phone',
        'email',
        'unit',
        'institute_id',
        'education_id',
        'major_id',
    ];

    protected $casts = [
        'religion' => ReligionEnum::class,
    ];

    protected static function boot()
    {
        parent::boot();

        // Generate UUID on creating
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    // Relationships
    public function trainings()
    {
        return $this->hasMany(Training::class, 'employee_id', 'uuid');
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function education()
    {
        return $this->belongsTo(Education::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

}
