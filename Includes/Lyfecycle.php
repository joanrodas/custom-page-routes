<?php

namespace CustomPageRoutes\Includes;

class Lyfecycle
{
	public static function activate()
	{
		do_action('CustomPageRoutes/create_tables');
	}
	
	public static function deactivate()
	{

	}
	
	public static function uninstall()
	{
		do_action('CustomPageRoutes/remove_tables');
	}
}
