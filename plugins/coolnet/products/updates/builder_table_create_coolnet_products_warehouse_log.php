<?php namespace Coolnet\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateCoolnetProductsWarehouseLog extends Migration
{
    public function up()
    {
        Schema::create('coolnet_products_warehouse_log', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('employee_name')->nullable();
            $table->integer('product_id')->default(0);
            $table->string('move_type')->nullable()->default('import');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('wharehouse_id')->default(0);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('coolnet_products_warehouse_log');
    }
}
