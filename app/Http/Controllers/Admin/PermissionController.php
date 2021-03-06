<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\DataTableController;
use App\Models\Permission;

class PermissionController extends DataTableController
{
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new Permission($attributes);
	}

	/**
	* Display a listing of the resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function index()
	{
		//
		return view('admin.permission.index');
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function create()
	{
		return view('admin.permission.create');
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		$entity = Permission::find($id);
		return view('admin.permission.edit', ['entity' => $entity]);
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
	* @return  \Illuminate\Http\JsonResponse
	*/
	public function pagination(Request $request,  $searchCols = [], $with = [], $conditionCall = null){
		$searchCols = ["name","display_name","description","type","data"];
		return parent::pagination($request, $searchCols, $with, $conditionCall);
	}

}
