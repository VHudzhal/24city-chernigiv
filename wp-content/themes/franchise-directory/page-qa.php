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

    <main id="main" class="site-main questions">

        <div class="comm-header">
            <div class="header"><span id="head-title"><?php the_title()?></span></div>
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
                <div id="questions-container">

            <div id="questions-list">
<?php

                echo '<div id="add-question">';
                    echo do_shortcode('[is login][user image=avatar size=avatar][/is]')?>

                    <?php
                    echo '</div>';
                    /* Start the Loop */

		/* Start the Loop */
        echo do_shortcode('[dwqa-list-questions]');
		?>

            </div>
        <div id="comm-cats">
            <button class="btn btn-success">Задать вопрос</button>
            <?php get_sidebar('comm');?>
        </div>
    </main><!-- #main -->
    </div>
</section><!-- #primary -->


<?php //get_sidebar();
get_footer(); ?>
