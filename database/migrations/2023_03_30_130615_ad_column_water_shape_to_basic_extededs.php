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
        Schema::table('basic_extendeds', function (Blueprint $table) {

            $table->string('hero_section_water_shape_text')->nullable();
            $table->integer('hero_section_water_shape_text_font_size')->nullable();
            $table->string('hero_section_water_shape_text_color',30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('basic_extendeds', function (Blueprint $table) {

            $table->dropColumn('hero_section_water_shape_text');
            $table->dropColumn('hero_section_water_shape_text_font_size');
            $table->dropColumn('hero_section_water_shape_text_color');
        });
    }
};
