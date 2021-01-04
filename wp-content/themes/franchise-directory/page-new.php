<?php
/*
 * Template: Franchise Catalog
 * The template for displaying all pages
 */

get_header();

$fr_obj = New FranchiseClass();
?>

<section id="primary" class="bizov-container">
    <?php get_sidebar('head-left');?>

    <div  class="content-area">
        <?php   get_sidebar('left-main');?>
    <main id="main" class="site-main">
        <div class="header"><span id="head-title"><?php the_title()?></span></div>

        <?php

        /* Start the Loop */
        get_template_part( 'template-parts/post/single', 'franchise-catalog' );

        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }
        ?>

    </main><!-- #main -->
    </div>
</section><!-- #primary -->


<?php get_footer(); ?>
