<?php namespace Coolnet\Cart\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetCartData8 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_cart_data', function($table)
        {
            $table->integer('coupon_id')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_cart_data', function($table)
        {
            $table->dropColumn('coupon_id');
        });
    }
}
