<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $timestamps = false;
    protected $table = 'clients';

    protected $fillable = [
        'client_type',
        'company_name',
        'city',
        'state',
        'address',
        'country',
        'contact_person',
        'email',
        'mobile',
        'phone_number',
        'createdon',
        'modifiedon',
        'insert_ip',
        'status',
        'submittedby',
    ];

    protected static function boot()
    {
        parent::boot();

        // When creating a new client
        static::creating(function ($client) {
            $client->createdon  = now();
            $client->modifiedon = now();
        });

        // When updating an existing client
        static::updating(function ($client) {
            $client->modifiedon = now();
        });
    }
}
