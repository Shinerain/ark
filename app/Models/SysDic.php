<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * model description
 * Class SysDic
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="SysDic")
 * @SWG\Property(name="id", type="integer", description="id")
 * @SWG\Property(name="value", type="string", description="值")
 * @SWG\Property(name="text", type="string", description="显示")
 * @SWG\Property(name="category", type="string", description="类型")
 * @SWG\Property(name="created_at", type="timestamp", description="创建时间")
 * @SWG\Property(name="updated_at", type="timestamp", description="修改时间")
  */
class SysDic extends Model
{
	//
	protected $table = 'sys_dics';
	protected $guarded = ['id'];
}
