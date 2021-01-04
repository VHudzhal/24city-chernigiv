<?php
/*
 * The sidebar containing the main widget area
 */

 if ( is_active_sidebar( 'sidebar-3' ) || dynamic_sidebar('sidebar-3') ) : ?>

 <?php
 return;
 endif;?>

<aside class="widget" id="right-sidebar-company" style="">
    <div id="right-sidebar-content" style="">
 <?php
 dynamic_sidebar('sidebar-12');
?>
    </div>
    <style type="text/css">
        a#banner div{
            background:  url(http://bizov.com.ua/wp-content/uploads/2020/02/БЛЕЭСТ-банер-360х360.gif);
            background-repeat: no-repeat;
            background-position: top;
            background-size: contain;
            display: flex;
            width: auto;
            height: 100%;
            min-height: 230px;
        }
    </style>
    <a id="banner" href="http://map.cn.ua/info/7045/"   redirect><div></div></a>
</aside>

