<?php
add_action('wp_ajax_custom_search_action', 'custom_search_action_callback');
add_action('wp_ajax_nopriv_custom_search_action', 'custom_search_action_callback');

function custom_search_action_callback() {
    $search_query = sanitize_text_field($_POST['search_query']);
    
    // Your custom query to retrieve search results
    $args = array(
        'post_type' => 'services', 
        's' => $search_query,
        'posts_per_page' => 8
    );
    $search_query = new WP_Query($args);
    
    if ($search_query->have_posts()) {
        while ($search_query->have_posts()) {
            $search_query->the_post();
            

        echo "<li class='card'><a class='card-link' href='" . get_permalink() . "' >
                <div class='featured-image'>
                    <img src='". get_the_post_thumbnail_url() ."' alt='" . get_the_title() ."' />
                </div>
                <div class='post-title'> '" . get_the_title() . "' </div>
                <div class='published-date'> '" . get_the_date() . "'</div>
                <div class='publisher-name'>'" . get_post_meta(get_the_ID(),'publisher_name')[0] . "'</div>
            </a>
        </li>";

        }
        wp_reset_postdata();
    } else {
        echo '<p>No results found.</p>';
    }
    die();
}



function wpse_11826_search_by_title( $search, $wp_query ) {
  if ( ! empty( $search ) && ! empty( $wp_query->query_vars['search_terms'] ) ) {
      global $wpdb;

      $q = $wp_query->query_vars;
      $n = ! empty( $q['exact'] ) ? '' : '%';

      $search = array();

      foreach ( ( array ) $q['search_terms'] as $term )
          $search[] = $wpdb->prepare( "$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like( $term ) . $n );

      if ( ! is_user_logged_in() )
          $search[] = "$wpdb->posts.post_password = ''";

      $search = ' AND ' . implode( ' AND ', $search );
  }

  return $search;
}

add_filter( 'posts_search', 'wpse_11826_search_by_title', 10, 2 );
?>