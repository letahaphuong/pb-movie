<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn('time');
        });
        Schema::table('movies', function (Blueprint $table) {
            $table->string('time');
        });
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn('view');
        });
        Schema::table('movies', function (Blueprint $table) {
            $table->integer('view')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
