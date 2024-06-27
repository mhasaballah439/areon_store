<?php namespace Coolnet\Orders\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetOrdersOrders extends Migration
{
    public function up()
    {
        Schema::table('coolnet_orders_orders', function($table)
        {
            $table->renameColumn('payment_method', 'payment');
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_orders_orders', function($table)
        {
            $table->renameColumn('payment', 'payment_method');
        });
    }
}
