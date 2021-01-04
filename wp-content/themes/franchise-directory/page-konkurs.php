<?php
/*
 * The template for displaying all pages
 */
get_header();
$fr_obj = New FranchiseClass();
$taxonomy = 'konkurs_categories';
?>
<style type="text/css">

    .post-thumbnail{
        background-position: top;
        background-repeat: no-repeat;
        background-size: contain;
        height: 100%;
        min-height: 70px;
    }

</style>
<section id="primary" class="bizov-container">
    <?php get_sidebar('head-left');?>
    <div  class="content-area">
        <?php   //get_sidebar('left-main');

        $bkg = esc_url(get_template_directory_uri()).'/images/bg-konkurs-basic.jpg';
        $bkg_left_title = esc_url(get_template_directory_uri()).'/images/bg-konkurs-title.png';
        $bkg_left = esc_url(get_template_directory_uri()).'/images/bg-konkurs-img-photo.png';
        $bkg_mid = esc_url(get_template_directory_uri()).'/images/bg-konkurs-img-peoples.png';
        $bkg_right = esc_url(get_template_directory_uri()).'/images/bg-konkurs-img-archive.png';
        $bkg_full = esc_url(get_template_directory_uri()).'/images/bg-konkurs-full.png';
        ?>
        <div class="main-overlay-bkg" style=" background-image: url('<?php echo $bkg?>'); ">
            <div class="left-bkg" >
                <div class="left-text">
                    <figure>
                    <img class="img-responsive" src="<?php echo $bkg_left_title; ?>" width="100%" alt="">
                    </figure>
                </div>
                <div class="left-photo">
                    <figure>
                    <img class="img-responsive" src="<?php echo $bkg_left; ?>" alt="" width="100%">
                    </figure>
                </div>
            </div>
            <div class="middle-bkg" style="background-image: url('<?php echo $bkg_mid; ?>');"></div>
            <div class="right-bkg" style="background-image: none;">
                <img src="<?php echo $bkg_right; ?>" alt="">
            </div>
        </div>
        <div class="header-concurs"><span id="head-title"><?php the_title()?></span></div>
        <main id="main-concurs" class="concurs-main container">
        <div class="contests-category-list" id="">
        <?php
        the_content();
        //echo do_shortcode("[showallcontestants orderby=votes order=ASC postperpage=8]");
        $all_terms = get_terms( 'konkurs_categories', array( 'hide_empty' => 0 ) );
        foreach (  $all_terms as $term ) { # внешний цикл
            ?>
<div class="concurs-category-group">
            <?php
            $term_taxonomy_id = $term->term_taxonomy_id; // узнаем ID категории
            if (function_exists('wp_get_terms_meta')) {
                $metaValue = wp_get_terms_meta($term_taxonomy_id, 'contest-dates', true);
            }
            $date_from = get_field('date_from');
            the_field('date_to');
            $date = DateTime::createFromFormat('Ymd', $date_from);

            echo '<a class="cat-concurs-title" style="flex: 1 1 auto" href="' . get_category_link($term->term_id) . '">' . $term->name. '</a>'.$metaValue;
            echo "<ul class='contests-list'>";
            $concurs = new WP_Query( array(
                'post_type' => 'concurs',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field'    => 'slug',
                        'terms'    => $term->slug,
                    )
                )
            ));
            while ( $concurs->have_posts() ) { # внутренний цикл
                $concurs->the_post();
                ?>
                <li class="<?php post_class();?> ">
                    <a href="<?php the_permalink();?>" value="<?php the_title();?>">
                    <div class="concurs-image entry-thumbnail" style="width: 100px">
                    <?php
                    $post_medium_img = $fr_obj->get_thumbnail(get_the_ID(), 'medium');
                    $post_full_img = $fr_obj->get_thumbnail(get_the_ID(), 'full');

                    ?>

                    <img style="visibility: visible" width="" src="<?php echo esc_url($post_medium_img);?>" alt="<?php the_title();?>" title="<?php the_title();?>"  data-src="<?php echo esc_url($post_full_img);?>" class="fr_lazyload" ">
                    <?php get_permalink();?>
                    </a>
                </li>
                <?php
            } # конец внутреннего
            echo "</ul></div>";

        } # конец наружного
        ?>
       </div>
    </main><!-- #main -->
    </div>
</section><!-- #primary -->

<?php
get_footer();
