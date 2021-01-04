<?php
/*
 * sp functions and definitions
 */

if ( ! function_exists( 'sp_setup' ) ) :

	function sp_setup() {

		load_theme_textdomain( 'sp-theme', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );


		add_theme_support( 'custom-background', apply_filters( 'sp_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		add_theme_support( 'custom-avatar', array(
			'height'      => 50,
			'width'       => 50,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_image_size('avatar',20, 20);
add_image_size('contest-result',100, 100);
add_action( 'after_setup_theme', 'sp_setup' );

//add_filter('widget_text', 'do_shortcode');
//add_filter('the_content', 'do_shortcode');
//add_filter('the_posts', 'do_shortcode');

function sp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sp_content_width', 640 );
}
add_action( 'after_setup_theme', 'sp_content_width', 0 );

//Register widget area.
function franchise_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'sp-theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'sp-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '',
		'after_title'   => '',
	));
	register_sidebar( array(
		'name'          => esc_html__( 'Head right', 'sp-theme' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'sp-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '',
		'after_title'   => '',
	));
    register_sidebar( array(
        'name'          => esc_html__( 'Right sidebar In Franchise', 'sp-theme' ),
        'id'            => 'sidebar-3',
        'description'   => esc_html__( 'Add widgets here.', 'sp-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    register_sidebar( array(
        'name'          => esc_html__( 'Left sidebar In Franchise', 'sp-theme' ),
        'id'            => 'sidebar-4',
        'description'   => esc_html__( 'Add widgets here.', 'sp-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    register_sidebar( array(
        'name'          => esc_html__( 'Top search sidebar ', 'sp-theme' ),
        'id'            => 'sidebar-5',
        'description'   => esc_html__( 'Add widgets here.', 'sp-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    register_sidebar( array(
        'name'          => esc_html__( 'Site map ', 'sp-theme' ),
        'id'            => 'sidebar-6',
        'description'   => esc_html__( 'Add widgets here.', 'sp-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    register_sidebar( array(
        'name'          => esc_html__( 'Community themes ', 'sp-theme' ),
        'id'            => 'sidebar-7',
        'description'   => esc_html__( 'Add widgets here.', 'sp-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    register_sidebar( array(
        'name'          => esc_html__( 'Left Main ', 'sp-theme' ),
        'id'            => 'sidebar-8',
        'description'   => esc_html__( 'Add widgets here.', 'sp-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '',
        'after_title'   => '',
    ));
    register_sidebar( array(
        'name'          => esc_html__( 'Share buttons', 'sp-theme' ),
        'id'            => 'sidebar-9',
        'description'   => esc_html__( 'Add widgets here.', 'sp-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '',
        'after_title'   => '',
    ));
    register_sidebar( array(
        'name'          => esc_html__( 'Head left', 'sp-theme' ),
        'id'            => 'sidebar-10',
        'description'   => esc_html__( 'Add widgets here.', 'sp-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '',
        'after_title'   => '',
    ));
    register_sidebar( array(
        'name'          => esc_html__( 'Head top Right', 'sp-theme' ),
        'id'            => 'sidebar-11',
        'description'   => esc_html__( 'Add widgets here.', 'sp-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '',
        'after_title'   => '',
    ));
    register_sidebar( array(
        'name'          => esc_html__( 'Right Company Sidebar', 'sp-theme' ),
        'id'            => 'sidebar-12',
        'description'   => esc_html__( 'Add widgets here.', 'sp-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '',
        'after_title'   => '',
    ));
    register_sidebar( array(
        'name'          => esc_html__( 'Top Banners Group', 'sp-theme' ),
        'id'            => 'sidebar-13',
        'description'   => esc_html__( 'Add widgets here.', 'sp-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '',
        'after_title'   => '',
    ));
    register_sidebar( array(
        'name'          => esc_html__( 'Company categories', 'sp-theme' ),
        'id'            => 'sidebar-14',
        'description'   => esc_html__( 'Add widgets here.', 'sp-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '',
        'after_title'   => '',
    ));
    register_sidebar( array(
        'name'          => esc_html__( 'Shares comments group', 'sp-theme' ),
        'id'            => 'sidebar-15',
        'description'   => esc_html__( 'Add widgets here.', 'sp-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '',
        'after_title'   => '',
    ));
    register_sidebar( array(
        'name'          => esc_html__( 'Concurs banners group', 'sp-theme' ),
        'id'            => 'sidebar-16',
        'description'   => esc_html__( 'Add widgets here.', 'sp-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '',
        'after_title'   => '',
    ));
}
add_action( 'widgets_init', 'franchise_widgets_init' );
// Register Navigation Menus
function franchises_navigation_menus() {

	$locations = array(
        'main-menu' => esc_html__( 'Main', 'sp-theme' ),
        'header-menu' => esc_html__( 'Header menu', 'sp-theme' ),
        'main-menu-mob' => esc_html__( 'Main Mob', 'sp-theme' ),
        'menu-1' => esc_html__( 'Categories', 'sp-theme' ),
        'catalog' => esc_html__( 'Catalog', 'sp-theme' ),
        'head' => esc_html__( 'Head', 'sp-theme' ),
        'foot-left' => esc_html__( 'Foot Left', 'sp-theme' ),
        'foot-right' => esc_html__( 'Foot Right', 'sp-theme' ),
        'foot-soc' => esc_html__( 'Foot Social', 'sp-theme' ),
		'left-menu' => esc_html__( 'Left Menu', 'sp-theme' ),
		'qa-social' => esc_html__( 'Question social', 'sp-theme' ),
		'categories-list' => esc_html__( 'Company Menu', 'sp-theme' ),
	);
	register_nav_menus( $locations );

}
add_action( 'init', 'franchises_navigation_menus' );

add_filter('single_template', 'my_single_template');

function my_single_template($single) {
    global $wp_query, $post;
    foreach((array)get_the_category() as $cat) {
        if(file_exists(get_template_directory() . '/single-' . $cat->slug . '.php')) {
            return get_template_directory() . '/single-' . $cat->slug . '.php';
        } elseif(file_exists('/single-' . $cat->term_id . '.php')) {
            return get_template_directory() . '/single-' . $cat->term_id . '.php';
        }
    }
    return $single;
}

function sp_scripts() {
    wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', '','4.3.1');
    wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap-grid.css', '', '4.3.1');
    wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap-reboot.css', '', '4.3.1', '');
    wp_enqueue_style('fontawesome', get_template_directory_uri().'/css/all.css');
    wp_enqueue_style('fontawesome', get_template_directory_uri().'/css/brands.css');
    wp_enqueue_style('fontawesome', get_template_directory_uri().'/css/doutone.css');
    wp_enqueue_style('fontawesome', get_template_directory_uri().'/css/fontawesome.css');
    wp_enqueue_style('fontawesome', get_template_directory_uri().'/css/light.css');
    wp_enqueue_style('fontawesome', get_template_directory_uri().'/css/regular.css');
    wp_enqueue_style('fontawesome', get_template_directory_uri().'/css/solid.css');
    wp_enqueue_style('slider-pro', get_template_directory_uri().'/css/slider-pro.css');
    wp_enqueue_style('swiper-pro', get_template_directory_uri().'/css/swiper.css');
    wp_enqueue_style('vertical-carousel', get_template_directory_uri().'/css/carousel-vertical.min.css');
//    wp_enqueue_style('carousel', get_template_directory_uri().'/css/carousel.css');
//    wp_enqueue_style('tiny', get_template_directory_uri().'/css/tiny-slider.css');
    wp_enqueue_style('style', get_stylesheet_uri() );
    wp_enqueue_style('ui-toggle', get_template_directory_uri().'/css/ui-toggle.css', '', '5.2.4');

    wp_enqueue_script('jquery');
    wp_enqueue_script('slider-pro', get_template_directory_uri().'/js/jquery.sliderPro.min.js', array('jquery'), '5.2.4', true);
    wp_enqueue_script('wow', get_template_directory_uri().'/js/wow.min.js', array('jquery'), '0.1.9', true);
//    wp_enqueue_script('tiny', get_template_directory_uri().'/js/tiny-slider.js', array('jquery'), '', true);
  //  wp_enqueue_script('tiny-helper', get_template_directory_uri().'/js/tiny-slider.helper.ie8.js', array('jquery'), '', true);
    wp_enqueue_script('swiper', get_template_directory_uri().'/js/swiper.js', array('jquery'), '5.2.4', true);
    wp_enqueue_script('toggler', get_template_directory_uri().'/js/jquery.toggler.js', array('jquery'), '5.2.4', true);
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', '', '4.3.1', true);
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.bundle.js', '', '4.3.1', true);
    wp_enqueue_script('collapsor', get_template_directory_uri().'/js/jquery.collapsorz_1.1.min.js', array('jquery'), '1.1', true);;
    wp_enqueue_script('collapsor', get_template_directory_uri().'/js/jquery.collapser.min.js', array('jquery'), '3.0', true);;
    wp_enqueue_script('pagination', get_template_directory_uri().'/js/jquery.pajinate.min.js', array('jquery'), '1.0', true);;
    wp_enqueue_script('script', get_template_directory_uri().'/js/script.js', array('jquery'), '1.0', true);
    wp_enqueue_script('vertical-carousel', get_template_directory_uri().'/js/jquery.carousel-vertical.min.js', array('jquery'), '1.0', true);
	wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css' );
	wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js', array('jquery') );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'sp_scripts' );

function wpb_change_search_url() {
	if ( is_search() && ! empty( $_GET['s'] ) ) {
		wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
		exit();
	}
}
add_action( 'template_redirect', 'wpb_change_search_url' );
add_filter( 'deprecated_function_trigger_error', '__return_false' );

add_action('init', 'redirect_http_to_https');
function redirect_http_to_https(){
    if( is_ssl() ) return;

    if ( 0 === strpos($_SERVER['REQUEST_URI'], 'http') )
        wp_redirect( set_url_scheme( $_SERVER['REQUEST_URI'], 'https' ), 301 );
    else
        wp_redirect( 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 301 );
    exit;
}
//Include the TGM_Plugin_Activation class.
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

//Implement the Custom Header feature.
require get_template_directory() . '/inc/custom-header.php';

//Functions which enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/franchise-class.php';

//Functions which enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

//Customizer additions.
require get_template_directory() . '/inc/customizer.php';

if ( ! function_exists( 'franchises_the_posts_navigation' ) ) :
    /**
     * Documentation for function.
     */
    function franchises_the_posts_navigation() {
        the_posts_pagination(
            array(
                'mid_size'  => 2,
                'prev_text' => sprintf(
                    '%s <span class="nav-prev-text">%s</span>',
                    '<<',
                    __( 'Пред.', 'sp-theme' )
                ),
                'next_text' => sprintf(
                    '<span class="nav-next-text">%s</span> %s',
                    __( 'След.', 'sp-theme' ),
                    '>>'
                ),
            )
        );
    }
endif;
function check_cat_children() {
    global $wpdb;
    $term = get_queried_object();
    $check = $wpdb->get_results(" SELECT * FROM wp_term_taxonomy WHERE parent = '$term->term_id' ");
    if ($check) {
        return true;
    } else {
        return false;
    }
}
function ro_resources_custom_post_type() {
    $labels = array(
        'name'                => __( 'Компании' ),
        'singular_name'       => __( 'Компания'),
        'menu_name'           => __( 'Компания'),
        'parent_item_colon'   => __( 'Parent Resource'),
        'all_items'           => __( 'Все компании'),
        'view_item'           => __( 'Просмотреть компанию'),
        'add_new_item'        => __( 'Добавить новую компанию'),
        'add_new'             => __( 'Добавить новое'),
        'edit_item'           => __( 'Редактировать компанию'),
        'update_item'         => __( 'Обновить компнаию'),
        'search_items'        => __( 'Поиск компании'),
        'not_found'           => __( 'Компанию не найдено'),
        'not_found_in_trash'  => __( 'Not found in Trash')
    );
    $args = array(
        'label'               => __( 'company'),
        'description'         => __( 'Справочник компаний'),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'tags', 'author','comments', 'thumbnail', 'revisions', 'custom-fields'),
        'public'              => true,
        'hierarchical'        => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'has_archive'         => false,
        'can_export'          => true,
        'exclude_from_search' => false,
        'yarpp_support'       => true,
        'publicly_queryable'  => true,
        'capability_type'     => 'page'
    );
    register_post_type( 'company', $args );
}
add_action( 'init', 'ro_resources_custom_post_type', 0 );

add_action( 'init', 'ro_create_resources_custom_taxonomy', 0 );

//create a custom taxonomy name it "type" for your posts
function ro_create_resources_custom_taxonomy() {

    $labels = array(
        'name' => _x( 'Категории компаний', 'taxonomy general name' ),
        'singular_name' => _x( 'Категории компаний', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Types' ),
        'all_items' => __( 'All Types' ),
        'parent_item' => __( 'Parent Type' ),
        'parent_item_colon' => __( 'Parent Type:' ),
        'edit_item' => __( 'Edit Type' ),
        'update_item' => __( 'Update Type' ),
        'add_new_item' => __( 'Add New Type' ),
        'new_item_name' => __( 'New Type Name' ),
        'menu_name' => __( 'Категории' ),
    );

    register_taxonomy('comp_categories',array('company','shares'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
//        'rewrite' => array( 'slug' => 'comp_categories' ),
    ));
}
/*************************************/
function contests_custom_post_type() {
    $labels = array(
        'name'                => __( 'Конкурс' ),
        'singular_name'       => __( 'Конкурс'),
        'menu_name'           => __( 'Конкурс'),
        'parent_item_colon'   => __( 'Parent Resource'),
        'all_items'           => __( 'Все конкурсы'),
        'view_item'           => __( 'Просмотреть конкурс'),
        'add_new_item'        => __( 'Добавить новый когкуср'),
        'add_new'             => __( 'Добавить новое'),
        'edit_item'           => __( 'Редактировать конкурс'),
        'update_item'         => __( 'Обновить компнаию'),
        'search_items'        => __( 'Поиск компании'),
        'not_found'           => __( 'Компанию не найдено'),
        'not_found_in_trash'  => __( 'Not found in Trash')
    );
    $args = array(
        'label'               => __( 'concurs'),
        'description'         => __( 'Best Resources'),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author','comments', 'thumbnail', 'revisions', 'custom-fields'),
        'public'              => true,
        'hierarchical'        => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'has_archive'         => false,
        'can_export'          => true,
        'exclude_from_search' => false,
        'yarpp_support'       => true,
        'publicly_queryable'  => true,
        'capability_type'     => 'page'
    );
    register_post_type( 'concurs', $args );
}
add_action( 'init', 'contests_custom_post_type', 0 );

add_action( 'init', 'contests_custom_taxonomy', 0 );

//create a custom taxonomy name it "type" for your posts
function contests_custom_taxonomy() {

    $labels = array(
        'name' => _x( 'Категории конкурсов', 'taxonomy general name' ),
        'singular_name' => _x( 'Категории конкурсов', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Types' ),
        'all_items' => __( 'All Types' ),
        'parent_item' => __( 'Parent Type' ),
        'parent_item_colon' => __( 'Parent Type:' ),
        'edit_item' => __( 'Edit Type' ),
        'update_item' => __( 'Update Type' ),
        'add_new_item' => __( 'Add New Type' ),
        'new_item_name' => __( 'New Type Name' ),
        'menu_name' => __( 'Категории конкурсов' ),
    );

    register_taxonomy('konkurs_categories',array('concurs'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'konkurs_categories' ),
    ));
}
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}
/**********************************/
$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'my_modify_posts_per_page', 0);
function my_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
}
function my_option_posts_per_page( $value ) {
    global $option_posts_per_page;
    if ( is_tax( 'franchises-categories') ) {
        return 2;
    } else {
        return $option_posts_per_page;
    }
}

function tax_city_posts_per_page( $query ) {
    if( is_tax('franchises-categories') ) {
        $query->set('posts_per_page', 5); //ваше значение
    }
    return $query;
}
add_filter('show_admin_bar', '__return_true');

add_theme_support( 'woocommerce' );
define('WOOCOMMERCE_USE_CSS', false);
function woocommerce_header_add_to_cart_fragment( $fragments ) {
    ob_start();
    ?>
    <a class="cart-contents" href="/cart/" title="<?php _e( 'Перейти в корзину' ); ?>">
        <span class="cart-ico"> <i class="fa fa-shopping-cart"></i></span>
        <span class="cart-txt"><strong><?php echo WC()->cart->get_cart_total(); ?></strong>
             <?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?> &nbsp;&nbsp; товаров
	</span>
    </a>
    <?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}

//Вывод кратких данных из корзины
if ( ! function_exists( 'cart_link' ) ) {
    function cart_link() {
        ?><a class="cart-contents" href="/cart/" title="<?php _e( 'Перейти в корзину' ); ?>">
        <span class="cart-ico"> <i class="fa fa-shopping-cart"></i></span>&nbsp;&nbsp;
        <span class="cart-txt">
            <strong><?php echo WC()->cart->get_cart_total(); ?></strong><br>
            <strong id="count-prod"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?></strong>&nbsp;товаров

        </span>
        </a>
        <?php
    }
}
add_shortcode('my_head_cart','add_to_cart_shortcode');
function add_to_cart_shortcode(){
    $cart = '';
    $cart += "<nav id='navigate' role='navigation'>";
//    $cart += wp_nav_menu( array(
//                    'theme_location' => 'header-menu',
//                    'menu_class'  => 'nav-cart',
//                    'depth' => 0
//                )
//                );
    $cart += '<li class="menu-item cart-punkt" >'.cart_link();
    $cart += the_widget( 'WC_Widget_Cart', 'title=' ).'</li></nav>';
    return $cart;
}
//add_filter('woocommerce_product_get_rating_html', 'your_get_rating_html', 10, 2);
//function your_get_rating_html($rating_html, $rating) {
  //  if ( $rating > 0 ) {
    //    $title = sprintf( __( 'Rated %s out of 5', 'woocommerce' ), $rating );
    //} else {
     //   $title = 'Not yet rated';
       // $rating = 0;
    //}
   // $rating_html  = '<div class="star-rating" title="' . $title . '">';
    //$rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . __( 'out of 5', 'woocommerce' ) . '</span>';
    //$rating_html .= '</div>';
    //$rating_html .= '</div>';
//    $rating_html .= '<div class="bottom-block">';
   // return $rating_html;
//}
// Новый пост с фронтенда
function my_pre_save_post( $post_id ) {

    // Проверить что пост новый
    if( $post_id != 'new' ) {
        return $post_id;
    }

    // Создание нового поста
    $post = array(
        'post_type'     => 'company', // Your post type ( post, page, custom post type )
        'post_status'   => 'private', // (publish, draft, private, etc.)
        'post_title'    => wp_strip_all_tags($_POST['acf']['field_5e77b59aa1e30']), // Заголовок ACF field key
        'post_content'  => $_POST['acf']['field_5509d61f8541f'], // Содержание ACF field key
    );

    // insert the post
    $post_id = wp_insert_post( $post );

    // update $_POST['return']
    $_POST['return'] = add_query_arg( array('post_id' => $post_id), $_POST['return'] );

    return $post_id;

}
add_filter('acf/pre_save_post' , 'my_pre_save_post', 10, 1 );


/**
 * Сохранение изображения ACF field как миниатюры
 */
add_action( 'acf/save_post', 'tsm_save_image_field_to_featured_image', 10 );
function tsm_save_image_field_to_featured_image( $post_id ) {

    // Bail early if no ACF data
    if( empty($_POST['acf']) ) {
        return;
    }

    // Миниатюра ACF field key
    $image = $_POST['acf']['field_5e78ab08a39f3'];

    // Bail if image field is empty
    if ( empty($image) ) {
        return;
    }

    // Add the value which is the image ID to the _thumbnail_id meta data for the current post
    add_post_meta( $post_id, '_thumbnail_id', $image );

}

function webriti_remove_admin_bar_links() {
    global $wp_admin_bar;
if(!is_admin() || !is_user_logged_in()){
//Remove WordPress Logo Menu Items
    $wp_admin_bar->remove_menu('wp-logo'); // Removes WP Logo and submenus completely, to remove individual items, use the below mentioned codes
    $wp_admin_bar->remove_menu('about'); // 'About WordPress'
    $wp_admin_bar->remove_menu('wporg'); // 'WordPress.org'
    $wp_admin_bar->remove_menu('documentation'); // 'Documentation'
    $wp_admin_bar->remove_menu('support-forums'); // 'Support Forums'
    $wp_admin_bar->remove_menu('feedback'); // 'Feedback'
    $wp_admin_bar->remove_menu('bar-happy-addons');
    $wp_admin_bar->remove_menu('elementor_inspector');
    $wp_admin_bar->remove_menu('spcti_id');



//Remove Site Name Items
//    $wp_admin_bar->remove_menu('site-name'); // Removes Site Name and submenus completely, To remove individual items, use the below mentioned codes
  //  $wp_admin_bar->remove_menu('view-site'); // 'Visit Site'
//    $wp_admin_bar->remove_menu('dashboard'); // 'Dashboard'
 //   $wp_admin_bar->remove_menu('themes'); // 'Themes'
  //  $wp_admin_bar->remove_menu('widgets'); // 'Widgets'
//    $wp_admin_bar->remove_menu('menus'); // 'Menus'
 //   $wp_admin_bar->remove_menu('ubermenu'); // 'Menus'


// Remove 'Howdy, username' Menu Items
    //$wp_admin_bar->remove_menu('my-account'); // Removes 'Howdy, username' and Menu Items
//    $wp_admin_bar->remove_menu('user-actions'); // Removes Submenu Items Only
  //  $wp_admin_bar->remove_menu('user-info'); // 'username'
//    $wp_admin_bar->remove_menu('edit-profile'); // 'Edit My Profile'
//    $wp_admin_bar->remove_menu('logout'); // 'Log Out'
}
}
//add_action( 'wp_before_admin_bar_render', 'webriti_remove_admin_bar_links' );
    
function search_shortcode(){
    echo get_search_form();
}
add_shortcode('front_search', 'search_shortcode');
function sort_terms_by_children_count ( $terms ) {
    $sort_terms_by_children_count = array();
    $i=0;
    foreach($terms as $term) {      
        if($term->parent == '0'){
            $term_id = $term->term_id; 
            $taxonomy_name = $term->taxonomy; 
            $countchildren = count (get_term_children( $term_id, $taxonomy_name )); 
            $sort_terms_by_children_count[$i] = $countchildren;         
            $i +=1;
        }                   
    }       
    return $sort_terms_by_children_count;
}
//function template_chooser($template)
//{
//    global $wp_query;
//    $post_type = get_query_var('post_type');
//    if( $wp_query->is_search && $post_type == 'company' )
//    {
//        return locate_template('archive-сompany.php');
//    }
//    return $template;
//}
//add_filter('template_include', 'template_chooser');
function mayak_segment_more($length) {
    return 20;
}
add_filter('excerpt_length', 'mayak_segment_more');

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

// Second, add View Product Button

add_action( 'woocommerce_after_shop_loop_item', 'shop_view_product_button', 10);
function shop_view_product_button() {
    global $product;
    $link = $product->get_permalink();
    echo '<a href="'.'" class="button addtocartbutton">View Product</a>';
}
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'custom_woocommerce_template_loop_product_title', 10 );
function custom_woocommerce_template_loop_product_title() {
    echo '<h6 class="myclass">' . get_the_title() . '</h6>';
}
add_filter( 'woocommerce_checkout_fields', 'misha_remove_fields', 9999 );

function misha_remove_fields( $woo_checkout_fields_array ) {

    // she wanted me to leave these fields in checkout
    // unset( $woo_checkout_fields_array['billing']['billing_first_name'] );
    // unset( $woo_checkout_fields_array['billing']['billing_last_name'] );
    // unset( $woo_checkout_fields_array['billing']['billing_phone'] );
    // unset( $woo_checkout_fields_array['billing']['billing_email'] );
    // unset( $woo_checkout_fields_array['order']['order_comments'] ); // remove order notes

    // and to remove the billing fields below
    unset( $woo_checkout_fields_array['billing']['billing_company'] ); // remove company field
    unset( $woo_checkout_fields_array['billing']['billing_country'] );
    unset( $woo_checkout_fields_array['billing']['billing_address_1'] );
    unset( $woo_checkout_fields_array['billing']['billing_address_2'] );
    unset( $woo_checkout_fields_array['billing']['billing_city'] );
    unset( $woo_checkout_fields_array['billing']['billing_state'] ); // remove state field
    unset( $woo_checkout_fields_array['billing']['billing_postcode'] ); // remove zip code field

    return $woo_checkout_fields_array;
}
add_filter('wp_title','search_form_title');

function search_form_title($title){
 
 global $searchandfilter;
 
 if ( $searchandfilter->active_sfid() == 12785)
 {
 return 'Search Results';
 }
 else
 {
 return $title;
 }
 
}
function php_execute($html){
if(strpos($html,"<"."?php")!==false){
ob_start();
eval("?".">".$html);
$html=ob_get_contents();
ob_end_clean();
}
return $html;
}
add_filter('widget_text','php_execute',100);


add_action('add_meta_boxes', function(){
	add_meta_box( 'company_shares', 'Компания акции', 'company_shares_metabox', 'shares', 'side', 'low'  );
}, 1);

function company_shares_metabox( $post ){
	$players = get_posts(array( 'post_type'=>'company', 'post_parent'=>$post->ID, 'posts_per_page'=>-1, 'orderby'=>'post_title', 'order'=>'ASC' ));

	if( $players ){
		foreach( $players as $player ){
			echo $player->post_title .'<br>';
			echo '<a href="">'.$player->get_the_permalink.'</a>';
		}
	}
	else
		echo 'Акций нет...';
}
add_action('add_meta_boxes', function () {
	add_meta_box( 'palyer_team', 'Акция компании', 'player_team_metabox', 'company', 'side', 'low'  );
}, 1);

// метабокс с селектом команд
function player_team_metabox( $post ){
	$teams = get_posts(array( 'post_type'=>'shares', 'posts_per_page'=>-1, 'orderby'=>'post_title', 'order'=>'ASC' ));

	if( $teams ){
		// чтобы портянка пряталась под скролл...
		echo '
		<div style="max-height:200px; overflow-y:auto;">
			<ul>
		';

		foreach( $teams as $team ){
			echo '
			<li><label>
				<input type="checkbox" name="post_parent" value="'. $team->ID .'" '. checked($team->ID, $post->post_parent, 0) .'> '. esc_html($team->post_title) .'
			</label></li>
			';
		}

		echo '
			</ul>
		</div>';
	}
	else
		echo 'Команд нет...';
}
//function template_chooser($template)
//{
 // global $wp_query;
  //$post_type = get_post_type();
  //if( $wp_query->is_search)
 // {
  //  return locate_template('archive-'.$post_type.'.php');
  //}
  //return $template;
//}
//add_filter('template_include', 'template_chooser');
 function htm_image_content_filter($content){
     $content = preg_replace("/<img[^>]+\>/i", "", $content);
     return $content; 
 }
 function the_empty_content( $text ){
     // $text это текст поста с которым можно сделать что требуется 
     // в том числе проверить на длину строки 
     if (empty($text)) { 
         the_tags('');
         }
         return $text; 
 } 
     add_filter('the_content', 'the_empty_content');
function custom_css_admin() {

echo PHP_EOL . '<style type="text/css">

/* Выводим своё меню в мобильной версии сайта */
@media screen and (max-width: 782px){

/* Стили отступов и размера шрифта */
#wpadminbar, #wpadminbar * {
    font-size: 13px !important;
}
#wp-admin-bar-ipstenu-account {
    margin: 0px 0px 0px 5px !important;
    }
#wp-admin-bar-mylinks1, #wp-admin-bar-mylinks2, #wp-admin-bar-mylinks3 {
    margin: 0px 0px 0px 10px !important;
}
.ab-item {
    padding: 0px 5px !important;
}
   
/* Разрешаем вывод ОБЫЧНЫХ и СВОИХ ссылок */  
#wp-toolbar>ul>li, #wpadminbar #wp-admin-bar-user-actions.ab-submenu img.avatar {
    display: block !important;
}
/* Скрыть иконку НАСТРОЙКИ САЙТА */
#wp-admin-bar-customize .ab-item {
    display: none !important;
}  
/* Скрыть иконку ОБНОВЛЕНИЯ */
#wp-admin-bar-updates .ab-item {
    display: none !important;
}
/* Скрыть иконку КОММЕНТАРИИ */
#wp-admin-bar-comments .ab-item {
    display: none !important;
}
/* Скрыть иконку ВЫЙТИ */
#wp-admin-bar-my-account .ab-item {
    display: none !important;
}  
}

/* Скрыть иконку СТРАНИЦЫ (своя ссылка) при маленьком разрешении */
@media screen and (max-width: 500px){
#wp-admin-bar-mylinks3 .ab-item {
    display: none !important;
    }
}

</style>' . PHP_EOL;

}
add_action('admin_head', 'custom_css_admin');

function taxonomy_add_new_meta_field() {
	// это добавит мета-поле на страницу добавления категории
	?>
	<div class="form-field">
		<label for="term_meta[custom_term_meta]"><?php _e( 'Демо-поле', 'htmler' ); ?></label>
		<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="">
		<p class="description"><?php _e( 'Enter a value for this field','pippin' ); ?></p>
	</div>
<?php
}
add_action( 'comp_categories_add_form_fields', 'taxonomy_add_new_meta_field', 10, 2 );
function taxonomy_edit_meta_field($term) {
 
 
	// Получаем список текущих значений (возвращает массив)
	$term_meta = get_option( "taxonomy_{$term->term_id}" ); ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php _e( 'Демо-поле', 'htmler' ); ?></label></th>
		<td>
			<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="<?php echo esc_attr( $term_meta['custom_term_meta'] ) ? esc_attr( $term_meta['custom_term_meta'] ) : ''; ?>">
			<p class="description"><?php _e( 'Укажите тут значение','htmler' ); ?></p>
		</td>
	</tr>
<?php
}
add_action( 'comp_categories_edit_form_fields', 'taxonomy_edit_meta_field', 10, 2 );
function save_taxonomy_custom_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$term_meta = get_option( "taxonomy_$term_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		// Save the option array.
		update_option( "taxonomy_$term_id", $term_meta );
	}
}  
add_action( 'edited_comp_categories', 'save_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_comp_categories', 'save_taxonomy_custom_meta', 10, 2 );
/************************************************/

add_action( 'admin_menu', 'rudr_metabox_for_select2' );
add_action( 'save_post', 'rudr_save_metaboxdata', 10, 2 );
 
/*
 * Add a metabox
 * I hope you're familiar with add_meta_box() function, so, nothing new for you here
 */
function rudr_metabox_for_select2() {
	add_meta_box( 'rudr_select2', 'My metabox for select2 testing', 'rudr_display_select2_metabox', 'company', 'normal', 'high' );
}
 
/*
 * Display the fields inside it
 */
function rudr_display_select2_metabox( $post_object ) {
 
	// do not forget about WP Nonces for security purposes
 
	// I decided to write all the metabox html into a variable and then echo it at the end
	$html = '';
 
	// always array because we have added [] to our <select> name attribute
	$appended_tags = get_post_meta( $post_object->ID, 'rudr_select2_tags',true );
	$appended_posts = get_post_meta( $post_object->ID, 'rudr_select2_posts',true );
 
	/*
	 * It will be just a multiple select for tags without AJAX search
	 * If no tags found - do not display anything
	 * hide_empty=0 means to show tags not attached to any posts
	 */
	if( $tags = get_terms( 'post_tag', 'hide_empty=0' ) ) {
		$html .= '<p><label for="rudr_select2_tags">Tags:</label><br /><select id="rudr_select2_tags" name="rudr_select2_tags[]" multiple="multiple" style="width:99%;max-width:25em;">';
		foreach( $tags as $tag ) {
			$selected = ( is_array( $appended_tags ) && in_array( $tag->term_id, $appended_tags ) ) ? ' selected="selected"' : '';
			$html .= '<option value="' . $tag->term_id . '"' . $selected . '>' . $tag->name . '</option>';
		}
		$html .= '<select></p>';
	}
 
	/*
	 * Select Posts with AJAX search
	 */
	$html .= '<p><label for="rudr_select2_posts">Компании:</label><br /><select id="rudr_select2_posts" name="rudr_select2_posts[]" multiple="multiple" style="width:99%;max-width:25em;">';
 
	if( $appended_posts ) {
		foreach( $appended_posts as $post_id ) {
			$title = get_the_title( $post_id );
			// if the post title is too long, truncate it and add "..." at the end
			$title = ( mb_strlen( $title ) > 50 ) ? mb_substr( $title, 0, 49 ) . '...' : $title;
			$html .=  '<option value="' . $post_id . '" selected="selected">' . $title . '</option>';
		}
	}
	$html .= '</select></p>';
 
	echo $html;
}
 
 
function rudr_save_metaboxdata( $post_id, $post ) {
 
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
 
	// if post type is different from our selected one, do nothing
	if ( $post->post_type == 'company' ) {
		if( isset( $_POST['rudr_select2_tags'] ) )
			update_post_meta( $post_id, 'rudr_select2_tags', $_POST['rudr_select2_tags'] );
		else
			delete_post_meta( $post_id, 'rudr_select2_tags' );
 
		if( isset( $_POST['rudr_select2_posts'] ) )
			update_post_meta( $post_id, 'rudr_select2_posts', $_POST['rudr_select2_posts'] );
		else
			delete_post_meta( $post_id, 'rudr_select2_posts' );
	}
	return $post_id;
}
add_action( 'wp_ajax_mishagetposts', 'rudr_get_posts_ajax_callback' ); // wp_ajax_{action}
function rudr_get_posts_ajax_callback(){
 
	// we will pass post IDs and titles to this array
	$return = array();
 $term_slug = get_query_var('term');
$queried_object = get_queried_object();
$term_id = get_queried_object()->term_id;
$term = get_term( $term_id, $taxonomy );
$slug = $term->slug;
	// you can use WP_Query, query_posts() or get_posts() here - it doesn't matter
	$search_results = new WP_Query( array(
		's'=> $_GET['q'], // the search query
		'post_type' => 'company',
		'taxonomy' => 'comp_categories',
		'tax_query' => array(
        array(
            'taxonomy' => 'comp_categories',
            'field' => 'slug',
            'terms' => $slug,
            'include_children' => false
        )
    ),
		'post_status' => 'publish', // if you don't want drafts to be returned
		'ignore_sticky_posts' => 1,
		'posts_per_page' => 50 // how much to show at once
	) );
	if( $search_results->have_posts() ) :
		while( $search_results->have_posts() ) : $search_results->the_post();	
			// shorten the title a little
			$title = ( mb_strlen( $search_results->post->post_title ) > 50 ) ? mb_substr( $search_results->post->post_title, 0, 49 ) . '...' : $search_results->post->post_title;
			$return[] = array( $search_results->post->ID, $title ); // array( Post ID, Post Title )
		endwhile;
	endif;
	echo json_encode( $return );
	die;
}


////////////////////////////////////////////////////////
function rudr_post_tags_meta_box_remove() {
	$id = 'tagsdiv-post_tag'; // you can find it in a page source code (Ctrl+U)
	$post_type = 'company'; // remove only from post edit screen
	$position = 'side';
	remove_meta_box( $id, $post_type, $position );
}
add_action( 'admin_menu', 'rudr_post_tags_meta_box_remove');
function rudr_add_new_tags_metabox(){
	$id = 'rudrtagsdiv-post_tag'; // it should be unique
	$heading = 'Tags'; // meta box heading
	$callback = 'rudr_metabox_content'; // the name of the callback function
	$post_type = 'post';
	$position = 'side';
	$pri = 'default'; // priority, 'default' is good for us
	add_meta_box( $id, $heading, $callback, $post_type, $position, $pri );
}
add_action( 'admin_menu', 'rudr_add_new_tags_metabox');
 
/*
 * Fill
 */
function rudr_metabox_content($post) {  
 
	// get all blog post tags as an array of objects
	$all_tags = get_terms( array('taxonomy' => 'comp_categories', 'hide_empty' => 0) ); 
 
	// get all tags assigned to a post
	$all_tags_of_post = get_the_terms( $post->ID, 'comp_categories' );  
 
	// create an array of post tags ids
	$ids = array();
	if ( $all_tags_of_post ) {
		foreach ($all_tags_of_post as $tag ) {
			$ids[] = $tag->term_id;
		}
	}
 
	// HTML
	echo '<div id="taxonomy-post_tag" class="categorydiv">';
	echo '<input type="hidden" name="tax_input[post_tag][]" value="0" />';
	echo '<ul>';
	foreach( $all_tags as $tag ){
		// unchecked by default
		$checked = "";
		// if an ID of a tag in the loop is in the array of assigned post tags - then check the checkbox
		if ( in_array( $tag->term_id, $ids ) ) {
			$checked = " checked='checked'";
		}
		$id = 'post_tag-' . $tag->term_id;
		echo "<li id='{$id}'>";
		echo "<label><input type='checkbox' name='tax_input[post_tag][]' id='in-$id'". $checked ." value='$tag->slug' /> $tag->name</label><br />";
		echo "</li>";
	}
	echo '</ul></div>'; // end HTML
}