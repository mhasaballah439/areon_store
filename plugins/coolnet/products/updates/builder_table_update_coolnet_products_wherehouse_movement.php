<?php namespace Coolnet\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetProductsWherehouseMovement extends Migration
{
    public function up()
    {
        Schema::table('coolnet_products_wherehouse_movement', function($table)
        {
            $table->dropColumn('note');
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_products_wherehouse_movement', function($table)
        {
            $table->text('note')->nullable();
        });
    }
}
