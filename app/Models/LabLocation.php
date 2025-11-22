<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabLocation extends Model
{
    public $timestamps = false;
    protected $table = 'lab_location';

    protected $fillable = [
        'lab_location',
        'lab_code',
        'city',
        'state',
        'country',
        'address',
        'phone',
        'fax',
        'email',
        'createdon',
        'modifiedon',
        'insert_ip',
        'status',
        'submittedby',
    ];

    protected static function boot()
    {
        parent::boot();

        // When creating a new lab location
        static::creating(function ($labLocation) {
            $labLocation->createdon  = now();
            $labLocation->modifiedon = now();
        });

        // When updating an existing lab location
        static::updating(function ($labLocation) {
            $labLocation->modifiedon = now();
        });
    }
}
