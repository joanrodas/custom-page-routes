<?php
namespace CustomPageRoutes\Includes;

use CustomPageRoutes\General\CustomFields;
use CustomPageRoutes\General\Routes;
use PluboRoutes\RoutesProcessor;

class Loader
{
	protected $plugin_name;
	protected $plugin_version;

	public function __construct()
	{
		$this->plugin_version = defined('CUSTOM_PAGE_ROUTES_VERSION') ? CUSTOM_PAGE_ROUTES_VERSION : '1.0.0';
		$this->plugin_name = 'custom-page-routes';
		$this->load_dependencies();
	}

	private function load_dependencies()
	{
		RoutesProcessor::init();
		new Languages();
		new CustomFields($this->plugin_name, $this->plugin_version);
		new Routes($this->plugin_name, $this->plugin_version);
	}
}
