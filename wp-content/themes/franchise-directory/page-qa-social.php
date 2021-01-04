<?php
/*
 * The template for displaying all pages
 */
get_header();
$fr_obj = New FranchiseClass();

?>

<section id="community" class="question-content bizov-container">
    <?php get_sidebar('head-left');?>

    <div class="content-area" style="">
        <?php   get_sidebar('left-main');?>

    <main id="main" class="questions site-main">
        <div class="header"><span id="head-title"><?php the_title()?></span></div>

        <div class="comm-header">
            <label for="comm-descr">Сообщество</label>
            <span id="comm-descr">Место для обмена знаниями о бизнесе</span>
        </div>
        <?php
        wp_nav_menu(array(
            'container'       => 'nav',
            'theme_location'  => 'qa-social',
            'menu_id'         => 'social-menu',
            'menu_class'	  => 'social-menu-links',
            'depth'           => 1,
        ) )
        ?>
                <div id="feeds-container">

                    <?php

		/* Start the Loop */
        echo do_shortcode('[custom-facebook-feed]');
		?>
            </div>
    </main><!-- #main -->
    </div>
</section><!-- #primary -->


<?php //get_sidebar();
get_footer(); ?>
