<?php
namespace vestibulum;

/**
 * Getting config data
 *
 * @return \stdClass
 */
function config() {
	static $config = [];

	return $config ? $config : $config = (object)array_replace_recursive(
		[
			'title' => 'Vestibulum',
			'cache' => false,
			'src' => getcwd() . '/src/',
			'meta' => [
				'template' => 'index.latte',
			]
		],
		@include(getcwd() . '/config.php') // intentionally @
	);
}

/**
 * @param null $path
 * @return bool
 */
function src($path = null) {
	return realpath(isset(config()->src) ? config()->src : (config()->src = getcwd() . '/src')) . $path;
}

/**
 * Simple singleton config object
 *
 * @author Roman Ožana <ozana@omdesign.cz>
 */
trait Config {

	/** @var \stdClass */
	private $config;

	/**
	 * Return src directory path
	 *
	 * @param string|null $path
	 * @return string
	 */
	public function src($path = null) {
		return
			realpath(
				(isset($this->config()->src) ? $this->config()->src : $this->config()->src = getcwd() . '/src')
			) . $path;
	}

	/**
	 * Return configuration
	 *
	 * @return \stdClass
	 */
	public function config() {
		return $this->config ? $this->config : $this->config = (object)array_replace_recursive(
			[
				'title' => 'Vestibulum',
				'cache' => false,
				'src' => getcwd() . '/src/',
				'meta' => [
					'template' => 'index.latte',
				]
			],
			@include(getcwd() . '/config.php') // intentionally @
		);
	}
}
