<?php
/*
 * The template for displaying all pages
 */
get_header();
$fr_obj = New FranchiseClass();
$args = array(
        'post_type' => 'community',
    'posts_per_page' => -1,
    'taxonomy' => 'comm'
);
$comm = new WP_Query($args);
?>

<section id="primary" class="question-content">

    <?php

    wp_nav_menu( array(
        'container'       => 'div',
        'theme_location'  => 'community-menu',
        'menu_id'         => 'comm-menu',
        'menu_class'	  => 'nav-comm-link',
        'depth'           => 1,
    ) );

    ?>

    <main id="main" class="questions container">
        <div class="header"><span id="head-title"><?php the_title()?></span></div>

        <div id="questions-content">
           <?php echo do_shortcode('[question_archive]'); ?>


        </div>

    </main><!-- #main -->

</section><!-- #primary -->


<?php //get_sidebar();
get_footer(); ?>
