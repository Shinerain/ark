<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SysModule;
use App\Models\SysTable;
use App\Models\SysColumn;


/**
 * 系统功能模块创建
 * Class SysBuilderController
 * @package App\Http\Controllers\Admin
 */
class SysBuilderController extends Controller
{
    //
	public function index(){
		$data = SysModule::all();
		return view('sys-builder.index')->withModules($data);
	}
}
