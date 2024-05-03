<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php


get_header(); ?>
    <main id="main-content" class="custom-grid">
        <div class="entry-content wp-block-post-content has-global-padding ">
            <?php
              if (have_posts()) {
                  while (have_posts()) {
                      the_post();
              ?>
                <article <?php post_class( "custom-blog-item"); ?>>
                    <div class="blog-item-inner">
                        <h1 itemprop="name" class="Service-title entry-title">
                        <?php the_title(); ?>
                        </h1>

                        <div class="content-wrapper">
                        <div class="image-wrapper">
                            <?php if (has_post_thumbnail()) { ?>
                                <div class="Service-media-image">
                                    <?php the_post_thumbnail("full"); ?>
                                </div>
                                <?php
                            } ?>
                           
                        </div>
                        <div class="content-below-image">
                          <div class="publisher"><?php echo get_post_meta(get_the_ID(),'publisher_name')[0]; ?></div>
                          <div class="Service-date">
                                <div itemprop="dateCreated" class="entry-date updated">
                                    <?php the_time(get_option("date_format")); ?>
                                </div>
                            </div>
                            <div class="article-text">
                                <?php the_content(); ?>
                            </div>
                            <div>
                            <?php
                            //print_r(get_post_meta(get_the_ID(),"external_link"));
                              $viewLink = get_post_meta(get_the_ID(),"external_link");
                            ?>
                            <a href="<?php echo $viewLink[0]; ?>" title="" target="_blank" class="view-more">view more</a>
                          </div>
                        </div>
                        </div>
                        

                        
                    </div>
                </article>
                <?php
    } // End of the loop.
    
}
wp_reset_postdata();
?>
        </div>
    </main>
    <?php get_footer();