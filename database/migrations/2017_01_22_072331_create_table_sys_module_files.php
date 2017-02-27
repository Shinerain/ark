<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSysModuleFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_module_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sys_module_id')->nullable();
            $table->string('name')->default('')->comment('文件名');
            $table->string('path')->default('')->comment('文件保存路径');
            $table->string('suffix')->default('php')->comment('文件后缀');
            $table->string('desc')->default('')->comment('描述');
            $table->text('content')->nullable()->comment('文件内容');
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
        Schema::dropIfExists('sys_module_files');
    }
}
