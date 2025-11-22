<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $timestamps = false;
    protected $table = 'employee';

    protected $fillable = [
        'first_name',
        'last_name',
        'designation',
        'email',
        'mobile',
        'sign_image',
        'reporting_to',
        'lab_location_id',
        'factory_location_id',
        'username',
        'password',
        'role',
        'createdon',
        'modifiedon',
        'insert_ip',
        'status',
        'submittedby',
    ];

    protected static function boot()
    {
        parent::boot();

        // Set timestamps when creating
        static::creating(function ($employee) {
            $employee->createdon  = now();
            $employee->modifiedon = now();
        });

        // Update modified timestamp when updating
        static::updating(function ($employee) {
            $employee->modifiedon = now();
        });
    }

    // Optional: Relationships (only if you're using them)
    public function labLocation()
    {
        return $this->belongsTo(LabLocation::class, 'lab_location_id');
    }

    public function factoryLocation()
    {
        return $this->belongsTo(FactoryLocation::class, 'factory_location_id');
    }

    public function reporter()
    {
        return $this->belongsTo(Employee::class, 'reporting_to');
    }
}
