<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\DataTableController;
use App\Models\SysTable;

class SysTableController extends DataTableController
{
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new SysTable($attributes);
	}

	/**
	* Display a listing of the resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function index()
	{
		//
		return view('admin.sys-table.index');
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function create()
	{
		return view('admin.sys-table.create');
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		$entity = SysTable::find($id);
		return view('admin.sys-table.edit', ['entity' => $entity]);
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function show($id)
	{
		//
	}

	/**
	 * @param  Request $request
	 * @param  array $searchCols
	 * @param array $with
	 * @param null $conditionCall
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function pagination(Request $request, $searchCols = [], $with = [], $conditionCall = NULL){
		$searchCols = ["desc","engine","model_name","name"];
		return parent::pagination($request, $searchCols);
	}

}
