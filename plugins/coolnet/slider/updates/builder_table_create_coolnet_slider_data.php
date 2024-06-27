<?php namespace Coolnet\Slider\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateCoolnetSliderData extends Migration
{
    public function up()
    {
        Schema::create('coolnet_slider_data', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->string('main_title');
            $table->integer('main_title_size');
            $table->string('main_title_color');
            $table->string('sub_title');
            $table->integer('sub_title_size');
            $table->string('sub_title_color');
            $table->string('btn_text');
            $table->string('btn_url');
            $table->string('btn_text_color');
            $table->string('btn_bg');
            $table->integer('btn_text_size');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('coolnet_slider_data');
    }
}
