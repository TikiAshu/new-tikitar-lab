<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGrade extends Model
{
    public $timestamps = false;
    protected $table = 'product_grade';

    protected $fillable = [
        'product_id',
        'grade',
        'createdon',
        'modifiedon',
        'insert_ip',
        'status',
        'submittedby',
    ];

    // Relationship to Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Relationship to TestSpecifications
    public function testSpecifications()
    {
        return $this->hasMany(TestSpecification::class, 'product_grade_id');
    }

    protected static function boot()
    {
        parent::boot();

        // When creating a new product grade
        static::creating(function ($productGrade) {
            $productGrade->createdon  = now();
            $productGrade->modifiedon = now();
        });

        // When updating an existing product grade
        static::updating(function ($productGrade) {
            $productGrade->modifiedon = now();
        });
    }
}
