<?php namespace Coolnet\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetProductsMovement4 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_products_movement', function($table)
        {
            $table->renameColumn('qty', 'wharehouse_id');
            $table->dropColumn('move_type');
            $table->dropColumn('note');
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_products_movement', function($table)
        {
            $table->renameColumn('wharehouse_id', 'qty');
            $table->string('move_type', 191)->nullable()->default('import');
            $table->text('note')->nullable();
        });
    }
}
