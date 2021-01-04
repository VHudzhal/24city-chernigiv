<?php
/*
 * The sidebar containing the main widget area
 */

if ( ! is_active_sidebar( 'sidebar-10' ) ) :
    return;?>
<?php endif;?>
<?php
if ( is_active_sidebar( 'sidebar-10' ) ) : ?>
	<div id="left-head" class="sidebar  widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-10' ); ?>
	</div><!-- .sidebar .widget-area -->
<?php endif; ?>

