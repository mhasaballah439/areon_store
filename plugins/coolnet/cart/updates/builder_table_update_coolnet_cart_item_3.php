<?php namespace Coolnet\Cart\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetCartItem3 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_cart_item', function($table)
        {
            $table->decimal('tax_amount', 10, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('tax_total', 10, 2);
            $table->decimal('discount_total', 10, 2);
            $table->decimal('price', 10, 2)->change();
            $table->decimal('tax_rate', 10, 2)->change();
            $table->decimal('discount_rate', 10, 2)->change();
            $table->dropColumn('tax');
            $table->dropColumn('discount');
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_cart_item', function($table)
        {
            $table->dropColumn('tax_amount');
            $table->dropColumn('discount_amount');
            $table->dropColumn('tax_total');
            $table->dropColumn('discount_total');
            $table->decimal('price', 10, 0)->change();
            $table->decimal('tax_rate', 10, 0)->change();
            $table->decimal('discount_rate', 10, 0)->change();
            $table->decimal('tax', 10, 0)->default(0);
            $table->decimal('discount', 10, 0)->default(0);
        });
    }
}
