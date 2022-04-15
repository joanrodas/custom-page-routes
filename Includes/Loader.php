<?php
namespace CustomPageRoutes\Includes;

use CustomPageRoutes\Admin\AdminMenus;
use CustomPageRoutes\Admin\AjaxActions;
use CustomPageRoutes\Admin\PostActions;

use CustomPageRoutes\General\ApiEndpoints;
use CustomPageRoutes\General\CustomFields;
use CustomPageRoutes\General\CustomPostTypes;
use CustomPageRoutes\General\Routes;
use CustomPageRoutes\General\Shortcodes;
use CustomPageRoutes\General\Taxonomies;

use CustomPageRoutes\React\ReactLoader;

class Loader {

	protected $plugin_name;
	protected $plugin_version;

	public function __construct() {
		$this->plugin_version = defined( 'CUSTOM_PAGE_ROUTES_VERSION' ) ? CUSTOM_PAGE_ROUTES_VERSION : '1.0.0';
		$this->plugin_name = 'custom-page-routes';
    $this->load_dependencies();
	}

	private function load_dependencies() {
		\PluboRoutes\RoutesProcessor::init();

		$plugin_i18n = new Languages();

		$react = new ReactLoader( $this->plugin_name, $this->plugin_version );

		$admin_menus = new AdminMenus($this->plugin_name, $this->plugin_version);
    $ajax_actions = new AjaxActions($this->plugin_name, $this->plugin_version);
    $post_actions = new PostActions($this->plugin_name, $this->plugin_version);

		$api_endpoints = new ApiEndpoints($this->plugin_name, $this->plugin_version);
    $custom_fields = new CustomFields($this->plugin_name, $this->plugin_version);
    $custom_post_types = new CustomPostTypes($this->plugin_name, $this->plugin_version);
    $routes = new Routes($this->plugin_name, $this->plugin_version);
    $shortcodes = new Shortcodes($this->plugin_name, $this->plugin_version);
    $taxonomies = new Taxonomies($this->plugin_name, $this->plugin_version);

		add_filter( 'do_shortcode_tag', function($output, $tag, $attr) {
			return "<span style='display: none;' class='plubo-shortcode' data-tag='$tag'></span>" . $output;
		}, 22, 3);

		add_action('wp_enqueue_scripts', function () {
	    wp_enqueue_style('custom-page-routes/app.css', CUSTOM_PAGE_ROUTES_URL . 'dist/app.css', false, null);
	    wp_enqueue_script('custom-page-routes/app.js', CUSTOM_PAGE_ROUTES_URL . 'dist/app.js', [], null, true);

	    wp_localize_script( 'custom-page-routes/app.js', 'plugin_placeholder_ajax', array(
	      'ajaxurl'   => admin_url( 'admin-ajax.php' ),
	      'nonce'     => wp_create_nonce( 'ajax-nonce' ),
	    ) );
		}, 100);
	}
}
