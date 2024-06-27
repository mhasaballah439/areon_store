<?php namespace Coolnet\Websetting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetWebsettingData19 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_websetting_data', function($table)
        {
            $table->string('pk_live')->nullable();
            $table->string('sk_live')->nullable();
            $table->string('pk_test')->nullable();
            $table->string('sk_test')->nullable();
            $table->boolean('active_test')->default(0);
            $table->string('currency')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_websetting_data', function($table)
        {
            $table->dropColumn('pk_live');
            $table->dropColumn('sk_live');
            $table->dropColumn('pk_test');
            $table->dropColumn('sk_test');
            $table->dropColumn('active_test');
            $table->dropColumn('currency');
        });
    }
}
