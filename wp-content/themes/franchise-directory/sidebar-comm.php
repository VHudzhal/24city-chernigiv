<?php
/*
 * The sidebar containing the main widget area
 */

if ( ! is_active_sidebar( 'sidebar-7' ) ) :
    return;?>
<?php endif;?>
<?php
if ( is_active_sidebar( 'sidebar-7' ) ) : ?>
	<aside id="secondary" class="sidebar-comm widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-7' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>

