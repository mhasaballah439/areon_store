<?php namespace Coolnet\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetProductsProducts2 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_products_products', function($table)
        {
            $table->integer('cat_id')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_products_products', function($table)
        {
            $table->dropColumn('cat_id');
        });
    }
}
