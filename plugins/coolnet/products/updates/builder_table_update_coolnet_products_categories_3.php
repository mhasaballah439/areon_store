<?php namespace Coolnet\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetProductsCategories3 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_products_categories', function($table)
        {
            $table->boolean('is_home')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_products_categories', function($table)
        {
            $table->dropColumn('is_home');
        });
    }
}
