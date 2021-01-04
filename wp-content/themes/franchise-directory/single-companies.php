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
        <?php   get_sidebar('left-main');?>		<main id="main" class="single-main single-company" style="">
            <div class="header"><span id="head-title"><?php the_title()?></span></div>

<?php
if (have_posts()) :

while (have_posts()) : the_post();
    get_template_part('template-parts/post/content', 'company');

            endwhile;
wp_reset_postdata();
else :
    get_template_part( 'no-results' );
endif;
/*
           +380(462)67-21-52
           +380(95)285-07-63
           +380(50)315-58-80
           +380(462)67-21-47
           +380(50)465-31-45
*/
?>

		</main>
    </div>
	</section>


<?php
get_footer();
