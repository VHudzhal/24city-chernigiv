<?php
/*
 * The template for displaying all pages
 */
get_header();
$fr_obj = New FranchiseClass();
$ads_args = array(
    'post_type' => 'affiche',
//    'taxonomy' => $taxonomy,
    'field' => 'slug',
//    'term' => $taxonomy_slug,
    'order' => 'DESC',
    'order_by' => 'date',
    'posts_per_page' => -1,
);
$custom_loop = new WP_Query($ads_args);
?>

<section id="primary" class="bizov-container">
    <?php get_sidebar('head-left');?>
    <div class="content-area">
        <?php get_sidebar('left-main');?>

        <main id="main" class="site-main">

        <div class="header"><span id="head-title"><?php the_title()?></span></div>
            <div class="">
                <?php
                if (have_posts()){
//                echo do_shortcode("[searchandfilter id='11203']");

                echo '<ul class="affiche-list">';
                while ($custom_loop->have_posts()) : $custom_loop->the_post();
                //    while (have_posts()) : the_post(); ?>
                <li class="affiche-block">
                    <div class="affiche-content">
                        <div class="entry-thumbnail" style="flex: 0 0 auto; padding: 6px;">
                            <?php $post_medium_img = $fr_obj->get_thumbnail(get_the_ID(), 'small');
                            $post_full_img = $fr_obj->get_thumbnail(get_the_ID(), 'full');?>
                            <img style="visibility: visible" width="250px" height="150" src="<?php echo esc_url($post_medium_img);?>"  data-src="<?php echo esc_url($post_full_img);?>" class="fr_lazyload" alt="<?php the_title_attribute();?>">
                        </div>
                        <div class="entry-content" style="flex: 0 0 65%">
                            <a href="<?php the_permalink()?>" id=""><?php the_title() ?></a>
                            <h6><?php the_author(); echo '&nbsp;'; the_date();?></h6>
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
                    //    echo do_shortcode("[post_grid id='11207']");

                    echo '</ul>';
                    }
                    else{
                        echo 'No posts Found!!!';
                    }
                    ?>
            </div>

    </main><!-- #main -->
    </div>
</section><!-- #primary -->


<?php //get_sidebar();
get_footer(); ?>
