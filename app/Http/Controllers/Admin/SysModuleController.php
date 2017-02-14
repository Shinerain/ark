<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\DataTableController;
use App\Models\SysModuleFile;
use App\Services\CodeBuilder;
use App\Services\DbHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SysModule ;
use App\Models\SysDic;

class SysModuleController extends DataTableController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
	    $icons = SysDic::where('category', 'icon')->get();
	    $entities = SysModule::where('pid', 0)->get();
	    $data = $entities->map(function ($entity){
	    	return $this->toBootstrapTreeViewData($entity, ['text' => 'name', 'data-id' => 'id', 'icon' => 'icon']);
	    });

	    return view('admin.sys-module.index')
		    ->withModules($data)
		    ->withIcons($icons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$icons = SysDic::where('category', 'icon')->get();
	    return view('admin.sys-module.create', ['icons' => $icons]);
    }

//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        //
////	    $data = $request->all();
////	    unset($data['_token']);
////	    $entity = SysModule::create($data);
////	    $this->flash_success('store success!');
////		return redirect(route('sys-module.index'));
//	    $data = $request->input('data', []);
//	    if(empty($data))
//		    return response()->json(['data' => []]);
//	    $props = current($data);
//	    $entity = SysModule::create($props);
//	    return response()->json(['data' => [$entity]]);
//    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
		$entity = SysModule::find($id);
		$icons = SysDic::where('category', 'icon')->get();
		return view('admin.sys-module.edit', ['entity' => $entity, 'icons' => $icons]);
	}

//	/**
//	 * Update the specified resource in storage.
//	 *
//	 * @param  \Illuminate\Http\Request  $request
//	 * @param  int  $id
//	 * @return \Illuminate\Http\Response
//	 */
//	public function update(Request $request, $id)
//	{
//		//
////		$entity = SysModule::find($id);
////		$data = $request->all();
////		unset($data['_token']);
////		$entity->fill($data);
////		$re = $entity->save();
////		$this->flash_success('update success!');
////		return redirect(route('sys-module.index'));
//		$data = $request->input('data', []);
//		if(empty($data))
//			return response()->json(['data' => []]);
//
//		$props = current($data);
//		$entity = SysModule::find($id);
//		$entity->fill($props);
//		$entity->save();
//		return response()->json(['data' => [$entity]]);
//	}

//	/**
//	 * Remove the specified resource from storage.
//	 *
//	 * @param  int  $id
//	 * @return \Illuminate\Http\Response
//	 */
//	public function destroy($id)
//	{
//		//
////		$entity = SysModule::find($id);
////		$re = $entity->delete();
////		//$this->flash_success('destroy success!');
////		//return redirect(route('sys-module.index'));
////		return response(['success' => $re], 200);
//
//		$entity = SysModule::find($id);
//		$entity->delete();
//		$entity=[];
//		return response()->json(['data' => [$entity]]);
//	}

//	public function pagination(Request $request){
//		//$data = $request->all();
//		$start =  $request->input('start', 0);
//		$length = $request->input('length', 10);
//		$columns = $request->input('columns',[]);
//		$order = $request->input('order', []);
//		$search = $request->input('search', []);
//		$draw = $request->input('draw', 0);
//
//		$queryBuilder = SysModule::query();
//		$fields = [];
//		$conditions = [];
//		foreach ($columns as $column){
//			$fields[] = $column['data'];
//			if(!empty($column['search']['value'])){
//				$conditions[$column['data']] = $column['search']['value'];
//			}
//		}
//		$total = $queryBuilder->count();
//
//		foreach ($conditions as $col => $val) {
//			$queryBuilder->where($col, $val);
//		}
//		foreach ($order as $o){
//			$index = $o['column'];
//			$dir = $o['dir'];
//			$queryBuilder->orderBy($columns[$index]['data'], $dir);
//		}
//
//		$entities = $queryBuilder->select($fields)->skip($start)->take($length)->get();
//		$result = [
//			'draw' => $draw,
//			'recordsTotal' => $total,
//			'recordsFiltered' => $total,
//			'data' => $entities
//		];
//		return response()->json($result);
//	}

	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new SysModule($attributes);
	}

	/**
	 * @param Request $request
	 * @param array $searchCols
	 * @param array $with
	 * @param null $conditionCall
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function pagination(Request $request, $searchCols = [], $with = [], $conditionCall = NULL){
		$searchCols = ['name', 'desc'];
		return parent::pagination($request, $searchCols, $conditionCall);
	}

	public function action(){
		return parent::success([]);
	}

	public function genCode(Request $request){
		if($request->isMethod('GET')) {
			$id = $request->input('id');
			$helper = new DbHelper();
			$tables = $helper->getTables();
			return view('admin.sys-module.generate')->withTables($tables)->withId($id);
		}else{
			$id = $request->input('id');
			$tableName = $request->input('tableName');
			$modelName = $request->input('modelName', '');
			$templates = $request->input('templates', []);
			if(empty($modelName)){
				$modelName = snake_case($tableName);
			}
			//var_dump($templates);
			$db = new DbHelper();
			$columns = $db->getColumns($tableName);
			//var_dump($columns);
			$builder = new CodeBuilder($modelName, $tableName, $columns);
			$files = $builder->createFiles($templates);
			//var_dump($files);
			if(!empty($files)){
				foreach ($files as $file){
					$att = $file + ['sys_module_id' => $id];
					SysModuleFile::create($att);
				}
			}
			return response()->json(['code' => 200]);
		}
	}
}
