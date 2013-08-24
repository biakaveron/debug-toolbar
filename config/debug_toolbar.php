<?php defined('SYSPATH') OR die('No direct script access.');

return array(
	/*
	 * If true, the debug toolbar will be automagically displayed
	 * NOTE: if IN_PRODUCTION is set to TRUE, the toolbar will
	 * not automatically render, even if auto_render is TRUE
	 */
	'auto_render' => Kohana::$environment !== Kohana::PRODUCTION,
	/*
	 * If true, the toolbar will default to the minimized position
	 */
	'minimized' => FALSE,
	/*
	 * Log toolbar data to FirePHP
	 */
	'firephp_enabled' => TRUE,
	/*
	 * Enable or disable specific panels
	 */
	'panels' => array(
		'benchmarks'	=> TRUE,
		'database'		=> TRUE,
		'vars'			=> TRUE,
		'ajax'			=> TRUE,
		'files'			=> TRUE,
		'modules'		=> TRUE,
		'routes'		=> TRUE,
		'customs'		=> TRUE,
	),
	/*
	 * Toolbar alignment
	 * options: right, left, center
	 */
	'align' => 'right',
	/*
	 * Secret Key
	 */
	'secret_key' => FALSE,
);