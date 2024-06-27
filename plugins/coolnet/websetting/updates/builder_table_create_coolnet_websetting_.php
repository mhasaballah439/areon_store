<?php namespace Coolnet\Websetting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateCoolnetWebsetting extends Migration
{
    public function up()
    {
        Schema::create('coolnet_websetting_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('coolnet_websetting_');
    }
}
