<?php defined('SYSPATH') or die('No direct script access.');

return array(
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
		'benchmarks' => TRUE,
		'database'   => TRUE,
		'vars'       => TRUE,
		'ajax'       => TRUE,
		'files'      => TRUE,
		'modules'    => TRUE,
		'routes'     => TRUE,
		'customs'    => TRUE,
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