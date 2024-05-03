<?php
// Define the function to enqueue your stylesheet
function enqueue_plugin_stylesheet() {
  // Get the URL of the plugin directory
  $plugin_url = plugin_dir_url( __FILE__ );

  // Enqueue the stylesheet
  wp_enqueue_style( 'service-style', $plugin_url . 'style/services.css' ); // Adjust the path to your stylesheet accordingly
}
add_action( 'wp_enqueue_scripts', 'enqueue_plugin_stylesheet' );

// Include scripts in plugin
function enqueue_custom_scripts() {
  $plugin_url = plugin_dir_url( __FILE__ );
  wp_enqueue_script('service-scripts', $plugin_url . '/js/service-scripts.js', array('jquery'), '', true);
  wp_localize_script('service-scripts', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

?>