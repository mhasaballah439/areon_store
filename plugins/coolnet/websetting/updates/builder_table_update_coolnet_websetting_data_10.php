<?php namespace Coolnet\Websetting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetWebsettingData10 extends Migration
{
    public function up()
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
    
    public function down()
    {
        Schema::table('coolnet_websetting_data', function($table)
        {
            $table->string('send_sell_to_client', 191)->nullable();
            $table->string('sent_sell_to_email', 191)->nullable();
            $table->string('send_sell_to_name', 191)->nullable();
            $table->string('send_req_to_client', 191)->nullable();
            $table->string('sent_req_to_email', 191)->nullable();
            $table->string('send_req_to_name', 191)->nullable();
        });
    }
}
