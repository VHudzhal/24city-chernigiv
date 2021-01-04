<?php
/*
 * The template for displaying all pages
 */
get_header();
$fr_obj = New FranchiseClass();

?>

<section id="primary" class="content-area">
    <main id="main" class="site-main">
<?php
wp_nav_menu( array(
    'container'       => 'div',
    'theme_location'  => 'community-menu',
    'menu_id'         => 'comm-menu',
    'menu_class'	  => 'nav-comm-link',
    'depth'           => 1,
) );
?>

		<!-- Start the Loop -->
<!--		    <h1>--><?php //echo $term->name; ?><!--</h1>-->
<?php //acf_form(array(
//        'id'		=> 'question',
//        'post_id'	=> 'new_post',
//        'new_post'	=> array(
//            'post_type'		=> 'community',
//            'post_status'	=> 'publish'
//        ),
////        'post_title'=> true,
////        'post_content'=> true,
//        'submit_value'  => 'Задать вопрос'
//        )
//    );
echo do_shortcode('[dwqa-submit-question-form]')
?>

    </main><!-- #main -->
</section><!-- #primary -->


<?php //get_sidebar();
get_footer(); ?>
