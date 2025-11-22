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
        Schema::create('factory_location', function (Blueprint $table) {
            $table->increments('id');
            $table->string('factory_code', 50);
            $table->string('factory_location', 45)->nullable();
            $table->string('city', 45)->nullable();
            $table->string('state', 45)->nullable();
            $table->string('country', 45)->nullable();
            $table->string('address', 45)->nullable();
            $table->dateTime('createdon');
            $table->dateTime('modifiedon');
            $table->string('insert_ip', 30);
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
        Schema::dropIfExists('factory_location');
    }
};
