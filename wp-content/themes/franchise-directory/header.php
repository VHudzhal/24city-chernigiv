<?php
/**
 * The header for our theme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="google-site-verification" content="RixdwK_C56aY-2_m6pHXBcIG8JR8aAn-9ZOq4l5SrgE" />
<!-- 	<meta name="likebtn-website-verification" content="1724400fc0b299ff" /> -->
<meta name="facebook-domain-verification" content="znzkb2ohs8gvg6ppenrjlzds1vpk0i" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />-->
    <style type="text/css">
       header{
           margin-bottom: 0;
           padding-bottom: 0;
       }
       aside.top-banners-widget div#top-banners-group, div#front-banners-group{
            height: auto;
            min-height: 110px;
            margin-bottom: 65px;
            display: flex;
            flex-flow: row;
            justify-content: center;
        }
       aside.top-banners-widget div#top-banners-group img, div#front-banners-group img{
        margin:  0 10px;
        }
       div.the_champ_counter_container.the_champ_horizontal_counter li.the_champ_facebook_like{
           margin-right: 50px!important;
       }
    </style>
    <?php wp_head(); ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-178502668-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-178502668-1');
</script>

</head>

<body <?php body_class(); ?> >
<!--begin header-->
<?php if(is_front_page()):?>
<?php echo '<header id="header" class="bizov-container" style="min-height: 0;margin-bottom: 0!important">'; ?>
<?php else:?>
<?php echo '<header id="header" class="bizov-container">'; ?>
    <?php endif?>
    <?php //get_sidebar('top-banners');?>
    <? if (!is_front_page()): ?>

    <img class="top-banner" src="<?php echo get_stylesheet_directory_uri();?>/images/head-banner.png" alt="" style="">
<?php endif;?>
    <? if (!is_front_page()): ?>
   <?php echo '<section id="primary-navigation" style="margin-bottom: 0;">'; ?>
        <?php else: ?>
<?php    echo '<section id="primary-navigation">'; ?>
<?php endif;?>
   
    <? if (!is_front_page()): ?>
        <div class="site-branding" style="padding-left: 0; padding-top: 6px">
            <?php if (has_custom_logo()):

                $custom_logo_id = get_theme_mod('custom_logo');
                $logo_img_array = wp_get_attachment_image_src($custom_logo_id, 'full');
                $logo_img_src = esc_url($logo_img_array[0]); ?>

                <a href="<?php echo esc_url(get_home_url()); ?>" rel="home"
                   title="<?php echo esc_attr(get_bloginfo('title')); ?>"><img class="site-logo"
                                                                               src="<?php echo esc_url($logo_img_src); ?>"
                                                                               alt="<?php echo esc_attr(get_bloginfo('title')); ?>"></a>
            <?php else: ?>

                <a href="<?php echo esc_url(get_home_url()); ?>"
                   class="h4 site-title"><?php echo esc_html(get_bloginfo('name')); ?></a>
                <p class="site-description"><?php echo esc_html(get_bloginfo('description')); ?></p>

            <?php endif; ?>
        </div>
    <?php endif;
    ?>

<?php get_sidebar('head-top-right');?>
</section>
    <? if (!is_front_page()): ?>
<?php    echo '<section id="bottom-navigation" style="margin-bottom: 0!important;">'; ?>

        <?php else: ?>
<?php    echo '<section id="bottom-navigation">'; ?>
<?php endif;
    ?>
<!--        --><?php //get_sidebar('head-left');?>
        <div class="head-right-container">
            <?php
            get_sidebar('head-right');
            ?>
        </div>
    </section>

</header>
<!--end header-->
