<?php

// Register custom fields for 'services' post type
function custom_register_service_fields() {
  // Add custom field for publisher name
  register_meta('post', 'publisher_name', array(
      'show_in_rest' => true,
      'single' => true,
      'type' => 'string',
  ));

  // Add custom field for external link
  register_meta('post', 'external_link', array(
      'show_in_rest' => true,
      'single' => true,
      'type' => 'string',
  ));
}
add_action('init', 'custom_register_service_fields');

// Display custom fields on the post editor screen
function custom_add_service_fields() {
  add_meta_box(
      'service_fields',
      'Service Details',
      'custom_render_service_fields',
      'services',
      'normal',
      'default'
  );
}
add_action('add_meta_boxes', 'custom_add_service_fields');

function custom_render_service_fields($post) {
  // Retrieve existing values for publisher name and external link
  $publisher_name = get_post_meta($post->ID, 'publisher_name', true);
  $external_link = get_post_meta($post->ID, 'external_link', true);

  // Output HTML for custom fields
  ?>
  <p>
      <label for="publisher_name">Publisher Name:</label><br>
      <input type="text" id="publisher_name" name="publisher_name" value="<?php echo esc_attr($publisher_name); ?>">
  </p>
  <p>
      <label for="external_link">External Link:</label><br>
      <input type="text" id="external_link" name="external_link" value="<?php echo esc_url($external_link); ?>">
  </p>
  <?php
}

// Save custom field values
function custom_save_service_fields($post_id) {
  if (array_key_exists('publisher_name', $_POST)) {
      update_post_meta(
          $post_id,
          'publisher_name',
          sanitize_text_field($_POST['publisher_name'])
      );
  }

  if (array_key_exists('external_link', $_POST)) {
      update_post_meta(
          $post_id,
          'external_link',
          esc_url($_POST['external_link'])
      );
  }
}
add_action('save_post_services', 'custom_save_service_fields');

?>