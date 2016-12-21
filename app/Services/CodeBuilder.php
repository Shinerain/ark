<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016-12-19
 * Time: 16:43
 */

namespace App\Services;

use Philo\Blade\Blade;

class CodeBuilder
{
	const BEGIN_PHP = '<?php';
	protected $blade;
	protected $blade_config;
	protected $outputs;
	protected $table;
	protected $model;
	protected $columns;

	public function __construct($model, $table, $columns)
	{
		$this->table = $table;
		$this->model = ucfirst($model);
		$this->columns = $columns;
		$this->blade_config = config('codebuilder.blade');
		$this->outputs = config('codebuilder.outputs');
		$this->blade = new Blade( $this->blade_config['template'], $this->blade_config['template_cache']);
	}

	/**
	 * create file by templates
	 * @param array $outputs
	 */
	public function createFiles(...$outputs){
		$data = [
			'BEGIN_PHP' => static::BEGIN_PHP,
			'model' => $this->model,
			'table' => $this->table,
			'columns' => $this->columns
		];

		foreach ($this->outputs as $group) {
			if (!empty($outputs) && !in_array($group, $outputs)) {
				continue;
			}
			$ts = config('codebuilder.' . $group);
			foreach ($ts as $viewName => $settings) {
				$fileName = str_replace('{model}', $this->model, $settings['name_pattern']);
				if (!empty($settings['name_format']) && function_exists($settings['name_format'])) {
					$fileName = call_user_func($settings['name_format'], $fileName);
				}
				$filePath = $settings['path'] . DIRECTORY_SEPARATOR . $fileName;
				$content = $this->blade->view()->make($viewName, $data)->render();
				file_put_contents($filePath, $content);
			}
		}
	}

}

