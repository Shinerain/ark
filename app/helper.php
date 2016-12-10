<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016-12-10
 * Time: 12:06
 */
if(!function_exists('load_routes')) {

	function load_routes($dir)
	{
		foreach (glob($dir . '/*') as $filename) {
			if (is_dir($filename)) {
				load_routes($filename);
			} elseif (is_file($filename)) {
				require $filename;
			}
		}
	}

}