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
        Schema::create('new-complaints', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('insured');
            $table->string('relation')->nullable();
            $table->string('address');
            $table->string('contact_no');
            $table->string('email');
            $table->string('customer_type');
            $table->string('policy_number')->nullable();
            $table->date('complaint_date');
            $table->text('complaint_detail');
            $table->string('attachment')->nullable();
            $table->boolean('notify_customer')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
};
