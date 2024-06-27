<?php namespace Coolnet\Cart\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetCartData5 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_cart_data', function($table)
        {
            $table->integer('tpms_count')->default(0);
            $table->decimal('tpms_total', 10, 2)->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_cart_data', function($table)
        {
            $table->dropColumn('tpms_count');
            $table->dropColumn('tpms_total');
        });
    }
}
