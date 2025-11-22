<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'product_code',
        'product_name',
        'product_description',
        'grade',
        'createdon',
        'modifiedon',
        'insert_ip',
        // 'status',
        'submittedby',
    ];

    // Relationships
    public function productGrades()
    {
        return $this->hasMany(ProductGrade::class, 'product_id');
    }

    public function testSpecifications()
    {
        return $this->hasMany(TestSpecification::class, 'product_id');
    }

    // Check if product has grades
    public function hasGrades()
    {
        return $this->productGrades()->where('status', '1')->exists();
    }

    protected static function boot()
    {
        parent::boot();

        // When creating a new product
        static::creating(function ($product) {
            $product->createdon  = now();
            $product->modifiedon = now();
        });

        // When updating an existing product
        static::updating(function ($product) {
            $product->modifiedon = now();
        });
    }
}
