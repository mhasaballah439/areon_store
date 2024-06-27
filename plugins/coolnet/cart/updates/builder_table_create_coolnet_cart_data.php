<?php namespace Coolnet\Cart\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateCoolnetCartData extends Migration
{
    public function up()
    {
        Schema::create('coolnet_cart_data', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('user_id');
            $table->string('group_id')->nullable();
            $table->decimal('shipping', 8, 2)->default(0);
            $table->integer('promo')->default(0);
            $table->decimal('discount_rate', 4, 2)->default(0);
            $table->decimal('discount', 8, 2)->default(0);
            $table->decimal('tax_rate', 4, 2)->default(0);
            $table->decimal('tax_total', 8, 2)->default(0);
            $table->decimal('sub_total', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->decimal('grand_total', 10, 2)->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('coolnet_cart_data');
    }
}
