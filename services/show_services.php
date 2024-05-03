<?php 
//$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$url =  trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$expUrl = explode("/",$url);
$paged = "";


if(isset($expUrl[2])){
  $paged =  $expUrl[2];
}else{
  $paged = 1;
}
//print_r($expUrl[2]);

$args = array(
    'post_type'=> 'services',
    'order'    => 'DESC',
    'posts_per_page' => 8,
    'paged'          => $paged
);              

$the_query = new WP_Query( $args );
//echo "<pre>";print_r($the_query);echo "</pre>";?>
<div id="search-container">
    <input type="text" id="search-input" placeholder="Search Service by Title">
</div>
<?php
if($the_query->have_posts() ) : ?>
<ul class="card-wrapper">
<?php
    while ( $the_query->have_posts() ) : 
       $the_query->the_post(); 
       ?>
          <li class="card">
            <a class="card-link" href="<?php echo get_permalink(); ?>" title="">
                <div class="featured-image">
                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" />
                </div>
                <div class="post-title"><?php the_title(); ?></div>
                <div class="published-date"><?php echo get_the_date(); ?></div>
                <div class="publisher-name"><?php echo get_post_meta(get_the_ID(),'publisher_name')[0]; ?></div>
            </a>
        </li>
       <?php
       // content goes here
       
    endwhile; 
  ?>

  </ul>
<div class="pagination">
  <?php


    echo paginate_links(array(
      'total' => $the_query->max_num_pages,
      'current' => $paged,
      'prev_text' => __('« Previous'),
      'next_text' => __('Next »'),
  ));

  

  ?>
</div>
  <?php



    wp_reset_postdata(); ?>

<?php
else: 
endif;

?>



    
