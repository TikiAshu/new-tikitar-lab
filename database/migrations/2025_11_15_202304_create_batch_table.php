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
        Schema::create('batch', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->nullable();
            $table->integer('product_grade_id');
            $table->integer('specification_id')->nullable();
            $table->string('test_type', 50)->nullable();
            $table->integer('factory_id')->nullable();
            $table->integer('lab_id')->nullable();
            $table->string('batch_number', 45)->nullable();
            $table->string('date_receipt', 45)->nullable();
            $table->date('date_perfomance');
            $table->float('quantity')->nullable();
            $table->string('unit', 45)->nullable();
            $table->string('sample_condition', 45)->nullable();
            $table->string('sample', 50);
            $table->string('batch_status', 45)->nullable();
            $table->integer('employee_id');
            $table->integer('approved_id');
            $table->integer('reports_id');
            $table->dateTime('createdon');
            $table->dateTime('modifiedon');
            $table->string('insert_ip', 30);
            $table->enum('status', ['0', '1'])->default('1');
            $table->integer('submittedby');
            $table->unique('id', 'id_UNIQUE');
            $table->index('product_id', 'product_batch_idx');
            $table->index('specification_id', 'specification_batch_idx');
            
            // Foreign key constraints
            $table->foreign('product_id', 'product_batch')
                ->references('id')->on('products')
                ->onUpdate('no action')
                ->onDelete('no action');
                
            $table->foreign('specification_id', 'specification_batch')
                ->references('id')->on('specification')
                ->onUpdate('no action')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch');
    }
};
