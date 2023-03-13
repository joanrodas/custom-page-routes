<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Custom Page Routes
 * Description:       Add custom routes easily, without needing to manually update permalinks
 * Version:           1.0.0
 * Author:            Joan Rodas
 * Author URI:        https://github.com/joanrodas/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       custom-page-routes
 * Domain Path:       /languages
 */

// Direct access, abort.
if (!defined('WPINC')) {
  die('YOU SHALL NOT PASS!');
}

// Plugin constants
define('CUSTOM_PAGE_ROUTES_VERSION', '1.0.0');
define('CUSTOM_PAGE_ROUTES_PATH', plugin_dir_path(__FILE__));
define('CUSTOM_PAGE_ROUTES_URL', plugin_dir_url(__FILE__));

// Load dependencies
require_once CUSTOM_PAGE_ROUTES_PATH . 'vendor/autoload.php';

// Plugin lyfecycle
register_activation_hook(__FILE__, [CustomPageRoutes\Includes\Lyfecycle::class, 'activate']);
register_deactivation_hook(__FILE__, [CustomPageRoutes\Includes\Lyfecycle::class, 'deactivate']);
register_uninstall_hook(__FILE__, [CustomPageRoutes\Includes\Lyfecycle::class, 'uninstall']);

// Load plugin classes
new CustomPageRoutes\Includes\Loader();