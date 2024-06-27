<?php namespace Coolnet\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetProductsWharehouses2 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_products_wharehouses', function($table)
        {
            $table->boolean('active')->default(0);
            $table->integer('parent_id')->default(0);
            $table->integer('nest_right')->default(0);
            $table->integer('nest_left')->default(0);
            $table->integer('nest_depth')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_products_wharehouses', function($table)
        {
            $table->dropColumn('active');
            $table->dropColumn('parent_id');
            $table->dropColumn('nest_right');
            $table->dropColumn('nest_left');
            $table->dropColumn('nest_depth');
        });
    }
}
