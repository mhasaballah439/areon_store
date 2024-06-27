<?php namespace Coolnet\Slider\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetSliderData6 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_slider_data', function($table)
        {
            $table->integer('main_title_hoff')->default(0);
            $table->integer('main_title_voff')->default(0);
            $table->integer('sub_title_hoff')->default(0);
            $table->integer('sub_title_voff')->default(0);
            $table->integer('top_title_hoff')->default(0);
            $table->integer('top_title_voff')->default(0);
            $table->integer('btn_hoff')->default(0);
            $table->integer('btn_voff')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_slider_data', function($table)
        {
            $table->dropColumn('main_title_hoff');
            $table->dropColumn('main_title_voff');
            $table->dropColumn('sub_title_hoff');
            $table->dropColumn('sub_title_voff');
            $table->dropColumn('top_title_hoff');
            $table->dropColumn('top_title_voff');
            $table->dropColumn('btn_hoff');
            $table->dropColumn('btn_voff');
        });
    }
}
