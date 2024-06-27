<?php namespace Coolnet\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetProductsMovement2 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_products_movement', function($table)
        {
            $table->string('move_type')->nullable()->default('import');
            $table->dropColumn('is_import');
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_products_movement', function($table)
        {
            $table->dropColumn('move_type');
            $table->boolean('is_import')->default(1);
        });
    }
}
