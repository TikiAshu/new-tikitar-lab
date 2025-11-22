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
        Schema::create('test_parameter_rquirement', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_parameter_id')->nullable();
            $table->integer('test_sub_parameter_id')->nullable()->default(0);
            $table->integer('product_grade_id')->nullable();
            $table->integer('product_id');
            $table->string('requirement_type', 45)->nullable();
            $table->float('minimum')->nullable();
            $table->float('maximum')->nullable();
            $table->string('value', 45)->nullable();
            $table->string('units', 45)->nullable();
            $table->dateTime('createdon');
            $table->dateTime('modifiedon');
            $table->string('insert_ip', 30);
            $table->enum('status', ['0', '1'])->default('1');
            $table->integer('submittedby');
            $table->unique('id', 'id_UNIQUE');
            $table->index('product_grade_id', 'grade_rqn_idx');
            $table->index('test_parameter_id', 'parameter_rqn_idx');
            $table->index('test_sub_parameter_id', 'sub_parameter_rqns_idx');
            
            // Foreign key constraint
            $table->foreign('test_parameter_id', 'parameter_rqns')
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
        Schema::dropIfExists('test_parameter_rquirement');
    }
};
