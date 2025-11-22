<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultDetail extends Model
{
    public $timestamps = false;
    protected $table = 'result_details';

    protected $fillable = [
        'result_version_id',
        'test_parameter_id',
        'test_sub_parameter_id',
        'test_parameter_requirement_id',
        'test_method_id',
        'result',
        'comment',
        'is_required',
        'approve',
        'createdon',
        'modifiedon',
        'insert_ip',
        'status',
        'submittedby',
    ];

    // Relationships
    public function reportVersion()
    {
        return $this->belongsTo(ReportVersion::class, 'result_version_id');
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

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }

    public function scopeRequired($query)
    {
        return $query->where('is_required', 'Yes');
    }

    protected static function boot()
    {
        parent::boot();

        // When creating a new result detail
        static::creating(function ($resultDetail) {
            $resultDetail->createdon = now();
            $resultDetail->modifiedon = now();
        });

        // When updating an existing result detail
        static::updating(function ($resultDetail) {
            $resultDetail->modifiedon = now();
        });
    }
}
