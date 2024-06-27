<?php namespace Coolnet\Pages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCoolnetPagesTextPage5 extends Migration
{
    public function up()
    {
        Schema::table('coolnet_pages_text_page', function($table)
        {
            $table->dropColumn('image');
        });
    }
    
    public function down()
    {
        Schema::table('coolnet_pages_text_page', function($table)
        {
            $table->string('image', 191)->nullable();
        });
    }
}
