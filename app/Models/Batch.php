<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    public $timestamps = false;
    protected $table = 'batch';

    protected $fillable = [
        'product_id',
        'product_grade_id',
        'specification_id',
        'test_type',
        'factory_id',
        'lab_id',
        'batch_number',
        'date_receipt',
        'date_perfomance',
        'quantity',
        'unit',
        'sample_condition',
        'sample',
        'batch_status',
        'employee_id',
        'approved_id',
        'reports_id',
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

    public function specification()
    {
        return $this->belongsTo(Specification::class, 'specification_id');
    }

    public function factory()
    {
        return $this->belongsTo(FactoryLocation::class, 'factory_id');
    }

    public function lab()
    {
        return $this->belongsTo(LabLocation::class, 'lab_id');
    }

    public function productGrade()
    {
        return $this->belongsTo(ProductGrade::class, 'product_grade_id');
    }

    public function reportVersions()
    {
        return $this->hasMany(ReportVersion::class, 'batch_id');
    }

    protected static function boot()
    {
        parent::boot();

        // When creating a new batch
        static::creating(function ($batch) {
            $batch->createdon  = now();
            $batch->modifiedon = now();
        });

        // When updating an existing batch
        static::updating(function ($batch) {
            $batch->modifiedon = now();
        });
    }
}
