<?php
/*
 * The template for displaying all pages
 */
get_header();
$fr_obj = New FranchiseClass();

?>

<section id="primary" class="content-area">
    <?php
    wp_nav_menu( array(
        'container'       => 'div',
        'theme_location'  => 'community-menu',
        'menu_id'         => 'comm-menu',
        'menu_class'	  => 'nav-comm-link',
        'depth'           => 1,
    ) );
    ?>
    <main id="main" class="site-main">

        <?php
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
		//			get_template_part( 'template-parts/content/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
//			if ( comments_open() || get_comments_number() ) {
//				comments_template();
//			}
		endwhile; // End of the loop.
		?>

    </main><!-- #main -->
</section><!-- #primary -->


<?php //get_sidebar();
get_footer(); ?>
