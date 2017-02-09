<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\DataTableController;
use App\Models\SysModuleFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SysModuleFileController extends DataTableController
{
    //
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new SysModuleFile($attributes);
	}
}
