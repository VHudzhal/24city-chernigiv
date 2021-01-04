<?php
/*
 * The template for displaying all pages
 */
get_header();
$fr_obj = New FranchiseClass();

?>

<section id="community" class="question-content">
<!--    --><?php
//    wp_nav_menu( array(
//        'container'       => 'div',
//        'theme_location'  => 'left-menu',
//        'menu_id'         => 'left-menu',
//        'menu_class'	  => 'nav-comm-link',
//        'depth'           => 1,
//    ) );
//
    //get_sidebar('left-main');
    ?>

    <main id="main" class="site-main questions">
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

</section><!-- #primary -->


<?php //get_sidebar();
get_footer(); ?>
