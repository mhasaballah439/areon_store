<?php namespace Coolnet\Orders\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateCoolnetOrdersOrders extends Migration
{
    public function up()
    {
        Schema::create('coolnet_orders_orders', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('user_id')->default(0);
            $table->integer('address_id')->default(0);
            $table->integer('code')->default(0);
            $table->text('note')->nullable();
            $table->integer('status_id')->default(0);
            $table->text('payment_info')->nullable();
            $table->integer('delivery_price')->default(0);
            $table->string('delivery')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('order_from')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('coolnet_orders_orders');
    }
}
