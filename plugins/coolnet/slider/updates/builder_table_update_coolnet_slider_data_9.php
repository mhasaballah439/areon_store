<?php namespace Coolnet\Slider\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetSliderData9 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_slider_data', function($table)
        {
            $table->string('top_font')->nullable();
            $table->string('main_font')->nullable();
            $table->string('sub_font')->nullable();
            $table->string('btn_font')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_slider_data', function($table)
        {
            $table->dropColumn('top_font');
            $table->dropColumn('main_font');
            $table->dropColumn('sub_font');
            $table->dropColumn('btn_font');
        });
    }
}
