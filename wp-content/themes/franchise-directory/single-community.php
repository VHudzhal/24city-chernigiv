<?php
/*
 * The template for displaying all single posts
  Template Name: My Single
  Template Post: post
 */

get_header();
?>
	<section id="primary" class="content-area" style="">
        <?php get_sidebar('head-left');?>
        <div class="content-area" style="">
            <?php   get_sidebar('left-main');?>
		<main id="main" class="single-main" style="">
            <div class="header"><span id="head-title"><?php the_title()?></span></div>

<?php
if (have_posts()) :

while (have_posts()) : the_post();

    get_template_part( 'template-parts/post/content', 'community-questions' );

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
	</section>

<?php
//get_sidebar();
get_footer();
