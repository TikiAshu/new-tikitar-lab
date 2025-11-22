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
        Schema::create('test_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_specification_id');
            $table->integer('test_parameter_id');
            $table->integer('test_sub_parameter_id')->nullable();
            $table->integer('test_parameter_requirement_id');
            $table->integer('test_method_id');
            $table->enum('is_required', ['Yes', 'No'])->default('No');
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
        Schema::dropIfExists('test_templates');
    }
};
