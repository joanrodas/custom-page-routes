<?php
namespace CustomPageRoutes\General;

use PluboRoutes\Route\PageRoute;
use PluboRoutes\Route\RedirectRoute;

class Routes
{
	protected $plugin_name;
	protected $plugin_version;

	public function __construct($plugin_name, $plugin_version)
	{
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
		add_filter('plubo/routes', array($this, 'add_routes'));
	}

	public function add_routes($routes)
	{
		$custom_routes = carbon_get_theme_option('custom_routes');
		foreach ($custom_routes as $key => $route) {
			$path = $route['path'];
			if ($route['_type'] === 'page_route') {
				$page_id = $route['page_id'][0]['id'] ?? false;
				if (!$page_id) {
					continue;
				}
				$routes[] = new PageRoute($path, $page_id);
				$routes[] = new RedirectRoute(get_page_uri($page_id), home_url($path));
			}
		}
		return $routes;
	}
}
