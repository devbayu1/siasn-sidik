<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Diklat;
use App\Models\DiklatSubOne;

class Training extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'employee_id',
        'diklat_id',
        'diklat_sub_id',
        'training_name',
        'organizer',
        'certificate_number',
        'start_date',
        'end_date',
        'year',
        'duration_hours',
        'certificate_file',
        'status',
        'rejection_reason',
        'notes',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'uuid');
    }

    public function diklat()
    {
        return $this->belongsTo(Diklat::class);
    }

    public function diklatSub()
    {
        return $this->belongsTo(DiklatSubOne::class);
    }
}
