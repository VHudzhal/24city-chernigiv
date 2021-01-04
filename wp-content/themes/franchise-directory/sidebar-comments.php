<?php
/*
 * The sidebar containing the main widget area
 */

if ( ! is_active_sidebar( 'sidebar-15' ) ) :
    return;?>
<?php endif;?>
<?php
if ( is_active_sidebar( 'sidebar-15' ) ) : ?>
	<aside id="secondary" class="sidebar-comm widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-15' ); ?>
        <?php echo do_shortcode('[TheChamp-FB-Comments style="background-color:lightgreen;"]') ?>
    </aside><!-- .sidebar .widget-area -->
<?php endif; ?>

