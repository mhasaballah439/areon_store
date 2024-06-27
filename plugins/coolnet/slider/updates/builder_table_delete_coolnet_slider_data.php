<?php namespace Coolnet\Slider\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteCoolnetSliderData extends Migration
{
    public function up()
    {
        Schema::dropIfExists('coolnet_slider_data');
    }
    
    public function down()
    {
        Schema::create('coolnet_slider_data', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->string('main_title', 191);
            $table->string('sub_title', 191)->nullable();
            $table->boolean('active')->default(0);
            $table->integer('sort_order')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
}
