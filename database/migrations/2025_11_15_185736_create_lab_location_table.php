<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lab_location', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lab_location', 50);
            $table->string('lab_code', 50);
            $table->string('city', 45)->nullable();
            $table->string('state', 45)->nullable();
            $table->string('country', 45)->nullable();
            $table->text('address')->nullable();
            $table->string('phone', 100);
            $table->string('fax', 100);
            $table->string('email', 100);
            $table->dateTime('createdon')->nullable();
            $table->dateTime('modifiedon')->nullable();
            $table->string('insert_ip', 45)->nullable();
            $table->enum('status', ['0', '1'])->default('1');
            $table->integer('submittedby');
            $table->unique('id', 'id_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_location');
    }
};
