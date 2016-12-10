<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSysTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	    Schema::create('sys_tables', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('sys_module_id');
		    $table->string('name')->comment('表名');
		    $table->string('desc')->default('')->comment('表描述');
		    $table->string('icon')->default('')->comment('icon');
		    $table->timestamps();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
	    Schema::drop('sys_tables');
    }
}
