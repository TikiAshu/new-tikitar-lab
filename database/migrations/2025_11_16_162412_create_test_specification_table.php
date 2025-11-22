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
        Schema::create('test_specification', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('product_grade_id');
            $table->integer('specification_id');
            $table->enum('test_type', ['NON-NABL', 'NABL'])->nullable()->default(null);
            $table->dateTime('createdon');
            $table->dateTime('modifiedon');
            $table->string('insert_ip', 30);
            $table->enum('status', ['0', '1'])->default('1');
            $table->integer('submittedby');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_specification');
    }
};
