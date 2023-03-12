<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->foreignId('country_id')->constrained();
            $table->unsignedSmallInteger('duration');
            $table->year('year_of_issue');
            $table->unsignedTinyInteger('age');
            $table->string('link_img')->nullable();
            $table->string('link_kinopoisk')->nullable();
            $table->string('link_video');
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films');
    }
};