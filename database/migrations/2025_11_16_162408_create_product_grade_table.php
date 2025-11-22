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
        Schema::create('product_grade', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->nullable();
            $table->string('grade', 45)->nullable();
            $table->dateTime('createdon');
            $table->dateTime('modifiedon');
            $table->string('insert_ip', 30);
            $table->enum('status', ['0', '1'])->default('1');
            $table->integer('submittedby');
            $table->unique('id', 'id_UNIQUE');
            $table->index('product_id', 'product_grade_idx');
            
            // Foreign key constraint
            $table->foreign('product_id', 'product_grade')
                ->references('id')->on('products')
                ->onUpdate('no action')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_grade');
    }
};
