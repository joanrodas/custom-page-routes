<?php
namespace CustomPageRoutes\General;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

class CustomFields {

	protected $plugin_name;
	protected $plugin_version;

  public function __construct( $plugin_name, $plugin_version ) {
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;

    add_action( 'after_setup_theme', array($this, 'load_cf') );
    add_action( 'carbon_fields_register_fields', array($this, 'register_fields') );
	}

	public function load_cf() {
    \Carbon_Fields\Carbon_Fields::boot();
	}

  public function register_fields() {
		Container::make( 'theme_options', __( 'Custom Page Routes' ) )
		    ->add_fields( array(
		        Field::make( 'complex', 'custom_routes', __('Custom Routes', 'custom-page-routes') )
							->add_fields(__('page_route', 'custom-page-routes'), array(
									Field::make( 'text', 'path', __('Path', 'custom-page-routes') )
											->set_width( 50 )
											->set_required( true ),
					        Field::make( 'association', 'page_id', __('Page', 'custom-page-routes') )
											->set_types( array(
									        array(
									            'type'      => 'post',
									            'post_type' => 'page'
									        )
									    ) )
											->set_min(1)
											->set_max(1)
											->set_width( 50 )
											->set_required( true )
					    ) )
							->set_layout('tabbed-vertical')
							->set_header_template( '<%- path ? path : $_index %>' )
							->add_fields(__('post_route', 'custom-page-routes'), array(
									Field::make( 'text', 'path', __('Path', 'custom-page-routes') )
											->set_width( 50 )
											->set_required( true ),
					        Field::make( 'association', 'post_id', __('Page', 'custom-page-routes') )
											->set_types( array(
									        array(
									            'type'      => 'post',
									            'post_type' => 'post'
									        )
									    ) )
											->set_min(1)
											->set_max(1)
											->set_width( 50 )
											->set_required( true )
					    ) )
							->set_layout('tabbed-vertical')
							->set_header_template( '<%- path ? path : $_index %>' )
		    ) );
	}

}
