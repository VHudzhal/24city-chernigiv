<?php
$fr_obj = New FranchiseClass();
$taxonomy = 'konkurs_categories'; ?>

<?php get_header(); ?>

<?php

// Gets every term in this taxonomy
$terms = wp_get_object_terms($post->ID, $taxonomy);
$taxonomy_slug = $terms[0]->slug;
$term_id = get_queried_object()->term_id;
$args = array(
        'post_type' => 'concurs',
    'taxonomy' => $taxonomy,
    'term' => $taxonomy_slug,
);
$args_1 = array(
        'post_type' => 'concurs',
    'taxonomy' => $taxonomy,
    'term' => $taxonomy_slug,
    'orderby' => 'rand',
    'posts_per_page' => 1,
);
//go through each term in this taxonomy one at a time
	$custom_loop = new WP_Query($args);
	$custom_loop_rand = new WP_Query($args_1);

?>
<section class="konkurses bizov-container" id="primary">
    <?php get_sidebar('head-left');?>
    <div class="content-area" style="">
        <?php   //get_sidebar('left-main');?>
        <main id="main-concurs" class="concurses-list site-main">
        <div class="header"><span id="head-title"><?php  $tax = $wp_query->get_queried_object();
                $tax_term = $tax->name;
                $tax = get_taxonomy($tax->taxonomy);
                echo "$tax_term";?></span></div>
          <div>
              <?php
              //            if ($custom_loop_rand->have_posts()):
              while ($custom_loop_rand->have_posts()) : $custom_loop_rand->the_post(); ?>
              <div class="entry-thumbnail" style="flex: 0 0 auto; padding-top: 6px;">

                  <?php $post_medium_img = $fr_obj->get_thumbnail(get_the_ID(), 'small');
                  $post_full_img = $fr_obj->get_thumbnail(get_the_ID(), 'full');?>

                  <img style="visibility: visible" width="150px" height="250px" src="<?php echo esc_url($post_medium_img);?>"  data-src="<?php echo esc_url($post_full_img);?>" class="fr_lazyload" alt="<?php the_title_attribute();?>">
              </div>
<div>
              <a href="<?php the_permalink()?>" id=""><?php the_title() ?></a>
    <a href="<?php comments_link(); ?>">Оставить комментарий</a>

</div>
            <?php
            wp_reset_postdata();
            endwhile;
            //            endif;
            ?>

    </div>
            <div class="contests-list">


        <?php
        if ($custom_loop->have_posts()):
        while ($custom_loop->have_posts()) : $custom_loop->the_post(); ?>
        <?php the_title(); ?>
        <?php $comments = wp_count_comments($post->ID);
        ?>
            <?php
        wp_reset_postdata();
    endwhile;
    endif;
    ?>

        </div>
<div class="contests-like" style="margin-bottom: 10px">
    <label for="tax-link">Нравиться конкурс? Приглашай друзей!</label>
    <div class="like-content">
        <b>Постоянный адрес конкурса   "<?php echo $taxonomy_slug?>"</b><br>
        <input id="tax-link" type="text" value="<?php echo get_term_link($term_id, $taxonomy);?>" style="width: 330px">
    </div>
<!--    --><?php //get_sidebar('comments');?>

</div>
            <?php echo do_shortcode('[TheChamp-Sharing total_shares="ON"]') ?>
            <?php echo do_shortcode('[TheChamp-FB-Comments style="background-color:lightgreen;"]') ?>

            <div class="comments-wrapper section-inner">

                <?php comment_form(); ?>

            </div><!-- .comments-wrapper -->

        </main>
    </div>
</section>

<?php get_footer() ?>
