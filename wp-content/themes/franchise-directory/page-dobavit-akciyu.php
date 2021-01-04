<?php
/*
 * The template for displaying all pages
 */
get_header();
?>

<section id="primary" class="bizov-container">
        <?php get_sidebar('head-left');?>
<div class="content-area">
    <?php    get_sidebar('left-main');?>

    <main id="main" class="site-main" role="main">
        <?php

//		/* Start the Loop */
//		while ( have_posts() ) :
//			the_post();
//the_content();
////			get_template_part( 'template-parts/content/content', 'page' );
//		endwhile; // End of the loop.
//?>
        <?php
if((is_user_logged_in())){
            while (have_posts()) : the_post();
                the_content();
            endwhile; // End of the loop.
}else{
    echo '<div>Для публикации акцию(и) пожулуйста <a href="https://24city.cn.ua/registraciya/">зарегистрируйтесь</a> на нашем сайте</div>';
      }  ?>
    </main><!-- #main -->
</div>
</section><!-- #primary -->


<?php //get_sidebar();
get_footer(); ?>
