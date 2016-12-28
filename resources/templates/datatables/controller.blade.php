{!! $BEGIN_PHP !!}

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{{$model}};

class {{$model}}Controller extends BaseController
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		//
		return view('{{snake_case($model,'-')}}.index');
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		return view('{{snake_case($model,'-')}}.create');
	}

	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		$data = $request->input('data', []);
		if(empty($data))
			return response()->json(['data' => []]);

		$props = current($data);
		$entity = {{$model}}::create($props);
		return response()->json($this->success([$entity]));
	}

	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		$entity = {{$model}}::find($id);
		return view('{{snake_case($model,'-')}}.edit', ['entity' => $entity]);
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
		$data = $request->input('data', []);
		if(empty($data))
			return response()->json(['data' => []]);

		$props = current($data);
		$entity = {{$model}}::find($id);
		$entity->fill($props);
		$entity->save();
		return response()->json($this->success([$entity]));
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
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function destroy($id)
	{
		$entity = {{$model}}::find($id);
		$entity->delete();
		return response()->json($this->success([]));
	}

	public function pagination(Request $request){
		//$data = $request->all();
		$start =  $request->input('start', 0);
		$length = $request->input('length', 10);
		$columns = $request->input('columns',[]);
		$order = $request->input('order', []);
		$search = $request->input('search', []);
		$draw = $request->input('draw', 0);

		$queryBuilder = {{$model}}::query();
		$fields = [];
		$conditions = [];
		foreach ($columns as $column){
			$fields[] = $column['data'];
			if(!empty($column['search']['value'])){
				$conditions[$column['data']] = $column['search']['value'];
			}
		}
		$total = $queryBuilder->count();

		foreach ($conditions as $col => $val) {
			$queryBuilder->where($col, $val);
		}
		foreach ($order as $o){
			$index = $o['column'];
			$dir = $o['dir'];
			$queryBuilder->orderBy($columns[$index]['data'], $dir);
		}
		$entities = $queryBuilder->select($fields)->skip($start)->take($length)->get();
		$result = [
			'draw' => $draw,
			'recordsTotal' => $total,
			'recordsFiltered' => $total,
			'data' => $entities
		];
		return response()->json($result);
	}

	public function success($data){
		return ['data' => $data];
	}

	public function fail($error, $fieldErrors){
		return ['data' => [], 'error' =>  $error, 'cancelled' => 1, 'fieldErrors' => $fieldErrors];
	}
}
