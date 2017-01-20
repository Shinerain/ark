<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysModule extends BaseModel
{
    //

	public function children(){
		return $this->hasMany(SysModule::class, 'pid');
	}
}
