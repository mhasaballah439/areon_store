<?php namespace Coolnet\Pages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetPagesTextPage7 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_pages_text_page', function($table)
        {
            $table->renameColumn('icon', 'icon_font');
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_pages_text_page', function($table)
        {
            $table->renameColumn('icon_font', 'icon');
        });
    }
}
