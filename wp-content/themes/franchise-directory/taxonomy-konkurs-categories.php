<?php
$fr_obj = New FranchiseClass();
$taxonomy = 'konkurs-categories'; ?>

<?php get_header(); ?>

<?php

// Gets every term in this taxonomy
$terms = wp_get_object_terms($post->ID, $taxonomy);
$taxonomy_slug = $terms[0]->slug;
$args = array(
        'post_type' => 'konkurs',
    'taxonomy' => $taxonomy,
    'term' => $taxonomy_slug,
);
//go through each term in this taxonomy one at a time
	$custom_loop = new WP_Query($args);

?>
<section class="all-company">
<?php get_sidebar('left-main');?>
    <main class="companies-list">
        <div class="header"><span id="head-title"><?php  $tax = $wp_query->get_queried_object();
                $tax_term = $tax->name;
                $tax = get_taxonomy($tax->taxonomy);
                echo "$tax_term";?></span></div>
        <div class="company">
        <?php
        if ($custom_loop->have_posts()):
        while ($custom_loop->have_posts()) : $custom_loop->the_post(); ?>
        <?php    get_template_part('template-parts/post/content', 'companies');?>


            <?php
        wp_reset_postdata();
    endwhile;
    endif;

    ?>
        </div>
    </main>
</section>

<?php get_footer() ?>
