<?php

use Illuminate\Database\Seeder;
use App\Models\SysCommand;

class SysCommandsSeedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	    SysCommand::create(['category' => 'cache', 'name' => 'cache:clear', 'desc' => 'Flush the application cache', 'signature' => 'cache:clear']);
	    SysCommand::create(['category' => 'cache','name' => 'config:cache', 'desc' => 'Create a cache file for faster configuration loading', 'signature' => 'config:cache']);
	    SysCommand::create(['category' => 'cache','name' => 'config:clear', 'desc' => 'Remove the configuration cache file', 'signature' => 'config:clear']);
	    SysCommand::create(['category' => 'cache','name' => 'route:cache', 'desc' => 'Create a route cache file for faster route registration', 'signature' => 'route:cache']);
	    SysCommand::create(['category' => 'cache','name' => 'route:clear', 'desc' => 'Remove the route cache file', 'signature' => 'route:clear']);
	    SysCommand::create(['category' => 'cache','name' => 'view:clear', 'desc' => 'Clear all compiled view files', 'signature' => 'route:clear']);


    }
}
