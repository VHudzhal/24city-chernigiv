<?php
function bizov_company_shortcode()
{
    global $post;
    global $wp;

    if (isset($wp->query_vars['edit-ads']) && validation($wp->query_vars['edit-ads'])) {
        echo '<form method="post" enctype="multipart/form-data" action="'.get_the_permalink(get_post_meta($post->ID,'company_id',1)).'">';
        bizov_ads_html($post->ID,$wp->query_vars['edit-ads']);
		echo '<input type="hidden" name="ads_id" value="'. $wp->query_vars['edit-ads'] .'">';
        echo '<button type="submit" class="btn btn-success" name="update_ads">Update Ads</button>';
        echo '</form>';
		bizov_script();
    } elseif (isset($wp->query_vars['edit-news']) && validation($wp->query_vars['edit-news'])) {
		$post = get_post(absint($wp->query_vars['edit-news']));
        echo '<form method="post" enctype="multipart/form-data" action="'.get_permalink(get_post_meta($post->ID,'company_id',1)).'">';?>
        
                                    <p><input type="text" name="title" value="<?php echo esc_html($post->post_title); ?>" class="form-control"></p>
                                    <textarea name="descripion" class="form-control" rows="8"><?php echo esc_html($post->post_content); ?></textarea>
                                    <input type="hidden" name="post_id" value="<?php echo $post->ID; ?>">
                                    <button type="submit" id="saveNews" class="btn btn-success" name="update_news">Save News</button>
										<?php
        echo '</form>';
    } elseif (isset($wp->query_vars['edit-franchise']) && validation($wp->query_vars['edit-franchise'])) {//echo 4;
        echo '<form method="post" enctype="multipart/form-data" action="'.get_the_permalink(get_post_meta($post->ID,'company_id',1)).'">';
		$fr = get_post($wp->query_vars['edit-franchise']);
		   bizov_main_block(['title' => $fr->post_title, 'content' => $fr->post_content]);
    franchise_html($fr);
		echo '<input type="hidden" name="franchise_id" value="'. $wp->query_vars['edit-franchise'] .'">';
        echo '<button type="submit" class="btn btn-success" name="update_franchise">Update Franchise</button>';
        echo '</form>';
		bizov_script();
    } elseif (isset($wp->query_vars['edit-company']) && validation($wp->query_vars['edit-company'])) {
        echo '<form method="post" enctype="multipart/form-data"  action="'. get_the_permalink($post->ID) .'">';
        company_save_postdata('create');
        bizov_main_block(array('title'=>$post->post_title,'content'=>$post->post_content));
        company_html($post); ?>

        <p>
			<input type="hidden" name="company_id" value="<?php echo $post->ID; ?>"/>
            <button type="submit" name="update_company">Save</button>
        </p>
    </form><?php
		
		
		
		
		// crud link
		                            ?><div id="news-block">
                            <div><?php $i = 0;//echo $post->ID;
        $company_news = get_posts(array(
                                'post_type' => 'company_news',
                                'author'    => $post->post_author,		'meta_query'	=> [['key'=>'company_id', 'value'=>$post_id]],
            'post_status' => 'any'
                            ));//print_r($company_news);
        $franchises = get_posts(array(
                                'post_type' => 'franchises',
                                'author'    => $post->post_author,
			'meta_query'	=> [['key'=>'company_id', 'value'=>$post->ID]],
            'post_status' => 'any'
                            ));
        $ads = get_posts(array(
                                'post_type' => 'ads',
                                'author'    => $post->post_author,
			'meta_query'	=> [['key'=>'company_id', 'value'=>$post->ID]],
            'post_status' => 'any'
                            )); ?>
                            </div>
								<?php if (count($company_news)) { ?>
                                    <h3><?php esc_html_e('Company News', 'bizov'); ?></h3>
                                    <ul>
                                        <?php
                                    foreach ($company_news  as $news) { ?>
                                        <li>
                                            <a href="<?php echo get_the_permalink($news->ID); ?>"><?php echo esc_html($news->post_title); ?></a>
                                            <?php if (get_current_user_id() === (int)$post->post_author) { ?>
                                                <p>
                                                    <a href="<?php echo get_the_permalink($post->ID).'edit-news/'.$news->ID; ?>"><?php echo esc_html_e('Edit'); ?></a>
                                                    <a href="<?php echo get_the_permalink($post->ID).'delete/'.$news->ID; ?>"><?php echo esc_html_e('Delete'); ?></a>
                                                </p>
                                            <?php } ?>
                                        </li>
                                    <?php }
                                    echo '</ul>';
                                } ?>
                                <?php if (count($franchises)) { ?>
                                    <h3><?php esc_html_e('Company Franchises', 'bizov'); ?></h3>
                                    <ul>
                                        <?php
                                    foreach ($franchises  as $franchise) { ?>
                                        <li>
                                            <a href="<?php echo get_the_permalink($franchise->ID); ?>"><?php echo esc_html($franchise->post_title); ?></a>
                                            <?php if (get_current_user_id() === (int)$post->post_author) { ?>
                                                <p>
                                                    <a href="<?php echo get_permalink($post->ID).'edit-franchise/'.$franchise->ID; ?>"><?php echo esc_html_e('Edit'); ?></a>
                                                    <a href="<?php echo get_permalink($post->ID).'delete/'.$franchise->ID; ?>"><?php echo esc_html_e('Delete'); ?></a>
                                                </p>
                                            <?php } ?>
                                        </li>
                                    <?php }
                                    echo '</ul>';
                                } ?>
                                <?php if (count($ads)) { ?>
                                    <h3><?php esc_html_e('Company Ads', 'bizov'); ?></h3>
                                    <ul>
                                        <?php
                                    foreach ($ads  as $a) { ?>
                                        <li>
                                            <a href="<?php echo get_the_permalink($a->ID); ?>"><?php echo esc_html($a->post_title); ?></a>
                                            <?php if (get_current_user_id() === (int)$post->post_author) { ?>
                                                <p>
                                                    <a href="<?php echo get_the_permalink($post->ID).'edit-ads/'.$a->ID; ?>"><?php echo esc_html_e('Edit'); ?></a>
                                                    <a href="<?php echo get_the_permalink($post->ID).'delete/'.$a->ID; ?>"><?php echo esc_html_e('Delete'); ?></a>
                                                </p>
                                            <?php } ?>
                                        </li>
                                    <?php }
                                    echo '</ul>';
                                } ?>

                            <?php if ((int)$post->post_author === (int)get_current_user_id()) { ?>
                            <div class="container">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newNews">Create News</button>
                                <div class="modal fade" id="newNews" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="newNews" aria-hidden="true">
									 <div class="modal-dialog" role="document">
    									<div class="modal-content p-3">
											<p><button type="button" class="btn btn-secondary float-right" data-dismiss="modal">X</button></p>
                                    <p><input type="text" name="title" value="" class="form-control"></p>
                                    <textarea name="descripion" class="form-control" rows="8"></textarea>
                                    <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">
                                    <button type="button" id="saveNews" class="btn btn-success">Save News</button>
										 </div>
										 </div></div>
                            </div>

                            <div>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newAds">Create Ads</button>
                                <div class="modal fade" id="newAds" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="newAds" aria-hidden="true">
									 <div class="modal-dialog" role="document">
    									<div class="modal-content p-3">
											<p><button type="button" class="btn btn-secondary float-right" data-dismiss="modal">X</button></p>
                                    <?php bizov_ads_html($post->ID); ?>
											<button type="button" class="btn btn-success" id="saveAds">Save Ads</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										 </div></div>
                                </div>
                            </div>

                            <div>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newFranchise">Create Franchise</button>
                                <div class="modal fade" id="newFranchise" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="newFranchise" aria-hidden="true">
									 <div class="modal-dialog" role="document">
    									<div class="modal-content p-3">
											<p><button type="button" class="btn btn-secondary float-right" data-dismiss="modal">X</button></p>
                                    <?php do_shortcode('[bizov_create_franchise]'); ?><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										 </div></div>
									</div>
                            </div>
                        <?php } ?>
                        </div><?php
		
		
		
		
		
		
    } elseif (isset($wp->query_vars['edit-news']) && validation($wp->query_vars['edit-news'])) {
        echo '<form method="post" enctype="multipart/form-data">';
        company_save_postdata('create');
        $post = get_post($wp->query_vars['edit-news']);
        bizov_main_block(array('title'=>$post->post_title,'content'=>$post->post_content)); ?>
        <p>
            <button type="submit" name="button">Save</button>
        </p>
    </form><?php
    } else {
        if (isset($_POST['create_franchise']) && (int)$post->post_author === (int)get_current_user_id()) {//echo 1;
            $id = wp_insert_post(array(
                    'post_title' => sanitize_text_field($_POST['title']),
                    'post_type' => 'franchises',
                    'post_content' => wp_kses_post($_POST['content']),
			'post_author' => get_current_user_id(),
				'meta_input' => [ 'company_id'=>$post->ID ]
                ));
            franchise_save_postdata($id);
        }
		
        if (isset($_POST['update_company'])/* && validation($_POST['update_company'])*/) {print_r($_POST);die;
			wp_update_post(array(
                    'post_title' => sanitize_text_field($_POST['title']),
                    'post_content' => wp_kses_post($_POST['content']),
					'ID'		=> 0
                ));
            company_save_postdata($_POST['franchise_id']);
        }

        if (isset($wp->query_vars['delete']) && validation($wp->query_vars['delete'])) {
            wp_delete_post($wp->query_vars['delete']);
        }
		
		if(isset($_POST['update_news']) && validation($_POST['post_id'])){//echo 3;
			wp_update_post([
            'post_title' => sanitize_text_field($_POST['title']),
            'post_content' => wp_kses_post($_POST['description']),
				'ID'=>absint($_POST['post_id'])
			]);
		}
		
		if(isset($_POST['update_ads'])){//print_r($_POST);
			wp_update_post([
            'post_title' => sanitize_text_field($_POST['title']),
            'post_content' => wp_kses_post($_POST['description']),
				'ID'=>absint($_POST['ads_id'])
			]);
	bizov_save_images($_POST['ads_id'],'ads',array('thumb'));
	bizov_save_postmeta($_POST['ads_id'],array('sanitize_text_field'=>['type','date','tag','callback']));
		}

        if (isset($_FILES['file'])) {
            bizov_import();
        } ?>

    <div class="edit-company-form">
                            <?php if ((int)$post->post_author === get_current_user_id()) { ?>

										<p><a href="<?php echo esc_url(get_permalink().'edit-company'); ?>"><?php esc_html_e('Edit'); ?></a></p>
                        <?php } ?>
            <div class="entry-header">
                <div class="entry-title">
                    <a href="<?php the_permalink(); ?>"> <?php the_title(); ?>
                    </a>
                </div>
            </div>


                    <div class="company-detail-info row"><!--    /*begin left block*/-->
                        <div class="col-md-6 left-block">

                            <div class="entry-thumbnail" style="">
                                <?php $post_img = maybe_unserialize(get_post_meta($post->ID, 'thumbnail', 1)); ?>
                                <?php if ($post_img) { ?>
                                    <img src="<?php echo $post_img[0]; ?>" width="150px" alt="<?php the_title(); ?>"/>
                                <?php } ?>
                            </div>
                            <div class="company-part-block">
                                <strong>Адрес:</strong>
                                <div id="company-address" class="company-part">
                                    <?php $address = maybe_unserialize(get_post_meta($post->ID, 'address', 1)); ?>
                                    <?php if ($address) { ?>
                                        <a href="<?php echo $address['link']; ?>"><?php echo $address['text']; ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="company-part-block">
                                <strong>Контакты:</strong>
                                <div id="company-contacts" class="part-block" style="display: flex; flex-flow: column;">
                                    <?php $contacts = maybe_unserialize(get_post_meta($post->ID, 'phones', 1)); ?>
                                    <?php if (! empty($contacts)) : ?>

                                        <?php foreach ($contacts as $key => $value) { ?>
                                        <div><span>
                                            <?php echo substr($value['number'], 0, 5); ?>
                                            <?php if (is_user_logged_in()) { ?>
                                                <button type="button" name="button" data-phone="<?php echo base64_encode($value['number']); ?>" class="show-phone"><?php echo esc_html__('Show', 'bizov'); ?></button>
                                            <?php } else {
            echo esc_html__('Login to see', 'bizov');
        } ?>
                </span>
                                            <?php if ('true' === $value['fax']) {
            echo '<span>fax</span>';
        } ?>
                                            <?php if (!empty($value['comment'])) {
            echo '<span>' . esc_html($value['comment']) . '</span>';
        } ?>
                                        </div>
                                    <?php } ?>
                                <?php endif; ?>


                                             </div>
                            </div>
                            <div class="company-part-block">
                                <strong>Ссылки:</strong>
                                <div id="company-links" class="part-block">
                                    <?php $site = maybe_unserialize(get_post_meta($post->ID, 'links', 1)); ?>
                                    <a href="<?php echo $site; ?>" redirect><?php echo $site; ?></a>


                                        <?php foreach (maybe_unserialize(get_post_meta($post->ID, 'socials', 1)) as $key => $value) { ?>
                                                <a href="<?php echo esc_url($value['link']); ?>"><?php echo $value['comment']; ?></a>
                                        <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!--    end left block-->
                        <!--   begin right block-->

                        <div class="col-md-6 right-block">
                            <div class="company-part-block">
                                <div class="work-graphic">
                                    <strong>График работы:</strong>
                                    <div id="" class="company-graphic part-block">

                                        <?php $graphic = maybe_unserialize(get_post_meta($post->ID, 'graphic', 1));

        $i = 1; ?>

                                                <?php foreach (bizov_week() as  $key=>$value) { ?>
                                                                <div id="<?php echo esc_attr($value); ?>" class="day<?php echo $i; ?>
                                                                    <?php if ((int)date('N') === $i) {
            echo ' current';
        } ?>">
                                                                <div class="day-val">

                                                                <h5><?php echo $value; ?></h5>
                                                                <div class="daycontent">
                                                                <h6>
                                                                    <?php echo $graphic[$key]['day_from'].':00'; ?>
                                                                </h6>
                                                                <h6>
                                                                    <?php echo $graphic[$key]['day_to'].':00'; ?>
                                                                </h6>

                                                                </div>
                                                                </div>

                                                            <div class="lunch-content">
                                                                <?php if (isset($graphic[$key]['lunch_off'])) { ?>
                                                                    <h6><?php echo esc_html__('Without Lunch', 'bizov'); ?></h6>
                                                                <?php } else { ?>
                                                                <h6>
                                                                    <?php echo $graphic[$key]['lunch_from'].':00'; ?>
                                                                </h6>
                                                                <h6>
                                                                    <?php echo $graphic[$key]['lunch_from'].':00'; ?>
                                                                </h6>
                                                            <?php } ?>
                                                            </div>
                                                          </div>
                                                      <?php $i++;}
        $i=0; ?>
                                </div>
                            </div>
                            <div class="company-part-block payments">
                                <strong>Оплата</strong>
                                <div id="company-graphic" class="part-block">

                                    <?php $payments = bizov_payments(); ?>
                                    <?php foreach (maybe_unserialize(get_post_meta($post->ID, 'payments', 1)) as $key => $value) { ?>
                                        <span>
                                            <?php echo $payments[ $value ]; ?>
                                        </span></br>
                                    <?php } ?>

                                </div>
                            </div>
                            <div class="company-part-block payments">
                                <strong>Скидки, программы лояльности</strong>
                                <div id="company-graphic" class="part-block">
                                    <?php $loyality = maybe_unserialize(get_post_meta($post->ID, 'loyality', 1)); ?>
                                    <?php foreach ($loyality as $key => $value) { ?>
                                        <?php echo esc_html($value['title']); ?>
                                        <?php echo esc_html($value['description']); ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <!--end right block-->

                        </div>
                    </div>
                        <div class="entry-content">
                            <strong>О компании:</strong>
                            <div class="about-company" style="margin-bottom: 10px">
                                    <?php echo wp_kses_post($post->post_content); ?>
                            </div>
                            <div class="services-company-list" style="margin-bottom: 10px">
                                <strong>Предоставляемые услуги</strong>
                                <?php echo wp_kses_post(get_post_meta($post->ID, 'services_list', 1)); ?>
                            </div>
                            <div class="additional-information-company">
                                <?php echo wp_kses_post(get_post_meta($post->ID, 'additional_information', 1)); ?>
                            </div>

                        </div>
                            <div class="container-fluid" id="slider">
                    <!--            --><?php //the_field('company_slider');?>
                                <style type="text/css">
                                    #company-slider div.sp-slide img{
                                        width: 100%;
                                        height: auto;
                                        max-height: 450px;
                                    }
                                </style>
                                <?php
                                $images = maybe_unserialize(get_post_meta($post->ID, 'company_slider', 1));
        if ($images): ?>
                                <div class="slider-pro" id="company-slider" style="max-width: 750px">
                    <!--                <div class="sp-slides-container">-->
                                    <div class="sp-slides">
                                        <?php foreach ($images as $image): ?>

                                        <div class="sp-slide">
                    <div class="sp-image-container">
                                                <img class="sp-image"  src="<?php echo esc_url($image); ?>"/>
                    </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                    <!--                </div>-->
                                    <div class="sp-thumbnails">

                                    <?php foreach ($images as $image): ?>
                                            <img class="sp-thumbnail" src="<?php echo esc_url($image); ?>"/>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div id="map">

                            </div>
                            <div id="news-block">
                            <div><?php $i = 0;
        $commpany_news = get_posts(array(
                                'post_type' => 'company_news',
                                'author'    => $post->post_author,
            'post_status' => 'publish',
			'meta_query'=>[ ['key'=>'company_id','value'=>$post->ID] ]
                            ));//echo $post->post_author;
        $franchises = get_posts(array(
                                'post_type' => 'franchises',
                                'author'    => $post->post_author,
            'post_status' => 'publish',
			'meta_query'=>[ ['key'=>'company_id','value'=>$post->ID] ]
                            ));
        $ads = get_posts(array(
                                'post_type' => 'ads',
                                'author'    => $post->post_author,
            'post_status' => 'publish',
			'meta_query'=>[ ['key'=>'company_id','value'=>$post->ID] ]
                            ));//print_r($ads); ?>
                            </div>
								<?php if (count($commpany_news)) { ?>
                                    <h3><?php esc_html_e('Company News', 'bizov'); ?></h3>
                                    <ul>
                                        <?php
                                    foreach ($commpany_news  as $news) { ?>
                                        <li>
                                            <a href="<?php echo get_the_permalink($news->ID); ?>"><?php echo esc_html($news->post_title); ?></a>
                                        </li>
                                    <?php }
                                    echo '</ul>';
                                } ?>
                                <?php if (count($franchises)) { ?>
                                    <h3><?php esc_html_e('Company Franchises', 'bizov'); ?></h3>
                                    <ul>
                                        <?php
                                    foreach ($franchises  as $franchise) { ?>
                                        <li>
                                            <a href="<?php echo get_the_permalink($franchise->ID); ?>"><?php echo esc_html($franchise->post_title); ?></a>

                                        </li>
                                    <?php }
                                    echo '</ul>';
                                } ?>
                                <?php if (count($ads)) { ?>
                                    <h3><?php esc_html_e('Company Ads', 'bizov'); ?></h3>
                                    <ul>
                                        <?php
                                    foreach ($ads  as $a) { ?>
                                        <li>
                                            <a href="<?php echo get_the_permalink($a->ID); ?>"><?php echo esc_html($a->post_title); ?></a>
                                        </li>
                                    <?php }
                                    echo '</ul>';
                                } ?>
                        </div>
    </div></div>
<?php
    } ?>
    <script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('.show-phone').click(function(){
            phone = $(this).attr('data-phone');
            $(this).closest('li').html(unescape(atob(phone)));
        });

        $('#addNews').click(function(){
            i = $('#news-block .news').length;

            title = $(this).parent().find('input[name=title]').val(),
            description = $(this).parent().find('textarea').val(),
            date = $(this).parent().find('input[name=date]').val();

            $(this).parent().find('input[name=title]').val('');
            $(this).parent().find('textarea').val('');

            div = document.createElement('div');
            input = document.createElement('input');
            input2 = document.createElement('input');
            input3 = document.createElement('input');

            $(input).attr('type', 'hidden')
                    .attr('name', 'news['+i+'][title]')
                    .val(title);
             $(input3).attr('type', 'hidden')
                     .attr('name', 'news['+i+'][date]')
                     .val(date);

              $(input2).attr('type', 'hidden')
                      .attr('name', 'news['+i+'][description]')
                      .val(description);



            $(div).attr('class','news')
                  .html(title)
                 .append(input)
                 .append(input3)
                 .append(input2);

            $('#news-block form').append(div);
        });

        $('#saveNews').click(function(){
            data = {
                action: 'createNews',
                title: $('#newNews input').val(),
                content: $('#newNews textarea').val(),
                id: <?php echo $post->ID; ?>
            }

            $.post('<?php echo esc_url(admin_url('admin-ajax.php')); ?>',data,function(r){console.log(r)
                $('#newNews input').val('');
                $('#newNews textarea').val('');
            });
        });

        $('#saveAds').on('click',function(){
			$(this).append('<i class="spinner-border" role="status"></i>')
			data = new FormData();
			data.append('thumb[]',$('#newAds input[type=file]').prop('files')[0]);
			data.append('thumb[]',$('#newAds .images-container input[type=hidden]').val());
			data.append('action','createAds');
			data.append('title',$('#newAds input[name=title]').val());
			data.append('content', $('#newAds iframe').contents().find('body').html());
			data.append('type', $('#type').val());
			data.append('date[]', $('#dateStart').val());
			data.append('date[]',$('#dateEnd').val());
			data.append('id','<?php echo $post->ID; ?>');

			$('#newAds input.callback').each(function(i,el){
				if($(el).prop('checked')) data.append('callback[]',$(el).val());
			});

											$('#newAds .adsTags').each(function(i,el){
												data.append('tag[]',$(el).val());
											});

			            jQuery.ajax({
                            url: '<?php echo admin_url('admin-ajax.php'); ?>',
                            type: 'post',
                            contentType: false,
                            processData: false,
                            data: data,
                            success: function (response) {console.log(response)
								$('#newAds input[name=title]').val('');
								$('#newAds iframe').contents().find('body').html('');
								$('#newAds input[type=file]').val('');
								$('#dateStart').val('');
								$('#dateEnd').val('');
								$('#adsTags select').val(-1);
								$('#adsTags1, #adsTags2').html('');
								$('#newAds .images-container').html('');

								$('#newAds input[name=callback]').each(function(i,el){
									$(el).prop('checked',0);
								});

														  $('#saveAds i').remove();
                            },
                            error: function (response) {
                             console.log('error');
                            }

                        });
                    });

            //$.post('<?php //echo esc_url(admin_url('admin-ajax.php')); ?>//',data,function(){
            //    $('#newAds input[name=title]').val('');
            //    $('#newAds textarea').html('');
			//	$('#newAds input[type=file]').val('');
			//	$('#dateStart').val('');
			//	$('#dateEnd').val('');
			//	$('#type').val(-1);
            //
			//	$('#newAds input[name=callback]').each(function(i,el){
			//		$(el).prop('checked',0);
			//	});
            //});

    });
    </script>
    <?php
}

