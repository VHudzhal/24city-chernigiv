<?php
/*
 * The sidebar containing the main widget area
 */

 if ( ! is_active_sidebar( 'sidebar-4' ) ) {
	return;
}?>
<aside class="widget" id="left-sidebar">
    <?php dynamic_sidebar( 'sidebar-4' ); ?>
</aside>

