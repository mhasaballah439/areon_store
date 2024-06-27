<?php namespace Coolnet\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetProductsWarehouseLog extends Migration
{
    public function up()
    {
        Schema::table('coolnet_products_warehouse_log', function($table)
        {
            $table->integer('qty')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_products_warehouse_log', function($table)
        {
            $table->dropColumn('qty');
        });
    }
}
