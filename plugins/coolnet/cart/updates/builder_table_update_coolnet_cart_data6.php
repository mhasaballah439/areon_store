<?php namespace Coolnet\Cart\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetCartData6 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_cart_data', function($table)
        {
            $table->decimal('tmps_price', 10, 2)->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_cart_data', function($table)
        {
            $table->dropColumn('tmps_price');
        });
    }
}