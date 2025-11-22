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
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('report_code', 45)->nullable();
            $table->integer('batch_id');
            $table->integer('result_version_id')->nullable();
            $table->text('certification')->nullable();
            $table->float('quantity')->nullable();
            $table->string('unit', 45)->nullable();
            $table->date('date_issue')->nullable();
            $table->integer('employee_id')->nullable();
            $table->enum('client_type', ['internal', 'external']);
            $table->integer('assign_id');
            $table->integer('client_id')->nullable();
            $table->text('party_ref');
            $table->text('project');
            $table->enum('show_logo', ['Yes', 'No']);
            $table->enum('show_report_code', ['Yes', 'No'])->default('Yes');
            $table->text('address');
            $table->string('phone', 100);
            $table->string('fax', 100);
            $table->string('email', 100);
            $table->dateTime('createdon');
            $table->dateTime('modifiedon');
            $table->string('insert_ip', 30);
            $table->enum('status', ['0', '1'])->default('1');
            $table->integer('submittedby');
            $table->string('truck_no', 45)->nullable();
            $table->string('invoice_no', 45)->nullable();
            $table->string('nabl_report', 45)->nullable();
            $table->string('ulr_number', 45)->nullable();
            
            $table->unique('id', 'id_UNIQUE');
            $table->index('client_id', 'client_report_idx');
            $table->index('employee_id', 'employee_report_idx');
            $table->index('result_version_id', 'result_version_report_idx');
            
            $table->foreign('employee_id', 'employee_reports')
                ->references('id')->on('employee')
                ->onUpdate('no action')
                ->onDelete('no action');
            
            $table->foreign('result_version_id', 'result_version_reports')
                ->references('id')->on('report_version')
                ->onUpdate('no action')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};

