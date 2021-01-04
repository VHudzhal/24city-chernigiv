<?php
get_header();
$fr_obj = New FranchiseClass();
$taxonomy = 'ads_categories';
$ads_args = array(
    'post_type' => 'ads',
    'taxonomy' => $taxonomy,
'order' => 'DESC',
    'order_by' => 'date',
    'posts_per_page' => -1,
);
$custom_loop = new WP_Query($ads_args);
?>
<style type="text/css">
    .searchandfilter h4{
        width: auto;
        max-width: 240px;
    }
    .simplefavorite-button{
     border-radius: 15px;
    }
</style>
	<section id="primary" class="content-area bizov-container">
        <?php get_sidebar('head-left');?>
        <div class="content-area">
            <?php get_sidebar('left-main');?>
		<main id="main" class="site-main">
            <div class="header"><span id="head-title"><?php the_title()?></span></div>
            <div class="">
 <div id="pagin-list" style="">
<?php

    while ($custom_loop->have_posts()) : $custom_loop->the_post();?>
    <div style="display: flex; flex-flow: row; align-items: center">
    <div class="entry-thumbnail" style="flex: 0 0 auto">
        <?php
    if ( has_post_thumbnail() ) {
					the_post_thumbnail('thumbnail');
				}else{?>
		    <img class="" width="50" src="<?php echo get_stylesheet_directory_uri();?>/images/none-image.png" alt="" style="">
<?php } ?>   
        </div>
            <div class="entry-content" style="flex: 0 0 70%">
                <a href="<?php the_permalink()?>" id=""><?php the_title() ?></a>
                <h6><?php the_author(); echo '&nbsp;'; the_date();?></h6>
                <?php the_excerpt();?>
            </div>
    <?php
    echo '</div>';
        wp_reset_postdata();
    endwhile;
?>
            </div>
		</main><!-- #main -->
        </div>
	</section><!-- #primary -->
<?php get_footer(); ?>