<?php defined('SYSPATH') or die('No direct script access.');

$config = Kohana::config('debug_toolbar');

// Load FirePHP if it enabled in config
if($config->firephp_enabled === TRUE)
	require_once Kohana::find_file('vendor', 'firephp/packages/core/lib/FirePHPCore/FirePHP.class');

// Render Debug Toolbar on the end of application execution
if ($config->auto_render === TRUE)
	register_shutdown_function('debugtoolbar::render');