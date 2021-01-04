<?php get_header(); ?>

<section id="primary" class="company bizov-container" style="">

<?php get_sidebar('head-left');?>

<div  class="content-area">
    <?php   get_sidebar('left-main');?>

    <div class="prices-table">
        <div class="header"><span id="head-title"><?php the_title()?></span></div>

        <?php
    the_content()
    ?>
</div>
</div>
</section>
