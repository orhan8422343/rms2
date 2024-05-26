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
        Schema::table('intro_points', function (Blueprint $table) {
            
            $table->integer('intro_section_rating_point')->nullable();
            $table->string('intro_section_rating_symbol',20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('intro_points', function (Blueprint $table) {
            //
            $table->dropColumn('intro_section_rating_point');
            $table->dropColumn('intro_section_rating_symbol');
        });
    }
};
