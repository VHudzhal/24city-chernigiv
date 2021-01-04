<?php
/*
 * The sidebar containing the main widget area
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) :
    return;?>
<?php endif;?>
<?php
if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<aside id="bottom-head" class="sidebar  widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
<!--        <div class="s-header__basket-wr woocommerce">-->
<!--            --><?php
//            global $woocommerce; ?>
<!--            <a href="--><?php //echo $woocommerce->cart->get_cart_url() ?><!--" class="basket-btn basket-btn_fixed-xs">-->
<!--                <span class="basket-btn__label">Корзина</span>-->
<!--                <span class="basket-btn__counter">(--><?php //echo sprintf($woocommerce->cart->cart_contents_count); ?><!--)</span>-->
<!--            </a>-->
<!--        </div>-->
<!--        <nav id="navigate" role="navigation">-->
<!--            --><?php //wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
<!--            <li class="menu-item cart-punkt" >--><?php //cart_link(); ?><!----><?php //the_widget( 'WC_Widget_Cart', 'title=' ); ?><!--</li>-->
<!--        </nav>-->
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>

