<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestSubParameter extends Model
{
    public $timestamps = false;
    protected $table = 'test_sub_parameters';

    protected $fillable = [
        'test_parameter_id',
        'parameter',
        'createdon',
        'modifiedon',
        'insert_ip',
        'status',
        'submittedby',
    ];

    // Relationships
    public function testParameter()
    {
        return $this->belongsTo(TestParameter::class, 'test_parameter_id');
    }

    public function testParameterRequirements()
    {
        return $this->hasMany(TestParameterRequirement::class, 'test_sub_parameter_id');
    }

    protected static function boot()
    {
        parent::boot();

        // When creating a new test sub parameter
        static::creating(function ($testSubParameter) {
            $testSubParameter->createdon  = now();
            $testSubParameter->modifiedon = now();
        });

        // When updating an existing test sub parameter
        static::updating(function ($testSubParameter) {
            $testSubParameter->modifiedon = now();
        });
    }
}
