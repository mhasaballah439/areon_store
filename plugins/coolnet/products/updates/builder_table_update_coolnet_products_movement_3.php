<?php namespace Coolnet\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetProductsMovement3 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_products_movement', function($table)
        {
            $table->text('note')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_products_movement', function($table)
        {
            $table->dropColumn('note');
        });
    }
}
