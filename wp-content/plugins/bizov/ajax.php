<?php
add_action('wp_ajax_createNews', 'cabinet_create_news');
function cabinet_create_news()
{
    if (isset($_POST['action'])) {
        $id = wp_insert_post([
            'post_title' => sanitize_text_field($_POST['title']),
            'post_content' => wp_kses_post($_POST['content']),
            'post_type' => 'company_news',
            'meta_input' => [ 'company_id'=>absint($_POST['id']) ],
			'post_author' => get_current_user_id()
        ]);wp_die($id);
    }
}

add_action('wp_ajax_createAds','bizov_create_ads');
function bizov_create_ads(){
        $post_id = wp_insert_post([
            'post_title' => sanitize_text_field($_POST['title']),
            'post_content' => wp_kses_post($_POST['content']),
            'post_type' => 'ads',
            'meta_input' => [ 'company_id'=>absint($_POST['id']) ],
			'post_author' => get_current_user_id()
        ]);//wp_send_json($_FILES);
	bizov_save_images($post_id,'ads',array('thumb'));
	bizov_save_postmeta($post_id,array('sanitize_text_field'=>['type','date','tag','callback']));
}
//add_action('wp_ajax_createKonkurs','bizov_create_konkurs');
//function bizov_create_konkurs(){
  //      $post_id = wp_insert_post([
    //        'post_title' => sanitize_text_field($_POST['title']),
      //      'post_content' => wp_kses_post($_POST['content']),
        //    'post_type' => 'concurs',
          //  'meta_input' => [ 'concurs_id'=>absint($_POST['id']) ],
			//'post_author' => get_current_user_id()
//        ]);//wp_send_json($_FILES);
//	bizov_save_images($post_id,'concurs',array('thumb'));
//	bizov_save_postmeta($post_id,array('sanitize_text_field'=>['type','date','tag','callback']));
//}