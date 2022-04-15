<?php
/**
 * The plugin bootstrap file
 *
 * @wordpress-plugin
 * Plugin Name:       Custom Page Routes
 * Plugin URI:        https://sirvelia.com/
 * Description:       A WordPress plugin made with PLUBO.
 * Version:           1.0.0
 * Author:            Joan Rodas - Sirvelia
 * Author URI:        https://sirvelia.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       custom-page-routes
 * Domain Path:       /languages
 */

// Direct access, abort.
if ( ! defined( 'WPINC' ) ) {
	die('YOU SHALL NOT PASS!');
}

define( 'CUSTOM_PAGE_ROUTES_VERSION', '1.0.0' );
define( 'CUSTOM_PAGE_ROUTES_PATH', plugin_dir_path( __FILE__ ) );
define( 'CUSTOM_PAGE_ROUTES_URL', plugin_dir_url( __FILE__ ) );

require_once CUSTOM_PAGE_ROUTES_PATH . 'vendor/autoload.php';

register_activation_hook( __FILE__, function() {
  CustomPageRoutes\Includes\Activator::activate();
} );

register_deactivation_hook( __FILE__, function() {
  CustomPageRoutes\Includes\Deactivator::deactivate();
} );

//LOAD ALL PLUGIN FILES
$loader = new CustomPageRoutes\Includes\Loader();
