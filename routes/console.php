<?php

use App\Services\DbHelper;
use Illuminate\Foundation\Inspiring;
use Philo\Blade\Blade;
use App\Services\CodeBuilder;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('test', function () {
	$this->comment('begin ...');
	$db = new DbHelper();
	$columns = $db->getColumns('sys_dics');
	$builder = new CodeBuilder('SysDic', 'sys_dics', $columns);
	$builder->createFiles('route');
	$this->comment('end ...');
})->describe('philo blade test');