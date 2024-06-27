<?php namespace Coolnet\Slider\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetSliderData8 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_slider_data', function($table)
        {
            $table->string('btn_border_color')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_slider_data', function($table)
        {
            $table->dropColumn('btn_border_color');
        });
    }
}
