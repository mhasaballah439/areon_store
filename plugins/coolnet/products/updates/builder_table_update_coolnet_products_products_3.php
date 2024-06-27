<?php namespace Coolnet\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetProductsProducts3 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_products_products', function($table)
        {
            $table->boolean('active')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_products_products', function($table)
        {
            $table->dropColumn('active');
        });
    }
}
