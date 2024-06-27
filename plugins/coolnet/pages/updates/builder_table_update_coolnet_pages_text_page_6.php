<?php namespace Coolnet\Pages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetPagesTextPage6 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_pages_text_page', function($table)
        {
            $table->string('icon', 191);
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_pages_text_page', function($table)
        {
            $table->dropColumn('icon');
        });
    }
}
