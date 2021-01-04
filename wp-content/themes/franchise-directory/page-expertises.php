<?php
/*
 * The template for displaying all pages
 */
get_header();
$fr_obj = New FranchiseClass();
//if (function_exists('wp_recall')) wp_recall();

?>

<section id="primary" class="">
    <?php get_sidebar('head-left');?>
    <div class="content-area" style="">
        <?php   get_sidebar('left-main');?>
    <main id="main" class="site-main container">
        <div class="header"><span id="head-title"><?php the_title()?></span></div>

        <?php

//        echo do_shortcode('[if type == dwqa-question]');
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
    </div>
</section><!-- #primary -->


<?php //get_sidebar();
get_footer(); ?>
