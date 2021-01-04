<?php
/*
 * The template for displaying all pages
 */
get_header();
$fr_obj = New FranchiseClass();

?>

<section id="primary" class="content-area">
    <?php get_sidebar('head-left');?>
    <div class="content-area" style="">
        <?php   get_sidebar('left-main');?>
    <main id="main" class="site-main content" style="">
        <div class="header"><span id="head-title"><?php the_title()?></span></div>

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
