<?php
/*
 * The template for displaying all pages
 */
get_header();
$fr_obj = New FranchiseClass();
    $taxonomy = 'product_cat';
//$terms = wp_get_object_terms($post->ID, $taxonomy);
//$taxonomy_slug = $terms[0]->slug;
//$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
//$queried_object = get_queried_object();
//$term_id = get_queried_object()->term_id;
if(!function_exists('wc_get_products')) {
    return;
}
?>

<section id="primary" class=" bizov-container" style="">
    <?php get_sidebar('head-left');?>
    <div class="content-area" style="">
        <?php   get_sidebar('left-main');?>
        <main id="main-products" class="site-main">

        <?php
//        ubermenu('main');
//        if (have_posts()):
//        while (have_posts()) : the_post();
        //woocommerce_content();
//        endwhile;
//        endif;
        ?>
                    <div class="products">
                <?php
                $paged                   = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
                $ordering                = WC()->query->get_catalog_ordering_args();
                $ordering['orderby']     = array_shift(explode(' ', $ordering['orderby']));
                $ordering['orderby']     = stristr($ordering['orderby'], 'price') ? 'meta_value_num' : $ordering['orderby'];
                $products_per_page       = apply_filters('loop_shop_per_page', wc_get_default_products_per_row() * wc_get_default_product_rows_per_page());

                wc_set_loop_prop('is_paginated', wc_string_to_bool(true));

                $term = get_term_by('slug', get_query_var('term'), get_query_var('product_cat'));
//                echo $term->name;
                $queried_object = get_queried_object();
                $term_id = get_queried_object()->term_id;
                $term_name = get_queried_object()->name;
                        $args = array(
                                'post_type' => 'product',
                                'posts_per_page' => -1,  //show all posts
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => $taxonomy,
                                        'field' => 'slug',
                                        'terms' => $term->slug,
                                    )
                                )

                            );
                        $posts = new WP_Query($args);

?>
                    <div name="<?php echo get_queried_object()->slug?>" id="<?php echo $term_id?>" class="products-list">
                        <?php
                        $excluded_term = get_term_by('slug', get_query_var('term'), 'product_cat');
                        $args_1 = array(
                            'hierarchical' => 'true',
                            'exclude' => $excluded_term->term_id,
                            'hide_empty' => '0',
                            'parent' => $excluded_term->term_id,
                            'posts_per_page' => -1,

                        );
                        $hiterms = get_terms("product_cat", $args_1);

                        foreach ($hiterms AS $term) :?>
<?php                        $term_slug = $term->slug;
                        $_posts = new WP_Query( array(
                        'post_type'         => 'product',
                        'posts_per_page'    => 10, //important for a PHP memory limit warning
                        'tax_query' => array(
                        array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        'terms'    => $term_slug,
                        ),
                        ),
                        ));

                        if( $_posts->have_posts() ) :

                        echo '<h3 style="color: blue; font-weight: bold;">'. $term->name .'</h3>';
                    echo '<div class="row product-block" style="margin: 0; padding: 10px;">';
                            while ( $_posts->have_posts() ) : $_posts->the_post();
                                $product = wc_get_product($_posts->post->ID);
                                ?>
                            <ul class="col-lg-4 col-md-4 col-sm-12">
                                <?php
                                do_action( 'woocommerce_shop_loop' );
                                wc_get_template_part( 'content', 'product' );
                                ?>
                            </ul>
                            <?php
        endwhile;

        echo '</div>';

    endif;
    wp_reset_postdata();
                        endforeach;
                        ?>
                    </div>
<?php
//                        $post_type = 'product';
//
//// Get all the taxonomies for this post type
//$taxonomies = get_object_taxonomies( array( 'post_type' => $post_type ) );
//
//foreach( $taxonomies as $taxonomy ) :
//
//    // Gets every "category" (term) in this taxonomy to get the respective posts
//    $terms = get_terms( $taxonomy );
//
//    foreach( $terms as $term ) : ?>
<!---->
<!--        --><?php
//        $args = array(
//                'post_type' => $post_type,
//                'posts_per_page' => -1,  //show all posts
//                'tax_query' => array(
//                    array(
//                        'taxonomy' => $taxonomy,
//                        'field' => 'slug',
//                        'terms' => $term->slug,
//                    )
//                )
//
//            );
//        $posts = new WP_Query($args);
//        if( $posts->have_posts() ): ?>
<!---->
<!--         --><?php //echo $term->name; ?>
<!---->
<!--        --><?php //while( $posts->have_posts() ) : $posts->the_post(); ?>
<!--                    --><?php //if(has_post_thumbnail()) { ?>
<!--                            --><?php //the_post_thumbnail(); ?>
<!--                    --><?php //}
//                    /* no post image so show a default img */
//                    else { ?>
<!--                           <img src="--><?php //bloginfo('template_url'); ?><!--/assets/img/default-img.png" alt="--><?php //echo get_the_title(); ?><!--" title="--><?php //echo get_the_title(); ?><!--" width="50" height="50" />-->
<!--                    --><?php //} ?>
<!---->
<!--                   --><?php // echo get_the_title(); ?>
<!---->
<!--                        --><?php ////the_excerpt(); ?>
<!---->
<!--        --><?php //endwhile; endif; ?>
<!---->
<!--    --><?php //endforeach;
//
//endforeach; ?>
            </div>

    </main><!-- #main -->
    </div>
</section><!-- #primary -->


<?php //get_sidebar();
get_footer(); ?>
