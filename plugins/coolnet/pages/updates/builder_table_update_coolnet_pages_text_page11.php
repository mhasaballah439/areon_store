<?php namespace Coolnet\Pages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetPagesTextPage11 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_pages_text_page', function($table)
        {
            $table->string('font_aws', 191)->nullable()->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_pages_text_page', function($table)
        {
            $table->string('font_aws', 191)->nullable(false)->default('null')->change();
        });
    }
}