<?php
/*
 * The template for displaying all pages
 */
get_header();
$fr_obj = New FranchiseClass();
$exclude_ids = array(17062,17384);
$press_args = array(
    'post_type' => 'press',
    'order' => 'DESC',
    'order_by' => 'date',
    'post__not_in' => $exclude_ids,
    'posts_per_page' => -1,
);
$press_first_args = array(
    'post_type' => 'press',
    'posts_per_page' => 2,
    'post__in' => array(17062,17384),
);
$custom_loop = new WP_Query($press_args);
$custom_loop_first = get_posts($press_first_args);
?>

<section id="primary" class="bizov-container">
    <?php get_sidebar('head-left');?>
    <div class="content-area">
        <?php get_sidebar('left-main');?>

        <main id="main" class="site-main">

        <div class="header"><span id="head-title"><?php the_title()?></span></div>
            <div class="">
                <?php
	                echo '<ul class="news-list">';
			foreach ($custom_loop_first as $post) :  setup_postdata($post); 
?>
                <li class="news-block">
                    <div class="news-content">
                        <div class="entry-thumbnail" style="flex: 0 0 auto; padding-top: 6px;">
                            <?php $post_medium_img = $fr_obj->get_thumbnail(get_the_ID(), 'small');
                            $post_full_img = $fr_obj->get_thumbnail(get_the_ID(), 'full');?>
                            <img style="visibility: visible" width="250px" height="150px" src="<?php echo esc_url($post_medium_img);?>"  data-src="<?php echo esc_url($post_full_img);?>" class="fr_lazyload" alt="<?php the_title_attribute();?>">
                        </div>
                       <?php  echo '<div style="background-image: url('.esc_url($post_medium_img).');"></div>';?>
                        <div class="entry-content" style="flex: 0 0 65%">
                            <a href="<?php the_permalink()?>" id=""><?php the_title() ?></a>
                            <!-- <h6><?php the_author(); echo '&nbsp;'; the_date();?></h6> -->
                            <?php the_excerpt();?>
                        </div>
                    </div>
                    <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
                    <?php
                    echo '</li>';
                                        wp_reset_postdata();
                    endforeach;
                while ($custom_loop->have_posts()) : $custom_loop->the_post();?>
                <li class="news-block">
                    <div class="news-content">
                        <div class="entry-thumbnail" style="flex: 0 0 auto; padding-top: 6px;">
                            <?php $post_medium_img = $fr_obj->get_thumbnail(get_the_ID(), 'small');
                            $post_full_img = $fr_obj->get_thumbnail(get_the_ID(), 'full');?>
                            <img style="visibility: visible" width="250px" height="150px" src="<?php echo esc_url($post_medium_img);?>"  data-src="<?php echo esc_url($post_full_img);?>" class="fr_lazyload" alt="<?php the_title_attribute();?>">
                        </div>
                       <?php  echo '<div style="background-image: url('.esc_url($post_medium_img).');"></div>';?>
                        <div class="entry-content" style="flex: 0 0 65%">
                            <a href="<?php the_permalink()?>" id=""><?php the_title() ?></a>
                            <!-- <h6><?php the_author(); echo '&nbsp;'; the_date();?></h6> -->
                            <?php the_excerpt();?>
                        </div>
                    </div>
                    <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
                    <?php
                    echo do_shortcode('[favorite_button]');

                    echo '</li>';
                    // the_content();
                    wp_reset_postdata();
                    endwhile;                    
					                    echo '</ul>';
?>
            </div>

    </main><!-- #main -->
    </div>
</section><!-- #primary -->


<?php //get_sidebar();
get_footer(); ?>
