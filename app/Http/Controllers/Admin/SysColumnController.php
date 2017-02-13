<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\DataTableController;
use App\Models\SysColumn;
use App\Models\SysTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SysDic;
use Route;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function table(Request $request, $id){
    	$table = SysTable::find($id);
	    return view('admin.sys-column.index')->withTable($table);
    }

	/**
	 * @param  Request $request
	 * @param  array $searchCols
	 * @param null $conditionCall
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function pagination(Request $request, $searchCols = [], $conditionCall = NULL){
		$searchCols = ["comment","name"];
		$id = Route::input('id');
		//var_dump($id);
		return parent::pagination($request, $searchCols, function ($queryBuilder) use($id){
			$queryBuilder->where('sys_table_id', $id);
		});
	}

	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new SysColumn($attributes);
	}

}
