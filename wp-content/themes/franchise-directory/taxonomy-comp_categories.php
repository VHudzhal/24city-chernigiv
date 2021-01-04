<?php
$fr_obj = New FranchiseClass();
$taxonomy = 'comp_categories'; ?>

<?php get_header(); ?>

<?php

// Gets every term in this taxonomy
$terms = wp_get_object_terms($post->ID, $taxonomy);
$taxonomy_slug = $terms[0]->slug;
//$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

//echo $term->name;
$term_slug = get_query_var('term');
$queried_object = get_queried_object();
$term_id = get_queried_object()->term_id;
$term = get_term( $term_id, $taxonomy );
$slug = $term->slug;
$termchildren = get_term_children($term_id, $taxonomy);
$object = get_field( 'object', $term );
/***************************/
// = array();
//$comp_first_args = array(
//    'post_type' => 'company',
 //   'posts_per_page' => 0,
//    'post__in' => array(),
//);
//$custom_loop_first = get_posts($comp_first_args);
$comp_args = array(
    'post_type' => 'company',
    'taxonomy' => $taxonomy,
    'tax_query' => array(
        array(
            'taxonomy' => $taxonomy,
            'field' => 'slug',
            'terms' => $slug,
            'include_children' => false
        )
    ),
//    'post__not_in' => array(print_r(implode(',', $object))),
    'field' => 'slug',
    'term' => $taxonomy_slug,
    'posts_per_page' => -1
);

//go through each term in this taxonomy one at a time
$custom_loop = new WP_Query($comp_args);
$shares_args = array(
    'post_type' => 'shares',
    'taxonomy' => $taxonomy,
    'tax_query' => array(
        array(
            'taxonomy' => $taxonomy,
            'field' => 'slug',
            'terms' => $slug,
            'include_children' => false
        )
    ),
    'field' => 'slug',
    'term' => $taxonomy_slug,
    'posts_per_page' => -1
);

//go through each term in this taxonomy one at a time
$shares_loop = get_posts($shares_args);

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
        .pagination{
  
  padding:20px;
    }
  
 .pagination a{
    display:inline-block;
    padding:0 10px;
    cursor:pointer;
     
 }
    .pagination .disabled{
      opacity:.3;
      pointer-events: none;
    cursor:not-allowed;
    }
    .pagination .current{
      background:#f3f3f3;
    }
    .tax-company-list{
        display: flex;
        flex-flow: column;
    }
    .page_navigation , .alt_page_navigation{
	padding-bottom: 10px;
}

.page_navigation a, .alt_page_navigation a{
	padding:3px 5px;
	margin:2px;
	color:white;
	text-decoration:none;
	float: left;
	font-family: Tahoma;
	font-size: 12px;
	background-color:#DB5C04;
}
.active_page{
	background-color:white !important;
	color:black !important;
}
div #company-contacts a.toggler{
    font-size: 12px;
}
</style>
<section id="primary" class="all-company bizov-container">
    <?php get_sidebar('head-left'); ?>
    <div class="content-area" style="">
        <?php get_sidebar('left-main'); ?>
        <main id="main-company" class="companies-list site-main" role="main">
            <div class="header"><h6 id="head-title"><?php 
                    $tax = $wp_query->get_queried_object();
                    $tax_term = $tax->name;
                    $tax_count = $tax->count;
                    $tax = get_taxonomy($tax->taxonomy);
                    echo "$tax_term";
                    ?></h6><span><?php echo $tax_count; ?></span></div>
            <div class="companies" id="companies-list">
                <?php

                //$term = get_term_by('slug', get_query_var('term'), get_query_var('comp_categories'));
//                echo $term->name;
               // $queried_object = get_queried_object();
                //$term_id = get_queried_object()->term_id;
                $term_name = get_queried_object()->name;
                //$termchildren = get_term_children($term_id, $taxonomy);

//                if (!check_cat_children()) :

