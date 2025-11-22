<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public $timestamps = false;
    protected $table = 'reports';

    protected $fillable = [
        'report_code',
        'batch_id',
        'result_version_id',
        'certification',
        'quantity',
        'unit',
        'date_issue',
        'employee_id',
        'client_type',
        'assign_id',
        'client_id',
        'party_ref',
        'project',
        'show_logo',
        'show_report_code',
        'address',
        'phone',
        'fax',
        'email',
        'createdon',
        'modifiedon',
        'insert_ip',
        'status',
        'submittedby',
        'truck_no',
        'invoice_no',
        'nabl_report',
        'ulr_number',
    ];

    // Relationships
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function reportVersion()
    {
        return $this->belongsTo(ReportVersion::class, 'result_version_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function assign()
    {
        return $this->belongsTo(Employee::class, 'assign_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }

    protected static function boot()
    {
        parent::boot();

        // When creating a new report
        static::creating(function ($report) {
            $report->createdon = now();
            $report->modifiedon = now();
        });

        // When updating an existing report
        static::updating(function ($report) {
            $report->modifiedon = now();
        });
    }
}

