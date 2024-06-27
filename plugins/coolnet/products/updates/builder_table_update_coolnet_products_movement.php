<?php namespace Coolnet\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetProductsMovement extends Migration
{
    public function up()
    {
        Schema::table('coolnet_products_movement', function($table)
        {
            $table->boolean('is_import')->default(1)->change();
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_products_movement', function($table)
        {
            $table->boolean('is_import')->default(0)->change();
        });
    }
}
