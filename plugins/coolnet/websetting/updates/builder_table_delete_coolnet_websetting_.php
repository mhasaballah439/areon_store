<?php namespace Coolnet\Websetting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteCoolnetWebsetting extends Migration
{
    public function up()
    {
        Schema::dropIfExists('coolnet_websetting_');
    }
    
    public function down()
    {
        Schema::create('coolnet_websetting_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id');
        });
    }
}
