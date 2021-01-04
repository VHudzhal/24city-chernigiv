<?php
$taxonomy = 'affiche_categories'; 
$post_type = 'affiche'; 
?>

<?php get_header(); ?>

<?php

// Gets every term in this taxonomy
$terms = wp_get_object_terms($post->ID, $taxonomy);
$taxonomy_slug = $terms[0]->slug;
$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
//go through each term in this taxonomy one at a time
	$custom_loop = new WP_Query( array(
		'post_type' => $post_type,
		'taxonomy' => $taxonomy,
    'term' => $taxonomy_slug,
	) );
	global $post;
?>

<section id="primary" class="all-company bizov-container">
    <?php get_sidebar('head-left'); ?>
        <main id="main-company" class="affiches-list site-main" role="main">

<div class="header"><span id="head-title"><?php $tax = $wp_query->get_queried_object();
                    $tax_term = $tax->name;
                    $tax_count = $tax->count;
                    $tax = get_taxonomy($tax->taxonomy);
                    echo "$tax_term";
                    ?></span><span><?php echo $tax_count; ?></span></div>
<div>
        <?php
        if ($custom_loop->have_posts()):
            while ($custom_loop->have_posts()) : $custom_loop->the_post(); ?>
 <div class="affiche">
                            <?php get_the_post_thumbnail($post->ID, 'full');?>
<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
//echo $thumb_url[0];
?>
<img src="<?php echo $thumb_url[0];?>" width="100px">
                            <a href="<?php the_permalink()?>" id=""><?php the_title() ?></a></div>
                <?php
                wp_reset_postdata();
            endwhile;
        endif;

        ?>
        </div>
    </main>
</section>
<?php get_footer() ?>
