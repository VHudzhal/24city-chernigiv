<?php
/*
 * The template for displaying all single posts
  Template Name: My Single
  Template Post: post
 */
get_header();
?>
<section id="primary" class="bizov-container">
<?php get_sidebar('head-left');?>
    <div class="content-area" style="">
        <?php   get_sidebar('left-main');?>
        <main id="main" class="single-main single-main-news">
<?php
if (have_posts()) :
while (have_posts()) : the_post();
get_template_part( 'template-parts/post/content', 'main-news' );
            endwhile;
wp_reset_postdata();
else :
    get_template_part( 'no-results' );
endif;
?>
		</main>
    </div>
	</section>

<?php
//get_sidebar();
get_footer();