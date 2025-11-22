<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    public $timestamps = false;
    protected $table = 'specification';

    protected $fillable = [
        'specification',
        'description',
        'createdon',
        'modifiedon',
        'insert_ip',
        'status',
        'submittedby',
    ];

    protected static function boot()
    {
        parent::boot();

        // When creating a new specification
        static::creating(function ($specification) {
            $specification->createdon  = now();
            $specification->modifiedon = now();
        });

        // When updating an existing specification
        static::updating(function ($specification) {
            $specification->modifiedon = now();
        });
    }
}
