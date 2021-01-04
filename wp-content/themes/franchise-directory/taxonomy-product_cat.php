<?php
$fr_obj = New FranchiseClass();
$taxonomy = 'comp_categories'; ?>

<?php get_header(); ?>

<?php

// Gets every term in this taxonomy
$terms = wp_get_object_terms($post->ID, $taxonomy);
$taxonomy_slug = $terms[0]->slug;
$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
//echo $term->name;
$queried_object = get_queried_object();
$term_id = get_queried_object()->term_id;
$termchildren = get_term_children($term_id, $taxonomy);
$comp_args = array(
    'post_type' => 'company',
    'taxonomy' => $taxonomy,
    'field' => 'slug',
    'term' => $taxonomy_slug,
    'posts_per_page' => -1,
);

//go through each term in this taxonomy one at a time
$custom_loop = new WP_Query($comp_args);

?>
<style type="text/css">
    div.head-block{
        flex-flow:  row;
        flex-wrap: wrap;
        display: flex;
    }
    div.second{
        flex: 0 0 50%;
    }
</style>
<section id="primary" class="all-company bizov-container">
    <?php get_sidebar('head-left'); ?>
    <div class="content-area" style="">
        <?php get_sidebar('left-main'); ?>
        <main id="main-company" class="companies-list site-main" role="main">
            <div class="header"><span id="head-title"><?php $tax = $wp_query->get_queried_object();
                    $tax_term = $tax->name;
                    $tax_count = $tax->count;
                    $tax = get_taxonomy($tax->taxonomy);
                    echo "$tax_term";
                    ?></span><span><?php echo $tax_count; ?></span></div>
            <div class="companies">
                <?php

                $term = get_term_by('slug', get_query_var('term'), get_query_var('comp_categories'));
//                echo $term->name;
                $queried_object = get_queried_object();
                $term_id = get_queried_object()->term_id;
                $term_name = get_queried_object()->name;
                $termchildren = get_term_children($term_id, $taxonomy);

//                if (!check_cat_children()) :

//                else:?>
                    <ul name="<?php echo get_queried_object()->slug?>" id="<?php echo $term_id?>" class="company-menu">
                        <!--                        <li value="--><?php //echo $term->name ?><!--"><h3>--><?php //echo $term_name ?><!--</h3></li>-->
                        <?php
                        $excluded_term = get_term_by('slug', get_query_var('term'), 'comp_categories');
                        $args = array(
//                            'orderby' => 'slug',
                            'hierarchical' => 'true',
                            'exclude' => $excluded_term->term_id,
                            'hide_empty' => '0',
                            'parent' => $excluded_term->term_id,
                        );
                        $hiterms = get_terms("comp_categories", $args);

                        foreach ($hiterms AS $hiterm) :?>
                        <div class="comp-menu">
                        <?php
                            echo '<li class="first"><a href="' . get_term_link($hiterm->term_id, 'comp_categories') . '" id="' . $hiterm->term_id . '">' . $hiterm->name .  '</a>'.$hiterm->count.'</li>';

                            $loterms = get_terms("comp_categories", array("parent" => $hiterm->term_id, 'hide_empty' => '0',));
                            if ($loterms) :?>
                                <ul class="second">
                                    <?php foreach ($loterms as $key => $loterm) :
                                        echo '<li class="child-second"><a href="' . get_term_link($loterm->term_id, 'comp_categories') . '" id="' . $loterm->term_id . '">' . $loterm->name . '</a>'.$loterm->count.'</li>';

                                    endforeach; ?>
                                </ul>
                            <?php
                            endif;
?>
                        </div>
<?php
                        endforeach;
                        ?>
                    </ul>

                <?php
                if (have_posts()){
                    echo '<ul>
                           <li>';
                    while ($custom_loop->have_posts()) : $custom_loop->the_post(); ?>

                        <div class="company">
                            <?php get_the_post_thumbnail();?>
                            <a href="<?php the_permalink()?>" id=""><?php the_title() ?></a></div>

                        <?php
                        wp_reset_postdata();
                    endwhile;
                    echo '</li>
                        </ul>';
                }
                else{
                    echo 'No posts Found!!!';
                }
                //endif;
                ?>




<?php
$my_term = get_queried_object();
//                $args = array('hide_empty' => false, 'hierarchical' => true, 'parent' => $my_term->term_id);
//                $childterms = get_terms("comp_categories", $args);
//                while( $parent_id = wp_get_term_taxonomy_parent_id( $term_id, 'comp_categories' ) ){
//                    $term_id = $parent_id;
//                }
//                while( $child_id = wp_get_term_taxonomy_parent_id( $childterms[0].term_id, 'comp_categories' ) ){
//                    $term_id = $child_id;
//                }
//                if( $term_id == $my_term->term_id){
//                    $res = locationSelector($taxonomy);
//                    echo $res;
//                    //echo 'У термина нет родительских элементов.';
//                }else{
//                    the_title();
//                }
 $bar = $my_term->term_id ?>
<?php
                /*****************************************************************/
                if ($custom_loop->have_posts()):
                    while ($custom_loop->have_posts()) : $custom_loop->the_post(); ?>
                        <?php $images = get_field('banners');
                        if ($images): ?>
                            <ul style="list-style-type: none;">
                                <?php foreach ($images as $image): ?>
                                    <li>
                                        <?php echo wp_get_attachment_image($image, 'full'); ?>

                                        <a href="<?php echo esc_url($image['url']); ?>">
                                            <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>"
                                                 alt="<?php echo esc_attr($image['alt']); ?>"/>
                                        </a>
                                        <p><?php echo esc_html($image['caption']); ?></p>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php
                        wp_reset_postdata();
                    endwhile;
                endif;

                ?>
            </div>
        </main>
    </div>
</section>
<?php get_footer() ?>
