<?php namespace Coolnet\Cart\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateCoolnetCartItem extends Migration
{
    public function up()
    {
        Schema::create('coolnet_cart_item', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('product_id');
            $table->integer('cart_id');
            $table->decimal('price', 10, 0)->default(0);
            $table->integer('quantity')->default(1);
            $table->decimal('tax_rate', 10, 0)->default(0);
            $table->decimal('tax', 10, 0)->default(0);
            $table->decimal('discount_rate', 10, 0)->default(0);
            $table->decimal('discount', 10, 0)->default(0);
            $table->string('item_id')->nullable();
            $table->text('options')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('coolnet_cart_item');
    }
}
