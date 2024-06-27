<?php namespace Coolnet\Orders\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateCoolnetOrdersDetails extends Migration
{
    public function up()
    {
        Schema::create('coolnet_orders_details', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('order_id')->default(0);
            $table->integer('product_id')->default(0);
            $table->string('product_name')->nullable();
            $table->integer('qty')->default(0);
            $table->decimal('price', 8, 2)->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('coolnet_orders_details');
    }
}
