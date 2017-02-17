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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$entity =  $this->newEntity()->newQuery()->find($id);
		if($entity->path){
			$file = base_path($entity->path);
			if(is_file($file)){
				unlink($file);
			}
		}
		$entity->delete();
		$entity=[];
		return $this->success($entity);
	}

	public function open(Request $request, $id){
		$file = SysModuleFile::find($id);
		return view('admin.sys-module-file.editor', ['file' => $file]);
	}
}
