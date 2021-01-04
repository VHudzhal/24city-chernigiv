<?php
/**
 * Template part for displaying posts
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
	</header>


	<div class="entry-content">
		<?php
		the_content();
        wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'franchise' ),
				'after'  => '</div>',
			)
		);
		        $args = array(
			        'post_type' => 'franchise_catalog'
		        );
		        /* Start the Loop */
		        $franchises = new WP_Query($args);
		        while ($franchises->have_posts() ) : $franchises->the_post();

		        ?>

        <ul>
            <li><strong>Franchise: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'franchise_name', true ) ); ?></li>
            <li><strong>Price Min: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'first_min', true ) ); ?></li>
            <li><strong>Price Max: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'price_max', true ) ); ?></li>
            <li><strong>Description: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'descritpion', true ) ); ?></li>
            <li><strong>Image: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'image', true ) ); ?></li>
        </ul>
<?php endwhile;?>
    </div><!-- .entry-content -->


	<footer class="entry-footer">
	</footer><!-- .entry-footer -->

	<?php if ( ! is_singular( 'attachment' ) ) : ?>

	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
