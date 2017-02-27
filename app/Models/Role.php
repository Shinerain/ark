<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * model description
 * Class Role
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="Role")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="name", type="string", description="名称")
 * @SWG\Property(name="display_name", type="string", description="显示名称")
 * @SWG\Property(name="description", type="string", description="描述")
 * @SWG\Property(name="updated_at", type="timestamp", description="修改时间")
 * @SWG\Property(name="created_at", type="timestamp", description="创建时间")
  */
class Role extends Model
{
	//
	protected $table = 'roles';
	protected $guarded = ['id'];
}
