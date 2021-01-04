<?php
/*
 * The template for displaying all pages
 */
get_header();
?>
<section id="primary" class="bizov-container">
<div class="content-area">
    <?php    get_sidebar('left-main');?>
    <main id="main" class="site-main container" role="main">
        <?php

            while (have_posts()) : the_post();
                the_content();
            endwhile; // End of the loop.
        ?>
    </main><!-- #main -->
</div>
</section><!-- #primary -->
<?php //get_sidebar();
get_footer(); ?>
