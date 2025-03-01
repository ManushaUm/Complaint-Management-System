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
        Schema::create('complaint_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Reference_number');
            $table->string('Department');
            $table->string('Sub_division');
            $table->string('Notes');
            $table->string('Notes_by');
            $table->string('Assigned_to')->default(null);
            $table->string('Status')->default('Received');
            $table->string('Priority')->default('Not-set');
            $table->string('Comment_by')->default(null);
            $table->string('Comment')->nullable();
            $table->timestamps();

            // $table->foreign('Reference_number')->references('id')->on('new_complaints')->onDelete('no action'); //this one set by outside 
            $table->foreign('Department')->references('department_code')->on('departments')->onDelete('no action');
            $table->foreign('Comment_by')->references('emp_id')->on('hr')->onDelete('no action');
            $table->foreign('Notes_by')->references('emp_id')->on('hr')->onDelete('no action');
            $table->foreign('Sub_division')->references('division_code')->on('divisions_table')->onDelete('no action');
            $table->foreign('Assigned_to')->references('emp_id')->on('hr')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_complaint_logs');
    }
};
