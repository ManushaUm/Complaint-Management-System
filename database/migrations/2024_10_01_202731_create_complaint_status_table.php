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
        Schema::create('complaint_status', function (Blueprint $table) {
            $table->string('category');
            $table->string('subcategory');
            $table->string('location')->nullable();;
            $table->string('branch')->nullable();;
            $table->string('resperson');
            $table->string('altperson')->nullable();;
            $table->string('pred')->nullable();;
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_status');
    }
};
