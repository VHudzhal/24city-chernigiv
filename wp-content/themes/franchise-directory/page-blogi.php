<?php
/*
 * The template for displaying all pages
 */
get_header();
$taxonomy = '';
?>

<section id="primary" class="bizov-container">
    <?php get_sidebar('head-left');?>
    <div class="content-area" style="">
        <?php   get_sidebar('left-main');?>
    <main id="main" class="site-main">
        <div class="header"><span id="head-title"><?php the_title()?></span></div>
        <?php

// Gets every term in this taxonomy
$terms = get_terms( $taxonomy );
//go through each term in this taxonomy one at a time
$blogs = new WP_Query( array(
		'post_type' => 'blogs',
//    'taxonomy' => $taxonomy,
    'posts_per_page' => -1,
    'order' => 'DESC'
) );
//		/* Start the Loop */
//		while ( have_posts() ) :
//			the_post();
//the_content();
////			get_template_part( 'template-parts/content/content', 'page' );
//		endwhile; // End of the loop.
//?>
        <ul>
        <?php

            while ($blogs->have_posts()) : $blogs->the_post();
            echo '<li>';?>
                <a href="<?php the_permalink();?>"><?php the_title();?></a>
            <?php

            the_content();
            echo '</li>';
            endwhile; // End of the loop.
        ?>
        </ul>
    </main><!-- #main -->
    </div>
</section><!-- #primary -->


<?php //get_sidebar();
get_footer(); ?>
