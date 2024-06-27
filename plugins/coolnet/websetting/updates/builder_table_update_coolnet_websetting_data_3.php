<?php namespace Coolnet\Websetting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetWebsettingData3 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_websetting_data', function($table)
        {
            $table->integer('product_code')->default(2502);
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_websetting_data', function($table)
        {
            $table->dropColumn('product_code');
        });
    }
}
