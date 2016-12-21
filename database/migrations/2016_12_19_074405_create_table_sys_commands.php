<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSysCommands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	    Schema::create('sys_commands', function (Blueprint $table) {
		    $table->increments('id');
		    $table->string('category')->default('')->comment('分类');
		    $table->string('name')->default('')->comment('命令名称');
		    $table->string('desc')->default('')->comment('描述');
		    $table->string('signature')->default('')->comment('签名');
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
	    Schema::drop('sys_commands');
    }
}
