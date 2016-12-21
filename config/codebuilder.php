<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016-12-19
 * Time: 16:44
 */
return [
	//blade templates and cache folder
	'blade' => [
		'template' =>  realpath(base_path('resources/templates')),
		'template_cache' =>  realpath(base_path('resources/templates/cache')),
	],
	//outputs groups
	'outputs' => ['admin', 'api'],
	//output group
	//template name => output settings
	'admin' => [
		'model' => ['path' => realpath(app_path('Models')), 'name_pattern' => '{model}.php'],
		'route' => ['path' => realpath(base_path('routes/api')), 'name_pattern' => '{model}.php', 'name_format' => 'strtolower'],
		'controller' => ['path' => realpath(app_path('Http/Controllers/Api')), 'name_pattern' => '{model}Controller.php'],
		'view' => ['path' => realpath(base_path('resources/views')), 'name_pattern' => '{model}.blade.php', 'name_format' => 'strtolower'],
	],
	'api' => [
		'model' => ['path' => realpath(app_path('Models')), 'name_pattern' => '{model}.php'],
		'route' => ['path' => realpath(base_path('routes/api')), 'name_pattern' => '{model}.php', 'name_format' => 'strtolower'],
		'controller' => ['path' => realpath(app_path('Http/Controllers/Api')), 'name_pattern' => '{model}Controller.php'],
		'view' => ['path' => realpath(base_path('resources/views')), 'name_pattern' => '{model}.blade.php', 'name_format' => 'strtolower'],
	]
];