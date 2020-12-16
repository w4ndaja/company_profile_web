<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('logo')->nullable();
            $table->string('mini_logo')->nullable();
            $table->string('primary_font_family_name')->nullable();
            $table->string('primary_font_family_url')->nullable();
            $table->string('secondary_font_family_name')->nullable();
            $table->string('secondary_font_family_url')->nullable();
            $table->string('tertiary_font_family_name')->nullable();
            $table->string('tertiary_font_family_url')->nullable();
            $table->string('primary_text_color')->nullable();
            $table->string('secondary_text_color')->nullable();
            $table->string('tertiary_text_color')->nullable();
            $table->string('primary_background_color')->nullable();
            $table->string('secondary_background_color')->nullable();
            $table->string('tertiary_background_color')->nullable();
            $table->string('header_background')->nullable();
            $table->text('footer')->nullable();
            $table->text('home')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('themes');
    }
}
