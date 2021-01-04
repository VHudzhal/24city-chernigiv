<?php
/*
 * The template for displaying all pages
 */

//get_header();
$fr_obj = New FranchiseClass();
//$tax_news = 'news';
//$tax_ads = 'ads';
//$tax_company = 'company_categories';
//$ads_args = array(
//    'post_type' => 'ads',
////    'taxonomy' => $taxonomy,
//    'field' => 'slug',
////    'term' => $taxonomy_slug,
//    'posts_per_page' => -1,
//);
//$custom_loop = new WP_Query($ads_args);
//$comp_args = array(
//    'post_type' => 'company',
//    'field' => 'slug',
//    'posts_per_page' => -1,
//);
//$custom_loop = new WP_Query($ads_args);

?>
<!--<div class="desc-info-block" style="width: max-content; position: absolute; right: 30px; top: 15px; ">-->
<!--    --><?php //if (is_user_logged_in()):
//        echo '<div style="padding: 12px; box-shadow: 0 0 2px 0 rgba(0,0,0,.1), 0 2px 6px 0 rgba(0,0,0,.1);background-color: white; display: flex; flex-flow: column;">
//            <label for=""><b>';
//        global $current_user;
//        get_currentuserinfo();
//        echo $current_user->user_firstname . '   ' . $current_user->user_lastname . "\n" . '</b></label>';
//        echo do_shortcode('[is login][user image=avatar size=50][/is]');
//echo '<a>Почта  нет новых писем</a>';
//echo '<a href="mailto:info@bizov.com.ua">Написать письмо</a>';
//        echo '</div>';
//    else:
//        echo '<div style="padding: 12px; box-shadow: 0 0 2px 0 rgba(0,0,0,.1), 0 2px 6px 0 rgba(0,0,0,.1);background-color: white; display: flex; flex-flow: column;">
//<div><a href="#">Почта</a> &nbsp;&nbsp;&nbsp;<a href="#">Завести почту</a></div>
//<div><a href="#" class="btn btn-default">Войти в почту</a></div>
//</div>';
//    endif;
//
//    ?>
<!--</div>-->
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

<body <?php body_class(); ?>

<!--Main block begin-->
<main id="content" class="">

    <style type="text/css">
        /*div.franchises-grid img{*/
            /*height: 100% !important;*/
        /*}*/
        section #primary-navigation,section#bottom-navigation{
            display: none;
        }
        .elementor-widget-container .container-wall-feed .rssapp-title-header{
            font-size: 15px!important;
        }
    </style>
    <div class="wrapper-front">


        <div class="">
            <div class="franchises-grid">
                <?php
                the_content();
                ?>
            </div>
        </div>

        <div id="front-banners-group" style="margin-top: 20px;">
<!--             <img src="<?php echo get_stylesheet_directory_uri();?>/images/XADO.gif" alt="">-->
<!--            <img src="<?php echo get_stylesheet_directory_uri();?>/images/okna-plas.gif" alt="">-->
<!--            <img src="<?php echo get_stylesheet_directory_uri();?>/images/Vins-Avto.gif" alt=""> -->
        </div>
</main>
<?php get_footer(); ?>
