<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestSpecification extends Model
{
    public $timestamps = false;
    protected $table = 'test_specification';

    protected $fillable = [
        'product_id',
        'product_grade_id',
        'specification_id',
        'test_type',
        'createdon',
        'modifiedon',
        'insert_ip',
        'status',
        'submittedby',
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productGrade()
    {
        return $this->belongsTo(ProductGrade::class, 'product_grade_id');
    }

    public function specification()
    {
        return $this->belongsTo(Specification::class, 'specification_id');
    }

    public function testTemplates()
    {
        return $this->hasMany(TestTemplate::class, 'test_specification_id');
    }

    protected static function boot()
    {
        parent::boot();

        // When creating a new test specification
        static::creating(function ($testSpecification) {
            $testSpecification->createdon  = now();
            $testSpecification->modifiedon = now();
        });

        // When updating an existing test specification
        static::updating(function ($testSpecification) {
            $testSpecification->modifiedon = now();
        });
    }
}
