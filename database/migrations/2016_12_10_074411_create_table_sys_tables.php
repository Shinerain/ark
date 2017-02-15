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
		    $table->string('name')->comment('表名');
		    $table->string('model_name')->comment('实体名');
		    $table->string('desc')->default('')->comment('表描述');
		    $table->string('engine')->default('InnoDB')->comment('表引擎');
		    $table->integer('status')->default(0)->comment('状态（0-初始,1-已经创建了表,2-被修改）');
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
