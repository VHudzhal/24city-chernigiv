<?php
/*
 * The template for displaying all single posts
  Template Name: My Concurs Single
  Template Post: post
 */

get_header();
$taxonomy = 'real_estate_category';
$terms = wp_get_object_terms($post->ID, $taxonomy);
$taxonomy_slug = $terms[0]->slug;
$term_id = get_queried_object()->term_id;
$args = array(
    'post_type' => 'real_estate',
    'taxonomy' => $taxonomy,
//    'posts_per_page' => 1
);
//go through each term in this taxonomy one at a time
$custom_loop = new WP_Query($args);
global $wp_query;
?>
    <section id="primary" class="bizov-container nedvizimost-<?php echo $taxonomy_slug ?>">
        <?php get_sidebar('head-left'); ?>
<!--        <div class="header"><span id="head-title">--><?php //$tax = $wp_query->get_queried_object();
//                the_title() ?><!--</span></div>-->
        <div class="content-area" style="">
            <?php //get_sidebar('left-main');?>
            <div class="header-concurs"><span id="head-title"><?php the_title()?></span></div>

            <main id="main-nedvizimost-<?php echo $post->ID; ?>" class="real-estate-list nedvizimost-main">

                <?php
                if (have_posts()):
                    while (have_posts()) : the_post();

                            get_template_part('template-parts/post/content', 'real-estate');
                        wp_reset_postdata();
                    endwhile;
                endif;
                //get_sidebar('right-concurs'); ?>
            </main>
        </div>
    </section>

<?php
//get_sidebar();
get_footer();
