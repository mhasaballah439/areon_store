<?php namespace Coolnet\Slider\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetSliderData14 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_slider_data', function($table)
        {
            $table->string('left_text')->nullable();
            $table->string('right_text')->nullable();
            $table->dropColumn('sub_title');
            $table->dropColumn('btn_text');
            $table->dropColumn('btn_url');
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_slider_data', function($table)
        {
            $table->dropColumn('left_text');
            $table->dropColumn('right_text');
            $table->string('sub_title', 191)->nullable();
            $table->string('btn_text', 191)->nullable();
            $table->string('btn_url', 191)->nullable();
        });
    }
}