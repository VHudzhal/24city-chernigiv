<?php
/*
 * The template for displaying all single posts
  Template Name: DWQA-Question
  Template Post: dwqa-question
 */

get_header();
?>
	<div id="primary" class="content-area" style="">
<?php get_sidebar('head-left');?>
    <div class="content-area" style="">
        <?php   get_sidebar('left-main');?>		<main id="main" class="single-main" style="">

<?php
if (have_posts()) :

while (have_posts()) : the_post();

    get_template_part( 'template-parts/post/content', 'services-list' );
the_content();
//if(is_tax('franchises')){
//    get_template_part( 'template-parts/post/content', 'franchise-catalog' );
//}
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
