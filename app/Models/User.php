<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * model description
 * Class User
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="User")
 * @SWG\Property(name="id", type="integer", description="id")
 * @SWG\Property(name="name", type="string", description="名称")
 * @SWG\Property(name="password", type="string", description="密码")
 * @SWG\Property(name="email", type="string", description="Email")
 * @SWG\Property(name="remember_token", type="string", description="")
 * @SWG\Property(name="created_at", type="timestamp", description="创建时间")
 * @SWG\Property(name="updated_at", type="timestamp", description="修改时间")
  */
class User extends Model
{
	//
	protected $table = 'users';
	protected $guarded = ['id'];
}
