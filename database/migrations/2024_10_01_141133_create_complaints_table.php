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
        Schema::create('new_complaints', function (Blueprint $table) {
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
            $table->text('complaint_detail')->nullable();
            $table->string('attachment')->nullable();
            $table->string('department')->nullable();
            $table->string('division')->nullable();
            $table->boolean('complaint_status')->default(0);
            $table->boolean('is_closed')->default(0);
            $table->boolean('is_approved')->default(0);
            $table->string('logged_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
};
