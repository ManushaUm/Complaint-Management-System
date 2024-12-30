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
        Schema::create('hr', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id')->unique();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->enum('gender', ['male', 'female']);
            $table->string('phone')->nullable();
            $table->string('job_title')->default('not assigned')->nullable();
            $table->string('department', 255)->nullable();
            $table->string('division', 255)->nullable();
            $table->foreign('department')->references('department_code')->on('departments')->onDelete('no action');
            $table->foreign('division')->references('division_code')->on('divisions_table')->onDelete('no action');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hr');
    }
};
