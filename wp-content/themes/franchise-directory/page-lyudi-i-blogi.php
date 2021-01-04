<?php
/*
 * The template for displaying all pages
 */
get_header();
$taxonomy = '';
$blogs_args = array(
		'post_type' => 'blogs',
//    'taxonomy' => $taxonomy,
    'posts_per_page' => -1,
    'order' => 'DESC'
);
$blogs = new WP_Query($blogs_args);
?>
<style type="text/css">
    iframe{
        width: 100%;
    }
    p{
        padding: 10px;
    }
</style>
<section id="primary" class="bizov-container">
    <?php get_sidebar('head-left');?>
    <div class="content-area" style="">
        <?php   get_sidebar('left-main');?>
    <main id="main" class="site-main">
        <div class="header"><span id="head-title"><?php the_title()?></span></div>
                    <div class="" style="padding-top: 10px">

         <div id="pagin-list" style="width: 100%; display: flex; flex-flow: row; flex-wrap: wrap; justify-content: space-between;">
        <?php
            while ($blogs->have_posts()) : $blogs->the_post();?>
            <div style="flex: 0 0 50%">
<!--             <div class="entry-content" style="width: 100%; max-width: 300px;">
 --><!--                 <a href="<?php the_permalink()?>" id=""><?php the_title() ?></a>
 -->
 <?php the_content();?>
            </div>
    <?php
    //echo '</div>';
        wp_reset_postdata();
            endwhile; // End of the loop.
        ?>
        </div>
    </main><!-- #main -->
    </div>
</section><!-- #primary -->


<?php //get_sidebar();
get_footer(); ?>
