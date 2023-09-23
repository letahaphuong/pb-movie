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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_english');
            $table->string('key_word');
            $table->string('actor_name', 50);
            $table->string('director');
            $table->string('release_year');
            $table->dateTime('time');
            $table->text('description');
            $table->integer('view');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('movie_type_id');
            $table->unsignedBigInteger('country_id');
            $table->timestamps();


            $table->foreign('category_id')->references('id')->on('categories')->onDelete('no action');
            $table->foreign('movie_type_id')->references('id')->on('movie_types')->onDelete('no action');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('no action');
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
