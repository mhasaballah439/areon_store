<?php namespace Coolnet\Cart\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetCartItem2 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_cart_item', function($table)
        {
            $table->string('type')->nullable(false)->unsigned(false)->default('product')->change();
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_cart_item', function($table)
        {
            $table->integer('type')->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
