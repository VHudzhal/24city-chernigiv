<?php
/*
 * The template for displaying all pages
 */
get_header();
$fr_obj = New FranchiseClass();

?>

<section id="primary" class="">
    <?php get_sidebar('left-main');?>
    <div class="content-area">
        <main id="main" class="site-main">
        <div class="header"><span id="head-title"><?php the_title()?></span></div>

<div class="container">
    <?php
    if (function_exists('wp_recall')) wp_recall();

    ?>
</div>
    </main><!-- #main -->
    </div>
</section><!-- #primary -->


<?php //get_sidebar();
get_footer(); ?>
