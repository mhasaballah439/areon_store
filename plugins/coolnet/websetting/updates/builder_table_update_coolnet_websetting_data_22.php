<?php namespace Coolnet\Websetting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetWebsettingData22 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_websetting_data', function($table)
        {
            $table->string('icon', 191)->default('null');
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_websetting_data', function($table)
        {
            $table->dropColumn('icon');
        });
    }
}
