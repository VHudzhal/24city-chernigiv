<?php
/**
 * Plugin Name: Bizov
 * Plugin URI: http://woocommerce.com/products/woocommerce-user-content/
 * Description: Create franchise and company metaboxes
 * Version: 1.0.0
 * Author: LazucruB
 * Author URI: http://yourdomain.com/
 * Developer: Bogdan Chirukin
 * Developer URI: http://yourdomain.com/
 * Text Domain: bizov
 * Domain Path: /languages
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

 if (! defined('ABSPATH')) {
     exit; // Exit if accessed directly
 }

define('GMAPIKEY', '');

add_action('add_meta_boxes', 'bizov_add_meta_boxes');

function bizov_add_meta_boxes()
{
    add_meta_box('franchise_meta_box', __('Franchise Catalog', 'bizov'), 'franchise_html', array( 'franchises'));
    add_meta_box('company_meta_box', __('Company', 'bizov'), 'company_html', array( 'company' ));
    add_meta_box('konkurs_meta_box', __('Konkurs', 'bizov'), 'konkurs_html', array( 'concurs' ));
    
}

function franchise_html($post)
{
    wp_nonce_field('bizov', 'franchise');
    bizov_script();

    require_once 'franchise.php';
}

function company_html($post)
{
    wp_nonce_field('bizov', 'company');

    require_once 'company.php';
    bizov_script();
}


function konkurs_html($post)
{
    wp_nonce_field('bizov', 'konkurs');

    require_once 'konkurs.php';
    bizov_script();
}

add_action('save_post', 'franchise_save_postdata');

function franchise_save_postdata($post_id)
{
    if ($post_id === 'create') {
        if (isset($_POST['bizov']) && wp_verify_nonce($_POST['bizov'], 'create')) {
            $post_id = wp_create_post(array(
            'post_title' =>sanitize_text_field($_POST['title']),
            'post_content' => wp_kses_post($_POST['description']),
            'post_type'     => 'franchise'
        ));
        } else {
            global  $post;
            $post_id = $post->ID;
        }
    }

    if (isset($_POST['franchise']) && wp_verify_nonce($_POST['franchise'], 'bizov') && is_user_logged_in()) {
        bizov_save_images($post_id, 'franchise', array( 'image', 'slider' ));
        bizov_save_taxonomy(array( 'franchises-categories'), $post_id);
        bizov_save_postmeta($post_id, array(
            'sanitize_text_field'   => array('franchise_name', 'price_min', 'price_max', 'franchise_owner'),
            'wp_kses_post'          => array('description')
        ));
    }
}

add_action('save_post', 'company_save_postdata');

function company_save_postdata($post_id)
{
    if ($post_id === 'create') {
        if (isset($_POST['bizov']) && wp_verify_nonce($_POST['bizov'], 'create')) {
            $post_id = wp_create_post(array(
        'post_title' =>sanitize_text_field($_POST['title']),
        'post_content' => wp_kses_post($_POST['description']),
        'post_type'     => 'company'
    ));
        } else {
            global  $post;
            $post_id = $post->ID;
        }
    }
    if (isset($_POST['company']) && wp_verify_nonce($_POST['company'], 'bizov') && is_user_logged_in()) {
        bizov_save_images($post_id, 'company', array('thumbnail', 'company_slider'));
        bizov_save_taxonomy(array('company_categories'), $post_id);
        bizov_save_postmeta($post_id, array(
            'sanitize_text_field'   => array('classificator','tags', 'address', 'seotitle', 'seokeywords','map_place', 'phones', 'emails_group', 'socials', 'contact_options', 'graphic', 'payments'),
            'wp_kses_post'          => array('additional_information', 'services_list', 'seodescription', 'loyality'),
            'esc_url_raw'          => array('links')
        ));
    }
}
add_action('save_post', 'konkurs_save_postdata');

function konkurs_save_postdata($post_id)
{
    if ($post_id === 'create') {
        if (isset($_POST['bizov']) && wp_verify_nonce($_POST['bizov'], 'create')) {
            $post_id = wp_create_post(array(
        'post_title' =>sanitize_text_field($_POST['title']),
        'post_content' => wp_kses_post($_POST['description']),
        'post_type'     => 'concurs'
    ));
        } else {
            global  $post;
            $post_id = $post->ID;
        }
    }
    if (isset($_POST['concurs']) && wp_verify_nonce($_POST['concurs'], 'bizov') && is_user_logged_in()) {
        bizov_save_images($post_id, 'concurs', array('thumbnail', 'concurs_slider'));
        bizov_save_taxonomy(array('konkurs_categories'), $post_id);
    }
}

add_action('post_edit_form_tag', 'bizov_post_edit_form_tag');

function bizov_post_edit_form_tag($post)
{
    echo 'enctype="multipart/form-data"';
}

add_action('admin_print_styles-post.php', 'bizov_style');
function bizov_style()
{
    wp_enqueue_style('bizov-metaboxe', plugins_url('bizov/style.css'));
}

add_shortcode('bizov_company', 'bizov_company_shortcode');
add_shortcode('bizov_franchise', 'bizov_franchise_shortcode');

add_action('wp_enqueue_scripts', 'bizov_jquery');

function bizov_jquery()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-datepicker');
}

add_action('wp_footer', 'bizov_map');

function bizov_map()
{
    global $tags;

    if (1) {
        global $post;
        $location = get_post_meta($post->ID, 'map_place', 1);
        $loc = explode(':', $location); ?>
<script type="text/javascript">
jQuery(document).ready(function ($) {
    $('.remove-news').click(function(){
        $(this).parent().remove();
    });

    $('#dateStart').datepicker();
    $('#dateEnd').datepicker();

    $('#show_news_form').click(function(){
        $('#news_form').toggle();
    });

    $('input[name=to_news]').change(function(){
        var file_data = $(this).prop('files')[0];
        var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('action', 'import');

            jQuery.ajax({
                            url: '<?php echo admin_url('admin-ajax.php'); ?>',
                            type: 'post',
                            contentType: false,
                            processData: false,
                            data: form_data,
                            success: function (response) {
                                $('#news_content').html(response);
                            },
                            error: function (response) {
                             console.log('error');
                            }

                        });
                    });

                    var tags =  '<?php echo json_encode($tags); ?>';

                    if ($('#adsTags').length) {//alert(typeof JSON.parse(tags));
                        tags = JSON.parse(tags);console.log(tags)

                         select = renderLisr(tags);

                        if( $('#adsTags').html() === '') $('#adsTags').html(select);

                        $('#adsTags select').change(function(){//alert($(this).val());
                            if (Object.keys(tags[$(this).val()]).length === 2) {console.log(Object.keys(tags[$(this).val()]).length)
                                select1=renderLisr(tags[$(this).val()]['subs']);
                                subtags = tags[$(this).val()]['subs'];
                                $('#adsTags1').html(select1);
                            } else {
                                $('#adsTags1').html('');
                                $('#adsTags2').html('');
                            }
                        });

                        $($('#adsTags1')).on('change','select',function(){//alert(8)
                            if (Object.keys(subtags[$(this).val()]).length === 2) {//console.log(tags[$(select).val()]['subs'])
                                select2=renderLisr(subtags[$(this).val()]['subs']);
                                $('#adsTags2').html(select2);
                            } else {
                                $('#adsTags2').html('');
                            }
                        });
                    }

                    function renderLisr(obj){
                        select = document.createElement('select');
                        option = document.createElement('option');
                        $(option).attr('value',-1).html('-Выберите-');
                        $(select).attr('name','tag[]').attr('class','adsTags')
                                    .html(option);

                        for(key in obj){
                            option = document.createElement('option');

                            if (jQuery.inArray('label',Object.keys(obj[key])) !== -1) {
                                label = obj[key]['label'];//console.log(obj[key])
                            } else {
                                label = obj[key];//console.log(Object.keys(obj[key]))
                            }

                            $(option).attr('value',key)
                                     .html(label);

                            $(select).append(option);
                        }

                        return select;
                    }

});

<?php if (count($loc) === 2) { ?>

var map;
function initMap() {
  // The location of Uluru
  var uluru = {lat: <?php echo $loc[0]; ?>, lng: <?php echo $loc[1]; ?>};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 4, center: uluru});
  // The marker, positioned at Uluru
  var marker = new google.maps.Marker({position: uluru, map: map});
}
<?php } ?>
</script>
<?php
    echo '<script  defer src="https://maps.googleapis.com/maps/api/js?key='.GMAPIKEY.'&callback=initMap"></script>';
    }
}

register_activation_hook( __FILE__, 'bizov_activate' );

function bizov_activate(){
	delete_option( 'rewrite_rules' );
}

require_once 'ajax.php';
require_once 'functions.php';
require_once 'shortcodes.php';
require_once 'ads.php';