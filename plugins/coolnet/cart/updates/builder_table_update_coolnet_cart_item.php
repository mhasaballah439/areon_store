<?php namespace Coolnet\Cart\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetCartItem extends Migration
{
    public function up()
    {
        Schema::table('coolnet_cart_item', function($table)
        {
            $table->integer('type')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_cart_item', function($table)
        {
            $table->dropColumn('type');
        });
    }
}
