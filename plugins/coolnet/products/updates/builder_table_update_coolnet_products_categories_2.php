<?php namespace Coolnet\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetProductsCategories2 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_products_categories', function($table)
        {
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_products_categories', function($table)
        {
            $table->dropColumn('deleted_at');
        });
    }
}
