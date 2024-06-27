<?php namespace Coolnet\Profile\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateCoolnetProfileAddress extends Migration
{
    public function up()
    {
        Schema::create('coolnet_profile_address', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('user_id')->default(0);
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('building')->nullable();
            $table->string('zip_code')->nullable();
            $table->integer('mobile')->default(0);
            $table->string('full_name')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('coolnet_profile_address');
    }
}
