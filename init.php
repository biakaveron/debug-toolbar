<?php defined('SYSPATH') OR die('No direct script access.');

// Load FirePHP if it enabled in config
if (Kohana::$config->load('debug_toolbar.firephp_enabled') === TRUE AND ! class_exists('FirePHP', FALSE))
{
	$file = 'firephp/packages/core/lib/FirePHPCore/FirePHP.class';
	
	if ($firePHP = Kohana::find_file('vendor', $file)) 
	{
		require_once $firePHP;
	}
	else
	{
		throw new Kohana_Exception('The FirePHP :file could not be found', array(':file' => $file));
	}
}
// Render Debug Toolbar on the end of application execution
if (Kohana::$config->load('debug_toolbar.auto_render') === TRUE)
{
	register_shutdown_function('Debugtoolbar::render', TRUE);
}