<?php
/*
 * The sidebar containing the main widget area
 */

 if ( ! is_active_sidebar( 'sidebar-9' ) ) {
	return;
}?>
<aside class="widget" id="share-buttons-sidebar">
    <?php dynamic_sidebar( 'sidebar-9' ); ?>
</aside>

