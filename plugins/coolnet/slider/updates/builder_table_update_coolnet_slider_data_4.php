<?php namespace Coolnet\Slider\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetSliderData4 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_slider_data', function($table)
        {
            $table->string('main_title_x')->nullable();
            $table->string('main_title_y')->nullable();
            $table->string('sub_title_x')->nullable();
            $table->string('sub_title_y')->nullable();
            $table->string('btn_x')->nullable();
            $table->string('btn_y')->nullable();
            $table->string('top_title')->nullable();
            $table->integer('top_title_size')->nullable();
            $table->string('top_title_color')->nullable();
            $table->string('top_title_x')->nullable();
            $table->string('top_title_y')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_slider_data', function($table)
        {
            $table->dropColumn('main_title_x');
            $table->dropColumn('main_title_y');
            $table->dropColumn('sub_title_x');
            $table->dropColumn('sub_title_y');
            $table->dropColumn('btn_x');
            $table->dropColumn('btn_y');
            $table->dropColumn('top_title');
            $table->dropColumn('top_title_size');
            $table->dropColumn('top_title_color');
            $table->dropColumn('top_title_x');
            $table->dropColumn('top_title_y');
        });
    }
}
