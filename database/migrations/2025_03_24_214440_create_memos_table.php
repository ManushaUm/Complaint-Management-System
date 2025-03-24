<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('memos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('send_to');
            $table->string('specific_employee')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('memos');
    }
};
