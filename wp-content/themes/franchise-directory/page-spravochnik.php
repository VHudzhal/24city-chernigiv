<?php
get_header();
$fr_obj = New FranchiseClass();
$taxonomy = 'comp_categories';
$my_args = array(
        'post_type' => 'company',
    'taxonomy' =>  $taxonomy,
    'posts_per_page' => -1,
    'order' => 'ASC',
    'hide_empty' => 0,
    'parent' => 0,
    'number' => '0',
    'with_thumbnail' => true

);
$company = new WP_Query($my_args);
$terms = get_terms( $taxonomy, $my_args );
//$cat_id = get_query_var($taxonomy);
$images_raw  = get_option( 'taxonomy_image_plugin' ); // получаем все изображения в виде массива
$term_taxonomy_string = '';

?>
<style type="text/css">
img.banner-image[src=""]{
    display: none!important;
}
    .company-col{
        padding: 0;
    }
</style>
<section id="primary" class="company bizov-container" style="">
    <?php get_sidebar('head-left');?>
<div class="content-area" style="">
    <?php   get_sidebar('left-main');?>
    <main id="main-company" class="site-main">
        <div class="header"><span id="head-title"><?php the_title()?></span></div>
        <?php echo '<div class="content"><div class="row company-categories-group" style="height: 100%!important; margin: 0; width: 100%">';
        //while ( $company->have_posts() ) : $company->the_post();
