<?php namespace Coolnet\Slider\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetSliderData2 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_slider_data', function($table)
        {
            $table->boolean('active');
            $table->integer('main_title_size')->default(10)->change();
            $table->string('main_title_color', 191)->nullable()->change();
            $table->string('sub_title', 191)->nullable()->change();
            $table->integer('sub_title_size')->default(10)->change();
            $table->string('sub_title_color', 191)->nullable()->change();
            $table->string('btn_text', 191)->nullable()->change();
            $table->string('btn_url', 191)->nullable()->change();
            $table->string('btn_text_color', 191)->nullable()->change();
            $table->string('btn_bg', 191)->nullable()->change();
            $table->integer('btn_text_size')->default(10)->change();
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_slider_data', function($table)
        {
            $table->dropColumn('active');
            $table->integer('main_title_size')->default(null)->change();
            $table->string('main_title_color', 191)->nullable(false)->change();
            $table->string('sub_title', 191)->nullable(false)->change();
            $table->integer('sub_title_size')->default(null)->change();
            $table->string('sub_title_color', 191)->nullable(false)->change();
            $table->string('btn_text', 191)->nullable(false)->change();
            $table->string('btn_url', 191)->nullable(false)->change();
            $table->string('btn_text_color', 191)->nullable(false)->change();
            $table->string('btn_bg', 191)->nullable(false)->change();
            $table->integer('btn_text_size')->default(null)->change();
        });
    }
}
