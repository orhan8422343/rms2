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
            $table->string('feature_section_bg_image',50)->nullable();
            $table->string('special_section_bg_image',50)->nullable();
            $table->string('footer_section_bg_image',50)->nullable();
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
            $table->dropColumn('feature_section_bg_image');
            $table->dropColumn('special_section_bg_image');
            $table->dropColumn('footer_section_bg_image');
        });
    }
};
