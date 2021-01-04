<?php
/*
 * The sidebar containing the main widget area
 */

if ( ! is_active_sidebar( 'sidebar-13' ) ) : ?>
<?php return; ?>
<?php endif;?>
<? if (!is_front_page()): ?>
    <?php echo '<aside class="top-banners-widget" style="margin-bottom: 64px;">';?>
<?php else:?>
<?php echo '<aside class="top-banners-widget" style="margin-bottom: 0;">'; ?>
<?php endif;?>
	<?php dynamic_sidebar( 'sidebar-13' ); ?>
</aside>
