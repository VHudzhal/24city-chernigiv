<?php
$fr_obj = New FranchiseClass();
$taxonomy = 'main_news_category'; ?>

<?php get_header(); ?>

<?php

// Gets every term in this taxonomy
$terms = wp_get_object_terms($post->ID, $taxonomy);
$taxonomy_slug = $terms[0]->slug;
$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
//echo $term->name;
$queried_object = get_queried_object();
$term_id = get_queried_object()->term_id;
$termchildren = get_term_children($term_id, $taxonomy);
$comp_args = array(
    'post_type' => 'mainnews',
    'taxonomy' => $taxonomy,
    'field' => 'slug',
    'term' => $taxonomy_slug,
    'posts_per_page' => -1,
);

//go through each term in this taxonomy one at a time
$custom_loop = new WP_Query($comp_args);

?>
<style type="text/css">
    div.head-block{
        flex-flow:  row;
        flex-wrap: wrap;
        display: flex;
    }
    div.second{
        flex: 0 0 50%;
    }
</style>
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
<?php get_footer() ?>
