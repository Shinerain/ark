<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * model description
 * Class Permission
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="Permission")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="name", type="string", description="名称")
 * @SWG\Property(name="display_name", type="string", description="显示名称")
 * @SWG\Property(name="description", type="string", description="描述")
 * @SWG\Property(name="type", type="string", description="类型(menu, policy)")
 * @SWG\Property(name="data", type="string", description="json data,menu=&gt;{category:&quot;module/page/function&quot;, route: &quot;route_name&quot;}, policy=&gt;{model: &quot;user&quot;, op: [&quot;view&quot;,&quot;create&quot;,&quot;update&quot;,&quot;delete&quot;]}")
 * @SWG\Property(name="created_at", type="timestamp", description="创建时间")
 * @SWG\Property(name="updated_at", type="timestamp", description="修改时间")
  */
class Permission extends Model
{
	//
	protected $table = 'permissions';
	protected $guarded = ['id'];
}
