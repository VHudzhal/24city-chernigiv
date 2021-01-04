<?php
/*
 * The sidebar containing the main widget area
 */

if ( ! is_active_sidebar( 'sidebar-5' ) ) :
    return;?>
<?php endif;?>
<?php
if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
	<aside id="secondary" class="sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-5' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>

