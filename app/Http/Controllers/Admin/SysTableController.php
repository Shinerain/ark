<?php
namespace App\Http\Controllers\Admin;

use App\Models\SysColumn;
use App\Services\DbHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\DataTableController;
use App\Models\SysTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use DB;

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

	/**
	 * 生成数据库表
	 * @param Request $request
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function build(Request $request, $id){
		$entity = SysTable::find($id);
		$exists = DbHelper::Instance()->exists($entity->name);
		if($exists){
			$columns = SysColumn::where('sys_table_id', $entity->id)->where('status', '<>', 1)->orderBy('sort','asc')->get();
			Schema::table($entity->name, function (Blueprint $table) use($columns) {
				//changed columns
				foreach ($columns as $column){
					$this->buildCol($table, $column);
				}
			});
		}else{
			$columns = SysColumn::where('sys_table_id', $entity->id)->orderBy('sort','asc')->get();
			Schema::create($entity->name, function (Blueprint $table) use($columns) {
				foreach ($columns as $column){
					$this->buildCol($table, $column);
				}
			});
		}
		reset($columns);
		foreach ($columns as $column){
			$column->status=1;
			$column->save();
		}
		$entity->status = 1;
		$entity->save();
		return $this->success(1);
	}

	function buildCol(Blueprint $table, $column){
		if($column->name == 'id' && $column->is_autoincrement){
			$dbCol = $table->increments($column->name);
		}else{
			$dbCol = $table->{$column->data_type}($column->name);
			if($column->key_type =='primary'){
				$dbCol = $table->primary($column->name);
			}
		}
		if($column->is_nullable){
			$dbCol->nullable();
		}
		if(!empty($column->comment)){
			$dbCol->comment($column->comment);
		}
		if(!is_null($column->default_value)){
			$dbCol->default($column->default_value);
		}
	}

	/**
	 * 重新生成
	 * @param Request $request
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function rebuild(Request $request, $id){
		$entity = SysTable::find($id);
		Schema::drop($entity->name);
		return $this->build($request, $id);
	}

	public function db(Request $request){
		if($request->isMethod('GET')) {
			$tables = DbHelper::Instance()->getTables();
			return view('admin.sys-table.db', ['tables' => $tables]);
		}else{
			$tablename = $request->input('tablename');
			$tables = DbHelper::Instance()->getTables($tablename);
			if(!empty($tables)){
				try {
					DB::transaction(function () use ($tables, $tablename) {
						$table = current($tables);
						$table->status=1;
						$table->save();
						$columns = DbHelper::Instance()->getColumns($tablename);
						foreach ($columns as $column) {
							$column->sys_table_id = $table->id;
							$column->status = 1;
							$column->save();
						}
					});
				}catch (\Exception $e){
					return $this->fail($e->getMessage());
				}
			}
			return $this->success(1);
		}
	}
}
