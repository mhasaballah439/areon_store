<?php namespace Coolnet\Pages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateCoolnetPagesTextPage extends Migration
{
    public function up()
    {
        Schema::create('coolnet_pages_text_page', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('tilte')->nullable();
            $table->text('sub_title')->nullable();
            $table->text('detail')->nullable();
            $table->text('slug')->nullable();
            $table->string('page_id')->nullable();
            $table->integer('parent_id')->default(0);
            $table->integer('nest_left')->default(0);
            $table->integer('nest_right')->default(0);
            $table->integer('nest_depth')->default(0);
            $table->string('target')->nullable();
            $table->boolean('is_external')->default(0);
            $table->string('seo_title')->nullable();
            $table->text('seo_desc')->nullable();
            $table->text('sey_keyword')->nullable();
            $table->boolean('top_nav')->default(0);
            $table->boolean('footer_nav')->default(0);
            $table->boolean('active')->default(0);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('coolnet_pages_text_page');
    }
}
