<?php namespace Coolnet\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateCoolnetProductsProducts extends Migration
{
    public function up()
    {
        Schema::create('coolnet_products_products', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->text('desc');
            $table->text('details');
            $table->decimal('price_user', 8, 2);
            $table->decimal('price_company', 8, 2);
            $table->string('short_title');
            $table->string('slug');
            $table->integer('sort_order');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('coolnet_products_products');
    }
}
