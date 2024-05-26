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
            

            $table->string('testimonial_section_top_shape_image',50)->nullable();
            $table->string('testimonial_section_bottom_shape_image',50)->nullable();
            
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
            
            $table->dropColumn('testimonial_section_top_shape_image');
            $table->dropColumn('testimonial_section_bottom_shape_image');
        });
    }
};
