<?php
/*
 * The sidebar containing the main widget area
 */

if ( ! is_active_sidebar( 'sidebar-11' ) ) :
    return;?>
<?php endif;?>
<?php
if ( is_active_sidebar( 'sidebar-11' ) ) : ?>
	<aside id="head-right-sidebar" class="sidebar  widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-11' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>

