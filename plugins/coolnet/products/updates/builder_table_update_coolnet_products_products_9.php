<?php namespace Coolnet\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetProductsProducts9 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_products_products', function($table)
        {
            $table->decimal('offer_price', 10, 0)->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_products_products', function($table)
        {
            $table->dropColumn('offer_price');
        });
    }
}
