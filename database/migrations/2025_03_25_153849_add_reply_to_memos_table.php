<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('memos', function (Blueprint $table) {
            $table->text('reply')->nullable()->after('content'); // Add the reply field
        });
        Schema::table('memos', function (Blueprint $table) {
            $table->string('specific_employee')->nullable(); // Ensure it's a string
        });
    }

    public function down()
    {
        Schema::table('memos', function (Blueprint $table) {
            $table->dropColumn('reply');
        });
    }
};
