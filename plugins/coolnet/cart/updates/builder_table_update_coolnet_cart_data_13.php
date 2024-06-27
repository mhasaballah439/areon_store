<?php namespace Coolnet\Cart\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetCartData13 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_cart_data', function($table)
        {
            $table->integer('data_version')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_cart_data', function($table)
        {
            $table->dropColumn('data_version');
        });
    }
}
