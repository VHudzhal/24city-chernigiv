<?php
$taxonomy = 'franchises-categories'; ?>

<?php get_header(); ?>

<?php

// Gets every term in this taxonomy
$terms = get_terms( $taxonomy );
//go through each term in this taxonomy one at a time
$all_franchises = new WP_Query( array(
		'post_type' => 'franchises',
//    'taxonomy' => $taxonomy,
    'posts_per_page' => -1,
    'order' => 'DESC'
) );

//LOOP
if( $all_franchises->have_posts() ): ?>
    <section class="all-franchise franchise-section content-area" id="primary">
    <?php get_sidebar('head-left');?>
    <div class="content-area" style="">
    <?php   get_sidebar('left-main');?>
    <div class="franchise-block">
        <div class="header"><span id="head-title"><?php the_title()?></span></div>

        <div class="section-header">
            <h6>Все франшизы</h6>
        </div>

        <main class="site-main franchise-main">
    <?php
    while( $all_franchises->have_posts() ) : $all_franchises->the_post();
    ?>
        <article class="franchise-article" style="">
            <a href="<?php the_permalink();?>"><img width="160px" height="120px" src="<?php echo get_field( 'image' )['url']; ?>"/></a>
            <div class="franchise-descr" >
                <a href="<?php the_permalink();?>"><?php the_field('franchise_name');?></a>
                <span>Инвестиции:  <?php the_field('price_min'); echo ' - '; the_field('price_max')?>  грн.</span>
                <?php the_field('description')?>
            </div>
            <div class="more" style="">
                <a href="<?php the_permalink();?>" class="more-link">Подробнее</a>
                <?php efav_link();?>
            </div>
        </article>
<?php
    endwhile;
?>
        </main>
    </div>
  <?php   if ( $wp_query->max_num_pages > 1 ) : ?>
        <div id="franchises_pagination" class="store-pagination page-navigation">
            <?php
            $big = 999999999; // need an unlikely integer
            echo paginate_links( array(
                'base'		=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'	=> '?paged=%#%',
                'current'	=> max( 1, get_query_var( 'paged' ) ),
                'total'		=> $wp_query->max_num_pages,
                'prev_text'	=> __( '&laquo; Пред', 'sp-theme' ),
                'next_text'	=> __( 'След.  &raquo;', 'sp-theme' ),
            ));
            ?>
        </div>
    <?php endif;
    endif;
?>
    </div>
    </section>
<?php get_footer() ?>
<?php
