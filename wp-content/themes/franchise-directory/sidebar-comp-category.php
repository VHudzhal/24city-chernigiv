<?php
/*
 * The sidebar containing the main widget area
 */

if ( ! is_active_sidebar( 'sidebar-14' ) ) : ?>
<?php return; ?>
<?php endif;?>

<aside class="widget-area">
	<?php dynamic_sidebar( 'sidebar-14' ); ?>
</aside>
