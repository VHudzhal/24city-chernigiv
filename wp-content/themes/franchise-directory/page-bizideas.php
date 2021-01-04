<?php
/*
 * The template for displaying all pages
 */
get_header();
$fr_obj = New FranchiseClass();
//if (function_exists('wp_recall')) wp_recall();

?>

<section id="primary" class="content-area">
    <main id="main" class="biz-ideas">
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

            get_template_part('template-parts/content/content', 'page');

            // If comments are open or we have at least one comment, load up the comment template.
//			if ( comments_open() || get_comments_number() ) {
//				comments_template();
//			}


            while (have_posts()) : the_post();
                the_content();
            endwhile; // End of the loop.
        ?>
    </main><!-- #main -->
</section><!-- #primary -->


<?php //get_sidebar();
get_footer(); ?>
