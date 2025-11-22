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
        Schema::create('result_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('result_version_id');
            $table->integer('test_parameter_id');
            $table->integer('test_sub_parameter_id')->nullable();
            $table->integer('test_parameter_requirement_id')->nullable();
            $table->integer('test_method_id')->nullable();
            $table->string('result', 255)->nullable();
            $table->text('comment')->nullable();
            $table->enum('is_required', ['Yes', 'No'])->default('No');
            $table->enum('approve', ['Yes', 'No'])->default('No');
            $table->dateTime('createdon');
            $table->dateTime('modifiedon');
            $table->string('insert_ip', 30)->nullable();
            $table->enum('status', ['0', '1'])->default('1');
            $table->integer('submittedby');
            
            // Foreign key constraints
            $table->foreign('result_version_id', 'result_version_details')
                ->references('id')->on('report_version')
                ->onUpdate('no action')
                ->onDelete('cascade');
            
            $table->foreign('test_parameter_id', 'test_parameter_details')
                ->references('id')->on('test_parameters')
                ->onUpdate('no action')
                ->onDelete('no action');
            
            // Indexes
            $table->index('result_version_id', 'result_version_idx');
            $table->index('test_parameter_id', 'test_parameter_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result_details');
    }
};
