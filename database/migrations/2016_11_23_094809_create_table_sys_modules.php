<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSysModules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	    Schema::create('sys_modules', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('pid')->default(0)->comment('parent id');
		    $table->string('name')->default('')->comment('模块名称');
		    $table->string('desc')->default('')->comment('模块描述');
		    $table->string('icon')->default('')->comment('icon');
		    $table->integer('is_page')->default(0)->comment('是否功能页');
		    $table->string('url')->default('')->comment('链接地址');
		    $table->integer('sort')->default(0)->comment('排序');
		    $table->integer('permission_flag')->default(0)->comment('权限标识');
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
	    Schema::drop('sys_modules');
    }
}
