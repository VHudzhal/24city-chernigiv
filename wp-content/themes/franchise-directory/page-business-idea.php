<?php
/*
 * Template: Franchise Catalog
 * The template for displaying all pages
 */

get_header();

$fr_obj = New FranchiseClass();
?>


<div id="primary" class="content-area">
    <?php get_sidebar('head-left');?>
    <div class="content-area" style="">
        <?php   get_sidebar('left-main');?>
        <main id="main" class="site-main">
            <div class="header"><span id="head-title"><?php the_title()?></span></div>

		<?php

        /* Start the Loop */
		get_template_part( 'template-parts/post/content', 'business-idea' );
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>

	</main><!-- #main -->
    </div>
</div><!-- #primary -->


<?php get_footer(); ?>
