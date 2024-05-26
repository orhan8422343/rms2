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
        Schema::table('basic_settings', function (Blueprint $table) {
            

            //Button 
            $table->integer('intro_section_button_font_size')->nullable();
            $table->text('intro_section_button_url')->nullable();
            $table->string('intro_section_button_text',50)->nullable();
            $table->string('intro_section_button_color',30)->nullable();

            //video Button

            $table->text('intro_section_video_button_url')->nullable();
            $table->string('intro_section_video_button_text',100)->nullable();
            $table->string('intro_section_video_button_title',100)->nullable();

            //Highligh text
            $table->text('intro_section_highlight_text')->nullable();
            $table->string('intro_section_bg_image',50)->nullable();

            //author 

            $table->string('intro_section_author_image',50)->nullable();
            $table->string('intro_section_author_name',30)->nullable();
            $table->string('intro_section_author_designation',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('basic_settings', function (Blueprint $table) {
            $table->dropColumn('intro_section_button_font_size');
            $table->dropColumn('intro_section_button_url');
            $table->dropColumn('intro_section_button_text');
            $table->dropColumn('intro_section_button_color');

            $table->dropColumn('intro_section_video_button_url');
            $table->dropColumn('intro_section_video_button_text');
            $table->dropColumn('intro_section_video_button_title');

            $table->dropColumn('intro_section_highlight_text');
            $table->dropColumn('intro_section_bg_image');

            $table->dropColumn('intro_section_author_image');
            $table->dropColumn('intro_section_author_name');
            $table->dropColumn('intro_section_author_designation');


        });
    }
};
