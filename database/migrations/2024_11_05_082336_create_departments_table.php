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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('department_name')->unique();
            $table->string('department_code')->unique();
            $table->string('department_head', 255); //emp_id
            $table->string('department_alter_head', 255);
            $table->json('department_divisions');
            $table->boolean('is active')->default(true);
            $table->timestamps();
            //$table->foreign('department_head')->references('emp_id')->on('hr')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
