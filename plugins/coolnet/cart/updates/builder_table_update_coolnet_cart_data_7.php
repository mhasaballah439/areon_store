<?php namespace Coolnet\Cart\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetCartData7 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_cart_data', function($table)
        {
            $table->dropColumn('promo_num_used');
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_cart_data', function($table)
        {
            $table->integer('promo_num_used')->default(0);
        });
    }
}
