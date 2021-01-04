<?php
/*
 * The template for displaying all pages
 */
get_header();
$fr_obj = New FranchiseClass();

?>

<section id="primary" class="content-area">
    <?php get_sidebar('head-left');?>
    <div class="content-area">
        <?php get_sidebar('left-main');?>
        <main id="main" class="site-main">
        <div class="header"><span id="head-title"><?php the_title()?></span></div>

        <div class="articles-list">
            <?php
            /* Start the Loop */
//


//           for($i = 1; $i++; $i < 10){
           ?>

               <div id="" class="article">

            <?php

            /* Start the Loop */
//

                the_content();
            //endwhile; // End of the loop.
        ?>
<!--    <button class="b24-web-form-popup-btn-8 btn btn-success">Закзать консультацию</button>-->
<!--    <hr style="height: 2px; border: none; color: black; background: black">-->

</div>
<?php //}?>
        </div>
    </main><!-- #main -->
    </div>
</section><!-- #primary -->


<?php //get_sidebar();
get_footer(); ?>
