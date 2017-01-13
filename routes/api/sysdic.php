<?php
/**
* @SWG\Resource(
*  resourcePath="/sys-dic",
*  description="SysDic"
* )
*/
Route::group(['prefix' => 'sys-dic'], function () {

    /**
    * @SWG\Api(
    *     path="/api/sys-dic",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="sys-dic-list",
    *      summary="page list",
    *      notes="page list",
    *      type="array",
    *     items="$ref:SysDic",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="page", description="当前页", required=false, type="integer", paramType="query", defaultValue="1"),
    *          @SWG\Parameter(name="pageSize", description="页大小", required=false, type="integer", paramType="query", defaultValue="10"),
    *          @SWG\Parameter(name="sort", description="排序", required=false, type="string", paramType="query", defaultValue="id asc"),
    *          @SWG\Parameter(name="search", description="查询条件（数组的json格式, 键里面可带有比较符号，不带默认为: =）", required=false, type="string", paramType="query", defaultValue="{&quot;id >=&quot;:1}"),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
    *      )
    *    )
    * )
    */
    Route::get('/', ['as' => 'SysDic.index', 'uses' => 'SysDicController@index']);

    /**
    * @SWG\Api(
    *     path="/api/sys-dic/{id}",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="sys-dic-show",
    *      summary="信息详情",
    *      notes="信息详情",
    *      type="Attendance",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="id", description="id", required=true, type="integer", paramType="path", defaultValue="1"),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::get('/{id}', ['as' => 'SysDic.show', 'uses' => 'SysDicController@show']);

    /**
    * @SWG\Api(
    *     path="/api/sys-dic",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="sys-dic-store",
    *      summary="新增",
    *      notes="新增",
    *      type="",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="category", description="大类", required='false',type="string", paramType="form", defaultValue="" ),';
    *          @SWG\Parameter(name="created_at", description="", required='true',type="datetime", paramType="form", defaultValue="" ),';
    *          @SWG\Parameter(name="id", description="", required='false',type="integer", paramType="form", defaultValue="" ),';
    *          @SWG\Parameter(name="text", description="显示名称", required='false',type="string", paramType="form", defaultValue="" ),';
    *          @SWG\Parameter(name="updated_at", description="", required='true',type="datetime", paramType="form", defaultValue="" ),';
    *          @SWG\Parameter(name="value", description="值", required='false',type="string", paramType="form", defaultValue="" ),';
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/', ['as' => 'SysDic.store', 'uses' => 'SysDicController@store']);

    /**
    * @SWG\Api(
    *     path="/api/sys-dic/{id}",
    *     @SWG\Operation(
    *      method="PUT",
    *      nickname="sys-dic-update",
    *      summary="更新",
    *      notes="更新",
    *      type="",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="category", description="大类", required='false',type="string", paramType="form", defaultValue="" ),';
    *          @SWG\Parameter(name="created_at", description="", required='false',type="datetime", paramType="form", defaultValue="" ),';
    *          @SWG\Parameter(name="id", description="", required='false',type="integer", paramType="form", defaultValue="" ),';
    *          @SWG\Parameter(name="text", description="显示名称", required='false',type="string", paramType="form", defaultValue="" ),';
    *          @SWG\Parameter(name="updated_at", description="", required='false',type="datetime", paramType="form", defaultValue="" ),';
    *          @SWG\Parameter(name="value", description="值", required='false',type="string", paramType="form", defaultValue="" ),';
    *          @SWG\Parameter(name="id", description="id", required=true,type="integer", paramType="path", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/{id}', ['as' => 'SysDic.update', 'uses' => 'SysDicController@update']);

    /**
    * @SWG\Api(
    *     path="/api/sys-dic/{id}",
    *     @SWG\Operation(
    *      method="DELETE",
    *      nickname="sys-dic-delete",
    *      summary="删除",
    *      notes="删除",
    *      type="",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="id", description="id", required=true,type="integer", paramType="path", defaultValue="1" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::delete('/{id}', ['as' => 'SysDic.delete', 'uses' => 'SysDicController@destroy']);

});