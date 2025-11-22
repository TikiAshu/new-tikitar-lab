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
        Schema::create('test_sub_parameters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_parameter_id')->nullable();
            $table->string('parameter', 200)->nullable();
            $table->dateTime('createdon');
            $table->dateTime('modifiedon');
            $table->string('insert_ip', 30);
            $table->enum('status', ['0', '1'])->default('1');
            $table->integer('submittedby');
            $table->unique('id', 'id_UNIQUE');
            $table->index('test_parameter_id', 'test_parameter_sub_idx');
            
            // Foreign key constraint
            $table->foreign('test_parameter_id', 'test_parameter_sub')
                ->references('id')->on('test_parameters')
                ->onUpdate('no action')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_sub_parameters');
    }
};
