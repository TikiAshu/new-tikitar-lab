<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FactoryLocation extends Model
{
    public $timestamps = false;
    protected $table = 'factory_location';

    protected $fillable = [
        'factory_code',
        'factory_location',
        'city',
        'state',
        'country',
        'address',
        'createdon',
        'modifiedon',
        'insert_ip',
        'status',
        'submittedby',
    ];

    protected static function boot()
    {
        parent::boot();

        // When creating a new factory location
        static::creating(function ($factoryLocation) {
            $factoryLocation->createdon  = now();
            $factoryLocation->modifiedon = now();
        });

        // When updating an existing factory location
        static::updating(function ($factoryLocation) {
            $factoryLocation->modifiedon = now();
        });
    }
}
