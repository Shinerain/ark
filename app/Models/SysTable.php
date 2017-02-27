<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysTable extends BaseModel
{
    //

	public function columns(){
		return $this->hasMany(SysColumn::class, 'sys_table_id');
	}
}
