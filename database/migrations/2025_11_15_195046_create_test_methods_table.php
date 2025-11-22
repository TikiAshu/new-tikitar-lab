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
        Schema::create('test_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('specification_id')->nullable();
            $table->string('title', 45)->nullable();
            $table->dateTime('createdon');
            $table->dateTime('modifiedon');
            $table->string('insert_ip', 30);
            $table->enum('status', ['0', '1'])->default('1');
            $table->integer('submittedby');
            $table->unique('id', 'id_UNIQUE');
            $table->index('specification_id', 'specification_method_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_methods');
    }
};