function bizov_franchise_shortcode()
{
    global $post;
    global $wp;

    if (isset($wp->query_vars['edit-franchise'])) {
        echo '<form method="post" enctype="multipart/form-data" action="'.get_permalink().'">';
        franchise_save_postdata('create');
        bizov_main_block(array('title'=>$post->post_title,'content'=>$post->post_content));
        franchise_html($post); ?>

            <p>
                <button type="submit" name="button">Save</button>
            </p>
        </form><?php
    } else { ?>
    <div class="franchise">
        <h1><?php the_title(); ?></h1>
        <figure>
            <img src="<?php echo esc_url(maybe_unserialize(get_post_meta($post->ID, 'image', 1))[0]); ?>" alt="<?php the_title(); ?>"/>
        </figure>
        <h4><?php echo esc_html__('Description', 'bizov'); ?></h4>
        <div class="description">
            <?php echo wp_kses_post(get_post_meta($post->ID, 'description', 1)); ?>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4><?php echo esc_html__('Category', 'bizov'); ?></h4>
            <div class="col-md-6">
                <h4><?php echo esc_html__('Franchise Owner', 'bizov'); ?></h4>
                <?php
                $owner_id = get_post_meta($post->ID, 'franchise_owner', 1);
    echo get_user_meta($owner_id, 'nickname', 1); ?>
            </div>
        </div>

            <h4><?php echo esc_html__('Price', 'bizov'); ?></h4>
            <span><?php echo get_post_meta($post->ID, 'price_min', 1) . ' - ' . get_post_meta($post->ID, 'price_max', 1); ?></span>

            <h4><?php echo esc_html__('Gallery', 'bizov'); ?></h4>
            <?php $gallery = maybe_unserialize(get_post_meta($post->ID, 'slider', 1)); ?>
            <ul>
                <?php foreach ($gallery as $key => $value) { ?>
                    <li class="<?php if (!$key) {
        echo 'active';
    } ?>">
                        <img src="<?php echo esc_url($value); ?>" alt="">
                    </li>
                <?php } ?>
            </ul>
            <?php if ((int)$post->post_author === (int)get_current_user_id()) { ?>
                <li>
                    <a href="<?php echo get_permalink().'edit-franchise'; ?>"></a>
                </li>
            <?php } ?>
    </div>
    <?php if ((int)$post->post_author === (int)get_current_user_id()) { ?>
        <p>
            <a href="<?php echo get_permalink().'edit-franchise'; ?>">Edit Franchise</a>
        </p>
    <?php } }
}

