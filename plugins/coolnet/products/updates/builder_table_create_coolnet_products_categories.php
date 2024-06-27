<?php namespace Coolnet\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateCoolnetProductsCategories extends Migration
{
    public function up()
    {
        Schema::create('coolnet_products_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name')->nullable();
            $table->integer('parent_id')->default(0);
            $table->boolean('active')->default(0);
            $table->integer('nest_right')->default(0);
            $table->integer('nest_left')->default(0);
            $table->string('slug')->nullable();
            $table->integer('nest_depth')->default(0);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('coolnet_products_categories');
    }
}
