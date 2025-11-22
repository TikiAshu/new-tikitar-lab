<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestParameter extends Model
{
    public $timestamps = false;
    protected $table = 'test_parameters';

    protected $fillable = [
        'specification_id',
        'test_parameter',
        'sub_parameter',
        'createdon',
        'modifiedon',
        'insert_ip',
        'status',
        'submittedby',
    ];

    // Relationship to Specification
    public function specification()
    {
        return $this->belongsTo(Specification::class, 'specification_id');
    }

    // Relationship to Test Sub Parameters
    public function testSubParameters()
    {
        return $this->hasMany(TestSubParameter::class, 'test_parameter_id');
    }

    // Relationship to Test Parameter Requirements
    public function testParameterRequirements()
    {
        return $this->hasMany(TestParameterRequirement::class, 'test_parameter_id');
    }

    protected static function boot()
    {
        parent::boot();

        // When creating a new test parameter
        static::creating(function ($testParameter) {
            $testParameter->createdon  = now();
            $testParameter->modifiedon = now();
        });

        // When updating an existing test parameter
        static::updating(function ($testParameter) {
            $testParameter->modifiedon = now();
        });
    }
}
