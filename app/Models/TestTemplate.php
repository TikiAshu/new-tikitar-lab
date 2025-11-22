<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestTemplate extends Model
{
    public $timestamps = false;
    protected $table = 'test_templates';

    protected $fillable = [
        'test_specification_id',
        'test_parameter_id',
        'test_sub_parameter_id',
        'test_parameter_requirement_id',
        'test_method_id',
        'is_required',
        'createdon',
        'modifiedon',
        'insert_ip',
        'status',
        'submittedby',
    ];

    // Relationships
    public function testSpecification()
    {
        return $this->belongsTo(TestSpecification::class, 'test_specification_id');
    }

    public function testParameter()
    {
        return $this->belongsTo(TestParameter::class, 'test_parameter_id');
    }

    public function testSubParameter()
    {
        return $this->belongsTo(TestSubParameter::class, 'test_sub_parameter_id');
    }

    public function testParameterRequirement()
    {
        return $this->belongsTo(TestParameterRequirement::class, 'test_parameter_requirement_id');
    }

    public function testMethod()
    {
        return $this->belongsTo(TestMethod::class, 'test_method_id');
    }

    protected static function boot()
    {
        parent::boot();

        // When creating a new test template
        static::creating(function ($testTemplate) {
            $testTemplate->createdon  = now();
            $testTemplate->modifiedon = now();
        });

        // When updating an existing test template
        static::updating(function ($testTemplate) {
            $testTemplate->modifiedon = now();
        });
    }
}