add_shortcode('bizov_create_company', 'bizov_create_company');

function bizov_create_company()
{
    global $post;
    echo '<form method="post" enctype="multipart/form-data">';
    company_save_postdata('create');
    bizov_main_block(array('title'=>'','content'=>''));
    company_html($post); ?>

    <p>
        <button type="submit" name="button">Save</button>
    </p>
</form>
    <?php
}

add_shortcode('bizov_create_franchise', 'bizov_create_franchise');

function bizov_create_franchise()
{
    global $post;
    echo '<form method="post" enctype="multipart/form-data" action="'.get_permalink().'">';
    franchise_save_postdata('create');
    bizov_main_block(['title' => '', 'content' => '']);
    franchise_html($post); ?>


        <button type="submit" name="create_franchise" class='btn btn-success w-100'>Save</button>

</form>
    <?php
}

function bizov_main_block($post)
{
    wp_nonce_field('bizov', 'create'); ?>
    <p><input type="text" name="title" placeholder="<?php echo esc_html__('Title', 'bizov'); ?>" value="<?php echo esc_html__($post['title']); ?>"></p>
    <p>
        <?php $content = $post['content']; ?>
        <?php wp_editor(wp_kses_post($content), 'description'.rand(), array( 'media_buttons' =>  0, 'textarea_name' => 'description')); ?>
    </p>
    <?php
}
