<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestMethod extends Model
{
    public $timestamps = false;
    protected $table = 'test_methods';

    protected $fillable = [
        'specification_id',
        'title',
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

    protected static function boot()
    {
        parent::boot();

        // When creating a new test method
        static::creating(function ($testMethod) {
            $testMethod->createdon  = now();
            $testMethod->modifiedon = now();
        });

        // When updating an existing test method
        static::updating(function ($testMethod) {
            $testMethod->modifiedon = now();
        });
    }
}
