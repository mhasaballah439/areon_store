<?php namespace Coolnet\Slider\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetSliderData10 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_slider_data', function($table)
        {
            $table->string('main_title_size', 100)->nullable(false)->unsigned(false)->default('10')->change();
            $table->string('sub_title_size', 100)->nullable(false)->unsigned(false)->default('10')->change();
            $table->string('top_title_size', 100)->nullable(false)->unsigned(false)->default('10')->change();
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_slider_data', function($table)
        {
            $table->integer('main_title_size')->nullable(false)->unsigned(false)->default(10)->change();
            $table->integer('sub_title_size')->nullable(false)->unsigned(false)->default(10)->change();
            $table->integer('top_title_size')->nullable(false)->unsigned(false)->default(10)->change();
        });
    }
}
