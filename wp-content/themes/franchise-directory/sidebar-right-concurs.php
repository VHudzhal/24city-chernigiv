<?php
/*
 * The sidebar containing the main widget area
 */

 if ( is_active_sidebar( 'sidebar-16' ) || dynamic_sidebar('sidebar-16') ) : ?>

 <?php
 return;
 endif;?>

<aside class="widget" id="right-sidebar-concurs" style="">
    <div id="right-concurs-content" style="">
 <?php
 dynamic_sidebar('sidebar-16');
?>
    </div>
</aside>

