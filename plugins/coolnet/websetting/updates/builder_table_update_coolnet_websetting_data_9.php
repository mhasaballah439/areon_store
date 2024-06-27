<?php namespace Coolnet\Websetting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetWebsettingData9 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_websetting_data', function($table)
        {
            $table->string('send_sell_to_client')->nullable();
            $table->string('sent_sell_to_email')->nullable();
            $table->string('send_sell_to_name')->nullable();
            $table->string('send_req_to_client')->nullable();
            $table->string('sent_req_to_email')->nullable();
            $table->string('send_req_to_name')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_websetting_data', function($table)
        {
            $table->dropColumn('send_sell_to_client');
            $table->dropColumn('sent_sell_to_email');
            $table->dropColumn('send_sell_to_name');
            $table->dropColumn('send_req_to_client');
            $table->dropColumn('sent_req_to_email');
            $table->dropColumn('send_req_to_name');
        });
    }
}
