<?php
/*
 * The template for displaying all pages
 */
get_header();
$taxonomy = '';
?>
<style type="text/css">
        .pagination{
  
  padding:20px;
    }
  
 .pagination a{
    display:inline-block;
    padding:0 10px;
    cursor:pointer;
     
 }
    .pagination .disabled{
      opacity:.3;
      pointer-events: none;
    cursor:not-allowed;
    }
    .pagination .current{
      background:#f3f3f3;
    }
</style>
<section id="primary" class="bizov-container">
    <?php get_sidebar('head-left');?>
    <div class="content-area" style="">
        <?php   get_sidebar('left-main');?>
    <main id="main" class="site-main container">
        <div class="header"><span id="head-title"><?php the_title()?></span></div>
        <?php

// Gets every term in this taxonomy
$terms = get_terms( $taxonomy );
$peoples_args = array(
		'post_type' => 'peoples',
//    'taxonomy' => $taxonomy,
    'posts_per_page' => -1,
    'order' => 'DESC'
);
//go through each term in this taxonomy one at a time
$peoples = new WP_Query($peoples_args);
?>
        <?php
echo '<ul id="pagin-list">';
            while ($peoples->have_posts()) : $peoples->the_post();
            echo '<li class="line-content">';?>
        <div class="people-content">
    <div class="entry-thumbnail" style="flex: 0 0 auto">
        <?php
    if ( has_post_thumbnail() ) {
					//echo '<p>';
					the_post_thumbnail("thumbnail");
					//echo '</p>';
				}else{?>
		    <img class="" width="100px" src="<?php echo get_stylesheet_directory_uri();?>/images/none-image.png" alt="" style="">
<?php	} ?>   
        </div>
            <div class="entry-content" style="flex: 0 0 70%">
                <a href="<?php the_permalink()?>" id=""><?php the_title() ?></a>
                <h6><?php the_author(); echo '&nbsp;'; the_date();?></h6>
                <?php //the_excerpt();?>
            </div>
    </div>
            <?php
            echo '</li>';
                    wp_reset_postdata();

            endwhile; // End of the loop.
        ?>
        </ul>
    </main><!-- #main -->
    </div>
</section><!-- #primary -->


<?php //get_sidebar();
get_footer(); ?>
