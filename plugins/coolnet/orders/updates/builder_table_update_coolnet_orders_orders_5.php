<?php namespace Coolnet\Orders\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetOrdersOrders5 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_orders_orders', function($table)
        {
            $table->integer('warehouse_id')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_orders_orders', function($table)
        {
            $table->dropColumn('warehouse_id');
        });
    }
}
