<?php namespace Coolnet\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetProductsWharehouses extends Migration
{
    public function up()
    {
        Schema::rename('coolnet_products_wharehouse', 'coolnet_products_wharehouses');
    }
    
    public function down()
    {
        Schema::rename('coolnet_products_wharehouses', 'coolnet_products_wharehouse');
    }
}
