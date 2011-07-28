<?php defined('SYSPATH') or die('No direct script access.');

// Load FirePHP if it enabled in config
if(Kohana::$config->load('debug_toolbar.firephp_enabled') === TRUE)
	require_once Kohana::find_file('vendor', 'firephp/packages/core/lib/FirePHPCore/FirePHP.class');

// Render Debug Toolbar on the end of application execution
register_shutdown_function('debugtoolbar::render');