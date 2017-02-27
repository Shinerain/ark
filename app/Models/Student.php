<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * model description
 * Class Student
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="Student")
 * @SWG\Property(name="age", type="integer", description="")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="math", type="string", description="")
 * @SWG\Property(name="name", type="string", description="")
 * @SWG\Property(name="score", type="integer", description="")
 * @SWG\Property(name="sex", type="string", description="")
 * @SWG\Property(name="updated_at", type="string", description="")
  */
class Student extends Model
{
	//
	protected $table = 'students';
	protected $guarded = ['id'];
}
