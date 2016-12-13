<?php

use Illuminate\Database\Seeder;
use App\Models\SysDic;

class SysDicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //icon
	    SysDic::create(['category' => 'icon', 'text' => 'fa-tag', 'value' => 'fa fa-tag']);
	    SysDic::create(['category' => 'icon', 'text' => 'fa-tasks', 'value' => 'fa fa-tasks']);
	    SysDic::create(['category' => 'icon', 'text' => 'fa-home', 'value' => 'fa fa-home']);
	    SysDic::create(['category' => 'icon', 'text' => 'fa-server', 'value' => 'fa fa-server']);
	    SysDic::create(['category' => 'icon', 'text' => 'fa-user-o', 'value' => 'fa fa-user-o']);
	    SysDic::create(['category' => 'icon', 'text' => 'fa-users', 'value' => 'fa fa-users']);
	    SysDic::create(['category' => 'icon', 'text' => 'fa-line-chart', 'value' => 'fa fa-line-chart']);
	    SysDic::create(['category' => 'icon', 'text' => 'fa-warning', 'value' => 'fa fa-warning']);
	    SysDic::create(['category' => 'icon', 'text' => 'fa-wrench', 'value' => 'fa fa-wrench']);
	    SysDic::create(['category' => 'icon', 'text' => 'fa-vcard', 'value' => 'fa fa-vcard']);
	    SysDic::create(['category' => 'icon', 'text' => 'fa-vcard-o', 'value' => 'fa fa-vcard-o']);
	    SysDic::create(['category' => 'icon', 'text' => 'fa-tree', 'value' => 'fa fa-tree']);
	    SysDic::create(['category' => 'icon', 'text' => 'fa-upload', 'value' => 'fa fa-upload']);
	    SysDic::create(['category' => 'icon', 'text' => 'fa-download', 'value' => 'fa fa-download']);
	    SysDic::create(['category' => 'icon', 'text' => 'fa-calendar', 'value' => 'fa fa-calendar']);
	    SysDic::create(['category' => 'icon', 'text' => 'fa-calendar-o', 'value' => 'fa fa-calendar-o']);
	    SysDic::create(['category' => 'icon', 'text' => 'fa-unlock', 'value' => 'fa fa-unlock']);
	    SysDic::create(['category' => 'icon', 'text' => 'fa-lock', 'value' => 'fa fa-lock']);
	    SysDic::create(['category' => 'icon', 'text' => 'fa-folder', 'value' => 'fa fa-folder']);
	    SysDic::create(['category' => 'icon', 'text' => 'fa-folder-o', 'value' => 'fa fa-folder-o']);

	    //column types
	    SysDic::create(['category' => 'data_type', 'text' => 'string', 'value' => 'string']);
	    SysDic::create(['category' => 'data_type', 'text' => 'integer', 'value' => 'integer']);
	    SysDic::create(['category' => 'data_type', 'text' => 'tinyInteger', 'value' => 'tinyInteger']);
	    SysDic::create(['category' => 'data_type', 'text' => 'unsignedInteger', 'value' => 'unsignedInteger']);
	    SysDic::create(['category' => 'data_type', 'text' => 'bigInteger', 'value' => 'bigInteger']);
	    SysDic::create(['category' => 'data_type', 'text' => 'char', 'value' => 'char']);
	    SysDic::create(['category' => 'data_type', 'text' => 'timestamp', 'value' => 'timestamp']);
	    SysDic::create(['category' => 'data_type', 'text' => 'double', 'value' => 'double']);
	    SysDic::create(['category' => 'data_type', 'text' => 'decimal', 'value' => 'decimal']);
	    SysDic::create(['category' => 'data_type', 'text' => 'boolean', 'value' => 'boolean']);
	    SysDic::create(['category' => 'data_type', 'text' => 'text', 'value' => 'text']);

	    //column key types
	    SysDic::create(['category' => 'key_type', 'text' => 'primary', 'value' => 'primary']);
	    SysDic::create(['category' => 'key_type', 'text' => 'unique', 'value' => 'unique']);
	    SysDic::create(['category' => 'key_type', 'text' => 'index', 'value' => 'index']);

	    //ctrl type
	    SysDic::create(['category' => 'ctrl_type', 'text' => 'text', 'value' => 'text']);
	    SysDic::create(['category' => 'ctrl_type', 'text' => 'file', 'value' => 'file']);
	    SysDic::create(['category' => 'ctrl_type', 'text' => 'image', 'value' => 'image']);
	    SysDic::create(['category' => 'ctrl_type', 'text' => 'url', 'value' => 'url']);
	    SysDic::create(['category' => 'ctrl_type', 'text' => 'number', 'value' => 'number']);
	    SysDic::create(['category' => 'ctrl_type', 'text' => 'email', 'value' => 'email']);
	    SysDic::create(['category' => 'ctrl_type', 'text' => 'password', 'value' => 'password']);
	    SysDic::create(['category' => 'ctrl_type', 'text' => 'date', 'value' => 'date']);
	    SysDic::create(['category' => 'ctrl_type', 'text' => 'datetime', 'value' => 'datetime']);
	    SysDic::create(['category' => 'ctrl_type', 'text' => 'radio', 'value' => 'radio']);
	    SysDic::create(['category' => 'ctrl_type', 'text' => 'checkbox', 'value' => 'checkbox']);
	    SysDic::create(['category' => 'ctrl_type', 'text' => 'tel', 'value' => 'tel']);
	    SysDic::create(['category' => 'ctrl_type', 'text' => 'color', 'value' => 'color']);
    }
}
