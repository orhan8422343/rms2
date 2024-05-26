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
            
            $table->string('hero_section_author_name',30)->nullable();
            $table->string('hero_section_author_image',50)->nullable();
            $table->string('hero_section_author_designation',30)->nullable();
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
            
            $table->dropColumn('hero_section_author_name');
            $table->dropColumn('hero_section_author_image');
            $table->dropColumn('hero_section_author_designation');
        });
    }
};
