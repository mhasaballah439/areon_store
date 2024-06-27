<?php namespace Coolnet\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetProductsProducts5 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_products_products', function($table)
        {
            $table->renameColumn('details', 'product_code');
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_products_products', function($table)
        {
            $table->renameColumn('product_code', 'details');
        });
    }
}
