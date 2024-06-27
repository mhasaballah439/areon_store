<?php namespace Coolnet\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetProductsProducts4 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_products_products', function($table)
        {
            $table->string('title', 191)->nullable()->change();
            $table->text('desc')->nullable()->change();
            $table->text('details')->nullable()->change();
            $table->decimal('price_user', 8, 2)->default(0)->change();
            $table->decimal('price_company', 8, 2)->default(0)->change();
            $table->string('short_title', 191)->nullable()->change();
            $table->string('slug', 191)->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_products_products', function($table)
        {
            $table->string('title', 191)->nullable(false)->change();
            $table->text('desc')->nullable(false)->change();
            $table->text('details')->nullable(false)->change();
            $table->decimal('price_user', 8, 2)->default(null)->change();
            $table->decimal('price_company', 8, 2)->default(null)->change();
            $table->string('short_title', 191)->nullable(false)->change();
            $table->string('slug', 191)->nullable(false)->change();
        });
    }
}
