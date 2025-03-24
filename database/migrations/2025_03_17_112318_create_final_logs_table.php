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
        Schema::create('final_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reference');
            $table->string('remarks');
            $table->string('remarks_by');
            $table->string('status');
            $table->string('attachment_path')->nullable();
            $table->string('attachment_name')->nullable();
            $table->timestamps();

            //foreign keys
            $table->foreign('reference')->references('id')->on('new_complaints')->onDelete('no action');
            $table->foreign('remarks_by')->references('emp_id')->on('hr')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('final_logs');
    }
};
