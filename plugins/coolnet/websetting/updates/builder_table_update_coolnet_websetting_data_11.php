<?php namespace Coolnet\Websetting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetWebsettingData11 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_websetting_data', function($table)
        {
            $table->string('color')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_websetting_data', function($table)
        {
            $table->dropColumn('color');
        });
    }
}
