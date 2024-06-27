<?php namespace Coolnet\Cart\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetCartData3 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_cart_data', function($table)
        {
            $table->decimal('discount_total', 8, 2)->default(0);
            $table->renameColumn('discount', 'discount_amount');
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_cart_data', function($table)
        {
            $table->dropColumn('discount_total');
            $table->renameColumn('discount_amount', 'discount');
        });
    }
}
