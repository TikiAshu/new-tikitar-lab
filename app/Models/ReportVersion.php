<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportVersion extends Model
{
    public $timestamps = false;
    protected $table = 'report_version';

    protected $fillable = [
        'batch_id',
        'test_type',
        'start_date',
        'date_perform',
        'report_status',
        'version',
        'chemist_comment',
        'approved_by',
        'createdon',
        'modifiedon',
        'insert_ip',
        'status',
        'submittedby',
    ];

    // Relationships
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function resultDetails()
    {
        return $this->hasMany(ResultDetail::class, 'result_version_id');
    }

    public function approver()
    {
        return $this->belongsTo(Employee::class, 'approved_by');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'result_version_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }

    public function scopeByTestType($query, $testType)
    {
        return $query->where('test_type', $testType);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('report_status', $status);
    }

    // Helper methods
    public function isDraft()
    {
        return $this->report_status === 'draft';
    }

    public function isReview()
    {
        return $this->report_status === 'review';
    }

    public function isApproved()
    {
        return $this->report_status === 'approve';
    }

    public function isRejected()
    {
        return $this->report_status === 'reject';
    }

    public function canEdit()
    {
        return $this->isDraft();
    }

    public function canDelete()
    {
        return $this->isDraft();
    }

    protected static function boot()
    {
        parent::boot();

        // When creating a new report version
        static::creating(function ($reportVersion) {
            $reportVersion->createdon = now();
            $reportVersion->modifiedon = now();

            // Auto-increment version number for the batch
            $maxVersion = static::where('batch_id', $reportVersion->batch_id)
                ->max('version');
            $reportVersion->version = ($maxVersion ?? 0) + 1;
        });

        // When updating an existing report version
        static::updating(function ($reportVersion) {
            $reportVersion->modifiedon = now();
        });
    }
}