//                else:?>
                    <ul name="<?php echo get_queried_object()->slug?>" id="<?php echo $term_id?>" class="company-menu">
                        <!--                        <li value="--><?php //echo $term->name ?><!--"><h3>--><?php //echo $term_name ?><!--</h3></li>-->
                        <?php
                        $excluded_term = get_term_by('slug', get_query_var('term'), 'comp_categories');
                        $args = array(
                            'orderby' => 'date',
                            'hierarchical' => 'true',
                            'exclude' => $excluded_term->term_id,
                            'hide_empty' => '0',
                            'parent' => $excluded_term->term_id,
                        );
                        $hiterms = get_terms("comp_categories", $args);

                        foreach ($hiterms AS $hiterm) :?>
                        <div class="comp-menu">
                        <?php
                            echo '<li class="first"><i class="fas fa-folder" style="color: gold;"></i>&nbsp&nbsp<a href="' . get_term_link($hiterm->term_id, 'comp_categories') . '" id="company-' . $hiterm->term_id . '">' . $hiterm->name .  '</a><span style="color: darkgray">('.$hiterm->count.')</span></li>';

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
    // Определение запроса
    $args = array(
    'post_type' => 'company',
//    'tag' => 'first',
    'posts_per_page' => -1,
    'order' => 'asc',
    'orderby' => 'date',
        'tax_query' => array(
        array(
            'taxonomy' => $taxonomy,
            'field' => 'slug',
            'terms' => $slug,
            'include_children' => false
        )
    ),
    'field' => 'slug',
    'term' => $taxonomy_slug,
    );
    $query = new WP_Query( $args );
    // вывод списком заголовков записей
    echo '<ul id="pagin-list" class="tax-company-list content" >';
    			//foreach ($shares_loop as $post) :  setup_postdata($post);
             ?>
                 <?php $myposts = get_field( 'posts', $term ); ?>
<?php if ( $myposts ) : ?>
	<?php foreach ( $myposts as $post ) : ?>
		<?php setup_postdata ( $post ); ?>
	<?php
	endforeach; ?>
	<?php wp_reset_postdata(); ?>
<?php endif; ?>
        <?php         if($shares_loop){
echo '<h1>Акция</h1>';
foreach ($shares_loop as $post) :  setup_postdata($post); 
?>
                <li class="news-block">
                    <div class="news-content">
                        <div class="entry-thumbnail" style="flex: 0 0 auto; padding-top: 6px;">
                            <?php $post_medium_img = $fr_obj->get_thumbnail(get_the_ID(), 'small');
                            $post_full_img = $fr_obj->get_thumbnail(get_the_ID(), 'full');?>
                            <img style="visibility: visible" width="250px" height="150px" src="<?php echo esc_url($post_medium_img);?>"  data-src="<?php echo esc_url($post_full_img);?>" class="fr_lazyload" alt="<?php the_title_attribute();?>">
                        </div>
                       <?php  echo '<div style="background-image: url('.esc_url($post_medium_img).');"></div>';?>
                        <div class="entry-content" style="flex: 0 0 65%">
                            <a href="<?php the_permalink()?>" id=""><?php echo the_title() ?></a>
                            <!-- <h6><?php the_author(); echo '&nbsp;'; the_date();?></h6> -->
                            <?php the_excerpt();?>
                        </div>
                    </div>
                    <?php
                    echo '</li>';
                                        wp_reset_postdata();
                    endforeach;
                    }else{
                        //echo 'No Shares';
                    }
                    
if ($query->have_posts()){
while ( $query->have_posts() ) : $query->the_post(); ?>
        
<?php
	   get_template_part('template-parts/post/content', 'companies');
wp_reset_postdata();
    ?>
        <?php endwhile;
     
    echo '</ul>';
    echo '<div class="page_navigation"></div>';
             }else{
                    echo 'No posts Found!!!';
                }
                ?>

            </div>
        </main>
    </div>
</section>
<?php get_footer() ?>