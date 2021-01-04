<?php
/*
 * The template for displaying all pages
 */
get_header();
$fr_obj = New FranchiseClass();
$ads_args = array(
    'post_type' => 'mainnews',
//    'taxonomy' => $taxonomy,
//    'field' => 'slug',
//    'term' => $taxonomy_slug,
    'order' => 'DESC',
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

                echo '<ul class="news-list">';
                while ($custom_loop->have_posts()) : $custom_loop->the_post();
                //    while (have_posts()) : the_post(); ?>
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
                            <h6><?php the_author(); echo '&nbsp;'; the_date();?></h6>
                            <?php the_excerpt();?>
                        </div>
                    </div>
                    <?php //if(function_exists('the_ratings')) { the_ratings(); } ?>
                    <?php
                    echo '</li>';
                    // the_content();

                    wp_reset_postdata();
                    endwhile;
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
