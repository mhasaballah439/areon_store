<?php namespace Coolnet\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateCoolnetProductsWherehouseMovement extends Migration
{
    public function up()
    {
        Schema::create('coolnet_products_wherehouse_movement', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('product_id')->unsigned()->default(0);
            $table->integer('wharehouse_id')->unsigned()->default(0);
            $table->integer('qty')->default(0);
            $table->string('move_type')->nullable()->default('import');
            $table->text('note')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('coolnet_products_wherehouse_movement');
    }
}
