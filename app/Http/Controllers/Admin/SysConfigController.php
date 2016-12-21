<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 系统配置
 * Class SysConfigController
 * @package App\Http\Controllers\Admin
 */
class SysConfigController extends Controller
{
    //
	public function index(){
		return view('sys-config.index');
	}

	public function doArtisan(){

	}
}
