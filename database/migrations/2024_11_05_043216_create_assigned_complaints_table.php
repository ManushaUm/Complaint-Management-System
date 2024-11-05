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
        Schema::create('as_complaints', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('insured');
            $table->string('relation')->nullable();
            $table->string('address');
            $table->string('contact_no');
            $table->string('email');
            $table->string('customer_type')->nullable();
            $table->string('policy_number')->nullable();
            $table->date('complaint_date');
            $table->string('department')->default('not assigned');
            $table->string('division')->default('not assigned');
            $table->text('complaint_detail')->nullable();
            $table->string('attachment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigned_complaints');
    }
};
