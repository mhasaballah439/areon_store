<?php namespace Coolnet\Cart\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetCartItem4 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_cart_item', function($table)
        {
            $table->decimal('item_total', 10, 2)->default(0);
            $table->decimal('tax_total', 10, 2)->default(0)->change();
            $table->decimal('discount_total', 10, 2)->default(0)->change();
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_cart_item', function($table)
        {
            $table->dropColumn('item_total');
            $table->decimal('tax_total', 10, 2)->default(null)->change();
            $table->decimal('discount_total', 10, 2)->default(null)->change();
        });
    }
}
