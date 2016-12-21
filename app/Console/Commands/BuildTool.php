<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DbHelper;
use App\Services\CodeBuilder;

class BuildTool extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'build:module {--table=} {--model=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
	    $table = $this->option('table');
	    $model = $this->option('model');

	    $db = new DbHelper();
	    $columns = $db->getColumns($table);
	    $codebuilder = new CodeBuilder($model, $table, $columns);
	    $codebuilder->createFiles();

    }
}
