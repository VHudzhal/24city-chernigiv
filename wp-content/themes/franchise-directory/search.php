<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

get_header();
$fr_obj = New FranchiseClass();
global $post;
?>

	<section id="primary" class="content-area bizov-container">
        <div class="content-area">
	                <?php get_sidebar('left-main');?>
		<main id="main" class="site-main" role="main">
        <div class="header"><span id="head-title"><?php the_title()?></span></div>
<h6 class="pagetitle">
    Результат поиска <?php 
    $allsearch = new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1);
    $count = $allsearch->post_count; _e(''); _e('<span class="search-terms">'); 
    echo $key; _e('</span>'); _e(' &mdash; '); 
    echo $count . ' '; _e('articles'); 
    wp_reset_query(); ?>
    </h6>

<div class="content-area row">
		<?php
		global $wp_query;
$total_results = $wp_query->found_posts;?>

	<?php	if ( $allsearch->have_posts() ) :
			// Start the Loop.
			while ( $allsearch->have_posts() ) :
				$allsearch->the_post();?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-4'); ?> style="">
<div class="public-content" style="">
    <div class="entry-thumbnail" style="flex: 0 0 auto">
                                    <?php
                                    if ( has_post_thumbnail() ) {?>
                                        <div class="entry-thumbnail" style="flex: 0 0 auto; padding: 6px;">
                                            <?php $post_medium_img = $fr_obj->get_thumbnail(get_the_ID(), 'small');
                                            $post_full_img = $fr_obj->get_thumbnail(get_the_ID(), 'full');?>
                                            <img style="visibility: visible" width="150px" height="150" src="<?php echo esc_url($post_medium_img);?>"  data-src="<?php echo esc_url($post_full_img);?>" class="fr_lazyload" alt="<?php the_title_attribute();?>">
                                        </div>
                                        <?php
                                    }else{?>
                                        <img class="" width="150px" height="150" src="<?php echo get_stylesheet_directory_uri();?>/images/none-image.png" alt="" style="">
                                    <?php	} ?>
                                </div>
</div>
            <span class="search-post-excerpt"><?php the_excerpt(); ?></span>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
<div id="company-address" class="company-part">
                                               <?php $address = get_field( 'address' ); ?>

                        <?php if ( $address ) : ?>
                             <a style="color: black;" target="_blank" href="<?php echo esc_url( $address['url'] ); ?>" target="<?php echo esc_attr( $address['target'] ); ?>"><?php echo esc_html( $address['title'] ); ?></a>
                        <?php endif; ?>
                            </div>
</article>

		<?php
		wp_reset_postdata();
		endwhile; // End the loop.
		else :
			?>

			<p><?php _e( 'Извините, но записей по вашему запросу не найдено.', 'sp-theme' ); ?></p>
			<?php
				//get_search_form();

		endif;
		?>
</div>
		</main><!-- #main -->
        </div>
	</section><!-- #primary -->

<?php
get_footer();
