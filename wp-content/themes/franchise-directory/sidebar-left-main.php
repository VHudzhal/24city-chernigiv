<?php
/*
 * The sidebar containing the main widget area
 */
 if (is_active_sidebar( 'sidebar-8' ) ):
?>
<aside class="widget" id="left-main-sidebar">

    <?php dynamic_sidebar( 'sidebar-8' );
    ?>
    <style type="text/css">
        a#banner div{
/*             background-image:  url(http://bizov.com.ua/wp-content/uploads/2020/02/БЛЕЭСТ-банер-360х360.gif); */
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            width: auto;
            height: 100%;
            max-height: 250px;
            margin-left: 20px;
        }
    </style>
    <a id="banner" href="#"   redirect><div></div></a>
</aside>
<?php endif; ?>
