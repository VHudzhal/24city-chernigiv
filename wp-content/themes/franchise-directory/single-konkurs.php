<?php
/*
 * The template for displaying all single posts
  Template Name: My Single
  Template Post: post
 */

get_header();
$fr_obj = New FranchiseClass();
$taxonomy = 'konkurs_categories';
?>

	<div id="primary" class="content-area" style="">
<?php get_sidebar('head-left');?>
    <div class="content-area" style="">
        <?php   get_sidebar('left-main');?>
        <main id="main" class="single-main" style="">

<?php
$terms = wp_get_object_terms($post->ID, $taxonomy);
$taxonomy_slug = $terms[0]->slug;
$args = array(
    'post_type' => 'concurs',
    'taxonomy' => $taxonomy,
    'term' => $taxonomy_slug,
);
//go through each term in this taxonomy one at a time
$custom_loop = new WP_Query($args);

if (have_posts()) :

while (have_posts()) : the_post();

           endwhile;
wp_reset_postdata();
else :
    get_template_part( 'no-results' );
endif;
?>
		</main>
    </div>
	</div>

<?php
//get_sidebar();
get_footer();
