<?php
/*
 * Template name: DWQA template
 * Template Post Type: dwqa-question
*
 */
get_header();
$fr_obj = New FranchiseClass();

?>

<section id="primary" class="content-area">
    <?php get_sidebar('head-left');?>
    <div class="content-area">
        <?php get_sidebar('left-main');?>
        <main id="main" class="site-main container">
            <div class="header"><span id="head-title"><?php the_title()?></span></div>

            <?php
        global $post;

        if($post->post_type == 'dwqa-question') {
        /* Start the Loop */

            get_template_part('template-parts/content/content', 'page');

            // If comments are open or we have at least one comment, load up the comment template.
//			if ( comments_open() || get_comments_number() ) {
//				comments_template();
//			}

	}else{
        while (have_posts()) :
            the_post();
        the_content();
        endwhile; // End of the loop.

    }
		?>

    </main><!-- #main -->
    </div>
</section><!-- #primary -->


<?php //get_sidebar();
get_footer(); ?>
