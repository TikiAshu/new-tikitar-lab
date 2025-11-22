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
        Schema::create('report_version', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('batch_id');
            $table->enum('test_type', ['NABL', 'NON-NABL']);
            $table->date('start_date');
            $table->date('date_perform');
            $table->enum('report_status', ['draft', 'review', 'approve', 'reject'])->default('draft');
            $table->integer('version')->default(1);
            $table->text('chemist_comment')->nullable();
            $table->integer('approved_by')->nullable();
            $table->dateTime('createdon');
            $table->dateTime('modifiedon');
            $table->string('insert_ip', 30)->nullable();
            $table->enum('status', ['0', '1'])->default('1');
            $table->integer('submittedby');
            
            // Foreign key constraints
            $table->foreign('batch_id', 'batch_report_version')
                ->references('id')->on('batch')
                ->onUpdate('no action')
                ->onDelete('no action');
            
            // Unique constraint: only one NABL and one NON-NABL per batch
            $table->unique(['batch_id', 'test_type'], 'batch_test_type_unique');
            
            // Indexes
            $table->index('batch_id', 'batch_report_version_idx');
            $table->index('report_status', 'report_status_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_version');
    }
};
