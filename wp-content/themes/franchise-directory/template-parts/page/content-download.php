<?php
/**
 * @package bootstrapwp
 */
?>



<div class="col-md-4">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


        <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
            </a>
        <?php endif; ?>

        <header class="theme-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .theme-header -->

        <?php if(function_exists('edd_price')) { ?>
            <div class="product-price">
                <?php
                if(edd_has_variable_prices(get_the_ID())) {
                    // if the download has variable prices, show the first one as a starting price
                    echo 'Starting at: '; edd_price(get_the_ID());
                } else {
                    edd_price(get_the_ID());
                }
                ?>
            </div><!--end .product-price-->
        <?php } ?>



    </article><!-- #post-## -->
</div>
