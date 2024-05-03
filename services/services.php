<?php
/**
 * Plugin Name: Services 
 * Description: Plugin take care of creating custom post type Services and functionality
 * Author: Aniket Kadam
 * Version: 1.0
 */

 require ( WP_PLUGIN_DIR  . "/services/custom-post.php");
 require ( WP_PLUGIN_DIR  . "/services/enque.php");
 require ( WP_PLUGIN_DIR  . "/services/metabox.php");
 require ( WP_PLUGIN_DIR  . "/services/search.php");



// Shortcode to show services on front end
add_shortcode( 'services', 'wp_services_func' );
function wp_services_func( $atts ) {
	ob_start();
  
  include( WP_PLUGIN_DIR  . "/services/show_services.php");
  $output = ob_get_clean();

	return $output;
}






