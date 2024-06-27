<?php namespace Coolnet\Cart\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetCartData extends Migration
{
    public function up()
    {
        Schema::table('coolnet_cart_data', function($table)
        {
            $table->decimal('tax', 8, 2)->default(0.00);
            $table->decimal('tax_total', 10, 2)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_cart_data', function($table)
        {
            $table->dropColumn('tax');
            $table->decimal('tax_total', 8, 2)->default(0.00)->change();
        });
    }
}
