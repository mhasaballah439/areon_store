<?php namespace Coolnet\Websetting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetWebsettingData17 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_websetting_data', function($table)
        {
            $table->string('seo_title')->nullable();
            $table->text('seo_keyword')->nullable();
            $table->text('seo_description')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_websetting_data', function($table)
        {
            $table->dropColumn('seo_title');
            $table->dropColumn('seo_keyword');
            $table->dropColumn('seo_description');
        });
    }
}
