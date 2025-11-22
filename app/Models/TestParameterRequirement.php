<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestParameterRequirement extends Model
{
    public $timestamps = false;
    protected $table = 'test_parameter_rquirement';

    protected $fillable = [
        'test_parameter_id',
        'test_sub_parameter_id',
        'product_grade_id',
        'product_id',
        'requirement_type',
        'minimum',
        'maximum',
        'value',
        'units',
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

    public function testSubParameter()
    {
        return $this->belongsTo(TestSubParameter::class, 'test_sub_parameter_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productGrade()
    {
        return $this->belongsTo(ProductGrade::class, 'product_grade_id');
    }

    protected static function boot()
    {
        parent::boot();

        // When creating a new test parameter requirement
        static::creating(function ($testParameterRequirement) {
            $testParameterRequirement->createdon  = now();
            $testParameterRequirement->modifiedon = now();
        });

        // When updating an existing test parameter requirement
        static::updating(function ($testParameterRequirement) {
            $testParameterRequirement->modifiedon = now();
        });
    }
}
