<?php
/*
 * The template for displaying all single posts
  Template Name: My Concurs Single
  Template Post: post
 */

get_header();
$taxonomy = 'konkurs_categories';
$terms = wp_get_object_terms($post->ID, $taxonomy);
$taxonomy_slug = $terms[0]->slug;
$term_id = get_queried_object()->term_id;
$args = array(
    'post_type' => 'concurs',
    'taxonomy' => $taxonomy,
//    'posts_per_page' => 1
);
//go through each term in this taxonomy one at a time
$custom_loop = new WP_Query($args);
global $wp_query;
?>
    <section id="primary" class="bizov-container concurs-<?php echo $taxonomy_slug ?>">
        <?php get_sidebar('head-left'); ?>
<!--        <div class="header"><span id="head-title">--><?php //$tax = $wp_query->get_queried_object();
//                the_title() ?><!--</span></div>-->
        <div class="content-area" style="">
            <?php //get_sidebar('left-main');?>
            <div class="header-concurs"><span id="head-title"><?php the_title()?></span></div>

            <main id="main-concurs-<?php echo $post->ID; ?>" class="concurses-list concurs-main">

                <?php
                if (have_posts()):
                    while (have_posts()) : the_post();

                        if ($taxonomy_slug == '2020') {
                            get_template_part('template-parts/post/content', 'concurs-1');
                        } elseif ($taxonomy_slug == 'konkurs-1') {
                            get_template_part('template-parts/post/content', 'concurs-2');
                        } elseif ($taxonomy_slug == 'moe-foto') {
                            get_template_part('template-parts/post/content', 'concurs-3');
                        } elseif ($taxonomy_slug == 'ya-lyublyu-ukrainu') {
                            get_template_part('template-parts/post/content', 'concurs-4');
                        }
                        wp_reset_postdata();
                    endwhile;
                endif;
                get_sidebar('right-concurs'); ?>
            </main>
        </div>
    </section>

<?php
//get_sidebar();
get_footer();
