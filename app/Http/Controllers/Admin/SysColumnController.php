<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\DataTableController;
use App\Models\SysColumn;
use App\Models\SysTable;
use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SysDic;
use Route;
use DB;

class SysColumnController extends DataTableController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
	    $data = SysColumn::all();
	    $keyTypes = SysDic::where('category', 'key_type')->get();
	    return view('sys-column.index')->withColumns($data)->withKeyTypes($keyTypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
		$data = $request->input('data', []);
		if(empty($data))
			return $this->fail('data is empty');

		$props = current($data);
		$fieldErrors = $this->validateFields($props);
		if(!empty($fieldErrors)){
			return $this->fail('validate error', $fieldErrors);
		} else {
			$entity = $this->newEntity()->newQuery()->find($id);
			$entity->fill($props+['status'=>2]);
			$entity->save();
			return $this->success($entity);
		}
	}


	public function table(Request $request, $id){
    	$table = SysTable::find($id);
    	$dics =  DB::select('select DISTINCT category from sys_dics ');
    	$categories = array_map(function ($item){
    		return ['label' => $item->category, 'value' => $item->category];
	    }, $dics);
    	array_push($categories, ['label' => '--select--', 'value' => '']);
	    return view('admin.sys-column.index')->withTable($table)->withCategories($categories);
    }

	/**
	 * @param  Request $request
	 * @param  array $searchCols
	 * @param array $with
	 * @param null $conditionCall
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function pagination(Request $request, $searchCols = [], $with = [],  $conditionCall = NULL){
		$searchCols = ["comment","name"];
		$id = Route::input('id');
		//var_dump($id);
		return parent::pagination($request, $searchCols, $with, function ($queryBuilder) use($id){
			$queryBuilder->where('sys_table_id', $id);
		});
	}

	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new SysColumn($attributes);
	}

}
