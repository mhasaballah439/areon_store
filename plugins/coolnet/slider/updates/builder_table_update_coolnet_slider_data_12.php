<?php namespace Coolnet\Slider\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetSliderData12 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_slider_data', function($table)
        {
            $table->string('sub_title', 191)->nullable();
            $table->dropColumn('left_text');
            $table->dropColumn('right_text');
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_slider_data', function($table)
        {
            $table->dropColumn('sub_title');
            $table->string('left_text', 191)->nullable();
            $table->string('right_text', 191)->nullable();
        });
    }
}
