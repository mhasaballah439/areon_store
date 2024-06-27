<?php namespace Coolnet\Websetting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetWebsettingData25 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_websetting_data', function($table)
        {
            $table->boolean('mobile_discount_status')->default(0);
            $table->integer('mobile_discount')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_websetting_data', function($table)
        {
            $table->dropColumn('mobile_discount_status');
            $table->dropColumn('mobile_discount');
        });
    }
}
