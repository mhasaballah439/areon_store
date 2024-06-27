<?php namespace Coolnet\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetProductsProducts8 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_products_products', function($table)
        {
            $table->string('short_title')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_products_products', function($table)
        {
            $table->dropColumn('short_title');
        });
    }
}