echo '<div class="col-lg-6 col-md-12 col-xs-12 col-sm-12 company-col">';
        foreach ( $terms as $term ) {
                   $term_taxonomy_id = $term->term_taxonomy_id; // узнаем ID категории
                   $term_taxonomy_name = $term->name;    // узнаем имя категории
                   $term_taxonomy_image = wp_get_attachment_image($images_raw[$term_taxonomy_id], 'full');    // получаем прикрепленное изображение
                   $term_taxonomy_link = get_term_link($term, $taxonomy);    // получаем ссылку на соответствующую рубрику
                   $term_taxonomy_descr = term_description($term_taxonomy_id, $taxonomy);    // получаем ссылку на соответствующую рубрику

               if($term_taxonomy_id === 42 ||
				  $term_taxonomy_id === 53 ||
				  $term_taxonomy_id === 56 ||
				  $term_taxonomy_id === 58 ||
				  $term_taxonomy_id === 84 ||
				  $term_taxonomy_id === 100 ||
				  $term_taxonomy_id === 111 ||
				  $term_taxonomy_id === 116 ||
				  $term_taxonomy_id === 140 ||
				  $term_taxonomy_id === 149 ||
				  $term_taxonomy_id === 166 ||
				  $term_taxonomy_id === 186 ||
				  $term_taxonomy_id === 194 ||
				  $term_taxonomy_id === 215

				 ) {
                   $args = array(
                       'orderby' => 'slug',
                       'hierarchical' => 'true',
                       'exclude' => $term_taxonomy_id,
                       'hide_empty' => '0',
                       'parent' => $term_taxonomy_id,
                   );
                   $my_hiterms = get_terms("comp_categories", $args);
                   echo '<div class=" company-category" id="company-' . $term_taxonomy_id . '">';
                   echo '<div class="catInfo">';
                   echo '<div class="thumbnail">' . $term_taxonomy_image . '</div>';
                   echo '<div class="catTitle"><a href="' . $term_taxonomy_link . '">' . $term_taxonomy_name . '</a><p class="first-cat-list">';
                   foreach ($my_hiterms AS $hiterm) :

                       echo '<span class="" href="' . get_term_link($hiterm->term_id, 'comp_categories') . '" id="' . $hiterm->term_id . '">' . $hiterm->name . ',</span>';
                   endforeach;
                   echo '</p>';
                   $term_id = get_queried_object()->term_id;
$term_meta = get_option( "taxonomy_$term_taxonomy_id" );
                          echo '<p style="flex: 2 2 100%">';
echo esc_attr( $term_meta['custom_term_meta'] ) ? esc_attr( $term_meta['custom_term_meta'] ) : '';
echo '</p>';
                   echo '</div>';
                   echo '</div>';
                   echo '<div class="category-menu" style="">';
                   ?>
                   <div class="company-group-head-menu">
                       <a class="btn btn-default drop-btn" id="<?php echo $term_taxonomy_id ?>">
                           <i class="fa fa-line-columns"></i>
                       </a>
                       <?php
                       $excluded_term = get_term_by('slug', get_query_var('term'), 'comp_categories');
                       $args = array(
                           'orderby' => 'slug',
                           'hierarchical' => 'true',
                           'exclude' => $term_taxonomy_id,
                           'hide_empty' => '0',
                           'parent' => $term_taxonomy_id,
                       );
                       $hiterms = get_terms("comp_categories", $args);
                       ?>
                       <ul class="item-menu" id="company-menu-<?php echo $term_taxonomy_id ?>">
                           <?php
                           foreach ($hiterms AS $hiterm) :
                               ?>
                               <li class="first">
                                   <?php
                                   echo '<a class="sub-link" href="' . get_term_link($hiterm->term_id, 'comp_categories') . '" id="' . $hiterm->term_id . '">' . $hiterm->name . '</a><button class="sub-btn"><i class="fa fa-arrow-from-top"></i></button>';
                                   ?>

                                   <?php $loterms = get_terms("comp_categories", array("parent" => $hiterm->term_id, 'hide_empty' => '0',));
                                   if ($loterms) :?>
                                       <ul class="sub-menu">
                                           <?php foreach ($loterms as $key => $loterm) :
                                               echo '<li class="child-second"><a href="' . get_term_link($loterm->term_id, 'comp_categories') . '" id="' . $loterm->term_id . '">' . $loterm->name . '</a>' . $loterm->count . '</li>';
                                           endforeach; ?>
                                       </ul>
                                   <?php

                                   endif;

                                   ?>
                               </li>
                           <?php
                           endforeach;

                           ?>

                       </ul>

                   </div>
                   <!--                <ul>-->
                   <?php
//                   if (function_exists('wp_get_terms_meta')) {
//                       $metaValue = wp_get_terms_meta($term_taxonomy_id, 'company-banners', true);
//                       //where $category_id is 'category/term id' and $meta_key is 'meta key'
//                   }
//
////meta value for meta key $meta_key
//
//// Get the current category ID, e.g. if we're on a category archive page
//                   $category = get_category(get_query_var('comp_categories'));
//                   $cat_id = $category->cat_ID;
//// Get the image ID for the category
//                   $image_id = get_term_meta($term_taxonomy_id, 'series-image', true);
//// Echo the image
//                   echo wp_get_attachment_image($image_id, 'large');
                   echo '</div>';
                   //echo '<img class="banner-image" src="' . $metaValue . '" alt="" width="250px" height="120px" style="" />';
                   echo '</div>';
               }
            }
        echo '</div>';
        echo '<div class="col-lg-6 col-md-12 col-xs-12 col-sm-12 company-col">';
        foreach ( $terms as $term ) {
            $term_taxonomy_id = $term->term_taxonomy_id; // узнаем ID категории
                   $term_taxonomy_name = $term->name;    // узнаем имя категории
                   $term_taxonomy_image = wp_get_attachment_image($images_raw[$term_taxonomy_id], 'full');    // получаем прикрепленное изображение
                   $term_taxonomy_link = get_term_link($term, $taxonomy);    // получаем ссылку на соответствующую рубрику
                   $term_taxonomy_descr = term_description($term_taxonomy_id, $taxonomy);    // получаем ссылку на соответствующую рубрику

//               if($term_taxonomy_id >= 1561 && $term_taxonomy_id <= 1574) {
               if($term_taxonomy_id === 51 ||
				  $term_taxonomy_id === 54 ||
				  $term_taxonomy_id === 57 ||
				  $term_taxonomy_id === 62 ||
				  $term_taxonomy_id === 98 ||
				  $term_taxonomy_id === 99 ||
				  $term_taxonomy_id === 112 ||
				  $term_taxonomy_id === 121 ||
				  $term_taxonomy_id === 141 ||
				  $term_taxonomy_id === 159 ||
				  $term_taxonomy_id === 188 ||
				  $term_taxonomy_id === 193 ||
				  $term_taxonomy_id === 196) {
                   $args = array(
                       'orderby' => 'slug',
                       'hierarchical' => 'true',
                       'exclude' => $term_taxonomy_id,
                       'hide_empty' => '0',
                       'parent' => $term_taxonomy_id,
                   );
                   $my_hiterms = get_terms("comp_categories", $args);
                   echo '<div class=" company-category" id="company-' . $term_taxonomy_id . '">';
                   echo '<div class="catInfo">';
                   echo '<div class="thumbnail">' . $term_taxonomy_image . '</div>';
                   echo '<div class="catTitle"><a href="' . $term_taxonomy_link . '">' . $term_taxonomy_name . '</a><p class="first-cat-list">';
                   foreach ($my_hiterms AS $hiterm) :

                       echo '<span class="" href="' . get_term_link($hiterm->term_id, 'comp_categories') . '" id="' . $hiterm->term_id . '">' . $hiterm->name . ',</span>';
                   endforeach;
                   echo '</p>';
                   echo '<p style="flex: 2 2 100%">';
$term_meta = get_option( "taxonomy_$term_id" );
echo esc_attr( $term_meta['custom_term_meta'] ) ? esc_attr( $term_meta['custom_term_meta'] ) : '';
echo '</p>';
                   echo '</div>';
                   //$my_excluded_term = get_term_by('slug', get_query_var('term'), 'comp_categories');
                   echo '</div>';
                   echo '<div class="category-menu" style="">';
                   ?>
                   <div class="company-group-head-menu">
                       <a class="btn btn-default drop-btn" id="<?php echo $term_taxonomy_id ?>">
                           <i class="fa fa-line-columns"></i>
                       </a>
                       <?php
                       $excluded_term = get_term_by('slug', get_query_var('term'), 'comp_categories');
                       $args = array(
                           'orderby' => 'slug',
                           'hierarchical' => 'true',
                           'exclude' => $term_taxonomy_id,
                           'hide_empty' => '0',
                           'parent' => $term_taxonomy_id,
                       );
                       $hiterms = get_terms("comp_categories", $args);
                       ?>
                       <ul class="item-menu" id="company-menu-<?php echo $term_taxonomy_id ?>">
                           <?php
                           foreach ($hiterms AS $hiterm) :
                               ?>
                               <li class="first">
                                   <?php
                                   echo '<a class="sub-link" href="' . get_term_link($hiterm->term_id, 'comp_categories') . '" id="' . $hiterm->term_id . '">' . $hiterm->name . '</a><button class="sub-btn"><i class="fa fa-arrow-from-top"></i></button>';
                                   ?>

                                   <?php $loterms = get_terms("comp_categories", array("parent" => $hiterm->term_id, 'hide_empty' => '0',));
                                   if ($loterms) :?>
                                       <!--                                                           <li class="dropdown">-->
                                       <!--                            --><?php //foreach ($hiterms as $hiterm) :
                                       ?>
                                       <!--                                --><?php //echo '<a href="' . get_term_link($hiterm->term_id, 'comp_categories') . '" id="' . get_queried_object()->term_id . '">' . $hiterm->name . '</a>';
                                       ?>
                                       <!--                                --><?php //endforeach;
                                       ?>

                                       <ul class="sub-menu">
                                           <?php foreach ($loterms as $key => $loterm) :
                                               echo '<li class="child-second"><a href="' . get_term_link($loterm->term_id, 'comp_categories') . '" id="' . $loterm->term_id . '">' . $loterm->name . '</a>' . $loterm->count . '</li>';
                                           endforeach; ?>
                                       </ul>
                                       <!--                               </li>-->
                                   <?php

                                   endif;

                                   ?>
                               </li>
                           <?php
                           endforeach;

                           ?>

                       </ul>

                   </div>
                   <!--                <ul>-->
                   <?php
//                   if (function_exists('wp_get_terms_meta')) {
//                       $metaValue = wp_get_terms_meta($term_taxonomy_id, 'company-banners', true);
//                       //where $category_id is 'category/term id' and $meta_key is 'meta key'
//                   }
//
////meta value for meta key $meta_key
//
//// Get the current category ID, e.g. if we're on a category archive page
//                   $category = get_category(get_query_var('comp_categories'));
//                   $cat_id = $category->cat_ID;
//// Get the image ID for the category
//                   $image_id = get_term_meta($term_taxonomy_id, 'series-image', true);
//// Echo the image
//                   echo wp_get_attachment_image($image_id, 'large');
                   echo '</div>';
                  // echo '<img class="banner-image" src="' . $metaValue . '" alt="" width="250px" height="120px" style="" />';
                   echo '</div>';
               }
            }
        echo '</div>';
        echo $term_taxonomy_string;    // выводим сформированную ранее строку - рубрики с изображениями
        echo '</div></div>';
        ?>
        <p style="font-size: 10px; color: white">
        Справочник товаров и услуг Чернигова. Здесь вы сможете найти все: Автомобили и запчасти к ним, СТО и шиномонтаж. Медицина - аптеки, поликлиники, больницы и стоматология. Магазины: одежда, продуктовы, магазины бытовой техники и строительных материалов, бытовой химии и хозяйственных товаров, магазины детских товаров. Бытовые услуги, гостиницы, ритуальные услуги. Бани и сауны. Агентства недвижимости. Кафе, рестораны, кофейни, закусочные, столовые. Театр, кино, концерт. Рынки и оптовые базы. СМИ, рекламные агентства и полиграфические услуги. Органы государственной власти и местного самоуправления. Производство продуктов питания, строительных материалов, мебели и машин и деталей к ним. Детские сады, школы, училища, колледжи и институты.
Только проверенная точная информация.
        </p>
    </main><!-- #main -->
</div>
    <?php   //get_sidebar('right');?>
</section><!-- #primary -->


<?php //get_sidebar();
get_footer(); ?>
