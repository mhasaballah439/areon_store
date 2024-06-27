<?php namespace Coolnet\Slider\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetSliderData5 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_slider_data', function($table)
        {
            $table->integer('top_title_size')->nullable(false)->default(10)->change();
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_slider_data', function($table)
        {
            $table->integer('top_title_size')->nullable()->default(null)->change();
        });
    }
}
