<?php
/*
 * The template for displaying all pages
 */
get_header();
$fr_obj = New FranchiseClass();

?>

<section id="primary" class="bizov-container">
    <?php get_sidebar('head-left');?>

    <div  class="content-area">
        <?php   get_sidebar('left-main');?>
    <main id="main" class="real-estate site-main">
        <div class="header"><span id="head-title"><?php the_title()?></span></div>

        <?php

//		/* Start the Loop */
//		while ( have_posts() ) :
//			the_post();
//the_content();
////			get_template_part( 'template-parts/content/content', 'page' );
//
//			// If comments are open or we have at least one comment, load up the comment template.
////			if ( comments_open() || get_comments_number() ) {
////				comments_template();
////			}
//		endwhile; // End of the loop.
//?>
        <?php

            /* Start the Loop */


            while (have_posts()) : the_post();
                the_content();
            endwhile; // End of the loop.
        ?>
    </main><!-- #main -->
    </div>
</section><!-- #primary -->


<?php //get_sidebar();
get_footer(); ?>
