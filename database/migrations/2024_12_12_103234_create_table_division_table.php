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
        Schema::create('divisions_table', function (Blueprint $table) {
            $table->id();
            $table->string('division_name')->unique();
            $table->string('division_code')->unique();
            $table->string('department_code')->unique();
            $table->foreign('department_code')->references('department_code')->on('departments')->onDelete('cascade');
            $table->string('division_head');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisions_table');
    }
};
