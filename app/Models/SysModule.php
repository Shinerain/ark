<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysModule extends BaseModel
{
    //

	public function children(){
		return $this->hasMany(SysModule::class, 'pid');
	}

	public function father(){
		return $this->belongsTo(SysModule::class, 'pid');
	}

	/**
	 * @param $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeTops($query){
		return $query->where('pid',0);
	}
}
