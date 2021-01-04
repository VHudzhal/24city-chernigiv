<?php
function bizov_input($args)
{
    global $post; ?>
    <div>
        <label for="<?php echo esc_attr($args['id']); ?>">
            <?php echo esc_html($args['label']);
    echo $args['required'] ? '<span class="required">*</span>' : '';
    echo '</label>';

    switch ($args['type']) {
                case 'textarea':
                ?>
                <textarea
                    id="<?php echo esc_attr($args['id']); ?>"
                    name="<?php echo esc_attr($args['id']); ?>"
                    placeholder="<?php echo isset($args['placeholder']) ? $args['placeholder'] : ''; ?>"
                    <?php echo $args['required'] ? ' required' : ''; ?>><?php echo wp_kses_post(get_post_meta($post->ID, $args['id'], 1)); ?></textarea>
                <?php break;
                case 'select':
                ?>
                <select
                    id="<?php echo esc_attr($args['id']); ?>"
                    name="<?php echo esc_attr($args['id']); ?>"
                    >
                        <?php if (isset($args['options'])) {//var_dump($args);
                    foreach ($args['options'] as $key => $value) { ?>
                                <option value="<?php echo esc_attr($value->name); ?>" <?php selected($args['value'], $value->term_id); ?>>
                                    <?php echo esc_attr($value->name); ?>
                                </option>
                                <?php
                            }
                } elseif (isset($args['optgroup'])) {
                    foreach ($args['optgroup'] as $key => $value) { ?>
                                <optgroup label="<?php echo esc_attr($value['label']); ?>">
                                    <?php foreach ($value['options'] as $k => $val) { ?>
                                        <option value="<?php echo esc_attr($val->ID); ?>"  <?php selected($args['value'], $val->ID); ?>>
                                            <?php echo esc_html($val->display_name); ?>
                                        </option>
                                    <?php } ?>
                                </optgroup>
                                <?php
                            }
                } elseif (isset($args['metaoptions'])) {
                    foreach ($args['metaoptions'] as $key => $value) { ?>
                        <option value="<?php echo $key; ?>"  <?php selected($args['value'],$key); ?>><?php echo $value; ?></option>
                    <?php }
                } ?>
                    </select>
                    <?php break;
                    case 'image':
                    ?>
                    <div class="image<?php echo $args['multiple'] ? '-multiple' : ''; ?>" id="<?php echo esc_attr($args['id']); ?>">
                        <div class="images-container">
                            <?php
                            $images = $args['value'] ? $args['value'] : maybe_unserialize(get_post_meta($post->ID, $args['id'], 1));//var_dump($post->ID);
                            if (! empty($images)) {
                                foreach ($images as $key => $value) {
                                    bizov_image_container($value, $args['id']);
                                }
                            } ?>
                        </div>
                        <input
                            type="file"
                            name="<?php echo esc_attr($args['id'] . '[]'); ?>"
                            <?php echo $args['multiple'] ? 'multiple' : ''; ?>
                            accept=".jpg, .jpeg, .png"
                        />
                    </div>
                    <?php break;
                    case  'chekboxes':
                        echo '<div class="list">';

                        bizov_checkbox_list($args);

                        echo '</div>';

                        if (isset($args['add'])) { ?>
                            <span class="row new">
                                <input type="text" placeholder="New Value">
                            <button class="add-new button"><?php echo esc_html__('Add New', 'bizov'); ?></button>
                        <?php }
                    break;
                default:
                ?>
                <input
                    type="<?php echo esc_attr($args['type']); ?>"
                    id="<?php echo esc_attr($args['id']); ?>"
                    value="<?php echo esc_attr(get_post_meta($post->ID, $args['id'], 1)); ?>"
                    name="<?php echo esc_attr($args['id']); ?>"
                    <?php echo $args['required'] ? ' required' : ''; ?>
                />
                <?php break;
            } ?>
</div>
    <?php
}

function bizov_image_container($image_url, $name)
{
    ?>
    <div class="image-container">
        <img src="<?php echo esc_url($image_url); ?>" height="100px"/>
        <input type="hidden" value="<?php echo esc_url($image_url); ?>" name="<?php echo esc_attr($name . '[]'); ?>">
        <button class="button removeImg">X</button>
    </div>
    <?php
}

function bizov_checkbox_list($args)
{
    global $post;

    $terms = get_terms(array( 'taxonomy' => $args['id'], 'hide_empty' => 0 ));
    $meta = maybe_unserialize(get_post_meta($post->ID, $args['id'], 1));

    if (is_a($terms, 'WP_Term')) {
        foreach ($terms as $key => $value) {
            $termins[] = $value->name;
        }
    }

    if (! empty($termins) || !empty($meta)) { ?>
        <ul class="checkbox-group" id="<?php echo esc_attr($args['id']); ?>">
            <?php foreach ($args['labels'] as $key => $value) { ?>
                    <li>
                        <label>
                            <?php if ($args['taxonomy']) { ?>
                                <input type="checkbox" name="<?php echo esc_attr($args['id'] . '[]'); ?>" value="<?php echo esc_attr($value->name); ?>" <?php checked(in_array($value->name, $terms)); ?>/>
                                <?php echo esc_html($value->name); ?>
                            <?php } else { ?>
                                <input type="checkbox" name="<?php echo esc_attr($args['id'] . '[]'); ?>" value="<?php echo esc_attr($key); ?>" <?php checked(in_array($key, $meta)); ?>/>
                                <?php echo esc_html($value); ?>
                            <?php } ?>
                        </label>
                    </li>
            <?php } ?>
        </ul>
<?php }
}

function bizov_option_list()
{
    return array('ICQ', 'Skype', 'Your var');
}

function bizov_script()
{
    ?>
    <script>
    jQuery(document).ready(function ($) {
       $('input[type=file]').change(function(){
            var counter = -1, file,
                i = 0,
                boxId  = $(this).parent().attr('id');//console.log(this.files);

            $('#' + boxId + ' .images-container').html('');

            while(file = this.files[++counter]) {
                var reader = new FileReader();
                reader.onloadend = (function(file){
                    return function(){
                        var image = new Image();

                        image.height = 100;
                        image.title = file.name;
                        image.src = this.result;
                        image.dataIndex = counter;
                        div = document.createElement('div');
                        $(div).attr('class', 'image-container-' + i);
                        button = document.createElement('button');
                        $(button).attr('class', 'button removeImg');
                        $(button).html('x');
                        input = document.createElement('input');
                        $(input).attr('type', 'hidden');
                        $(input).attr('name', boxId + '[]');
                        $(input).val(file.name);

                        $('#' + boxId + ' .images-container').append(div);
                        $('#' + boxId + ' .image-container-' + i).html(image)
                                                                 .prepend(button)
                                                                 .prepend(input);
                        i++;
                    }
                })(file);

                reader.readAsDataURL(file);
            }

            $('body').on('click', '.removeImg', function(){
                $(this).parent().remove();
                return 0;
            });
       });

       $('.add-new').click(function(){
           container = $(this).parent().parent();
           id =  container.find('label').attr('for');

           if (container.find('.new input[type=text]').val().length) {

               if (!container.find('ul').length) {
                   ul = document.createElement('ul');
                   container.find('.list').html(ul);
               }

               i = container.find('li').length;

               if ('classificator' === id || 'company_categories' === id){
                   li = item1(this,id);
               } else if ('contacts' === id){
                   li = item2(this,i);
               } else if ('emails_group'  === id) {
                   li = item3(this,i);
               } else if ('socials_group' === id) {
                   li = item4(this,i);
               } else if ('contact_options' === id) {
                   li = item5(this,i);
               } else if ('news' === id) {
                   li = item6(this,i);
               } else if ('loyality' === id) {
                   li = item7(this,i);
               }

               button = document.createElement('button');
               $(button).attr('class', 'button remove');
               $(button).html('x');

               $(li).append(button);
               container.find('ul').append(li);

               container.find('.new input').each(function(i,e){
                   $(e).val('');
               });
           }

           return false;
       });

       $('body').on('click', '.remove', function(){
           $(this).parent().remove();

           return false;
       });

       $('body').on('click', '.edit', function(){
           title = $(this).parent().find('.title').val();
           description = $(this).parent().find('.description').val();

           $(this).closest('.news').find('input[name=title]').val(title);
           $(this).closest('.news').find('iframe').contents().find('body').html(description);

           $(this).parent().remove();

           return false;
       });

       function item1(el,id){
           checkbox = document.createElement('input');
           value = $(el).parent().find('input').val();
           $(checkbox).attr('type', 'checkbox');
           $(checkbox).attr('name', id + '[]');
           $(checkbox).attr('value', value);
           $(checkbox).attr('type', 'checkbox');
           label = document.createElement('label');
           li = document.createElement('li');

           $(label).html(value);
           $(label).prepend(checkbox);
           $(li).html(label);

           return li;
       };

       function item2(el,i){
           number = $(el).parent().find('input[type=tel]').val();
           comment = $(el).parent().find('input[type=text]').val();
           fax = $(el).parent().find('input[type=checkbox]').prop('checked');

           li = document.createElement('li');
           input = document.createElement('input');
           input1 = document.createElement('input');
           input2 = document.createElement('input');

           $(input).attr('type', 'hidden')
                   .attr('name', 'phones[' + i + '][number]')
                   .val(number);
            $(input1).attr('type', 'hidden')
                    .attr('name', 'phones[' + i + '][fax]')
                    .val(fax);
            $(input2).attr('type', 'hidden')
                    .attr('name', 'phones[' + i + '][comment]')
                    .val(comment);

            fax = fax ? '(fax)' : '';

           $(li).html(comment + fax + ':' + number)
                .append(input1)
                .append(input2)
                .append(input);

           return li;
       }

       function item3(el,i){
           email = $(el).parent().find('input[type=email]').val();
           comment = $(el).parent().find('input[type=text]').val();

           li = document.createElement('li');
           input1 = document.createElement('input');
           input2 = document.createElement('input');

            $(input1).attr('type', 'hidden')
                    .attr('name', 'emails_group[' + i + '][email]')
                    .val(email);
            $(input2).attr('type', 'hidden')
                    .attr('name', 'emails_group[' + i + '][comment]')
                    .val(comment);

           $(li).html(comment + '(' + email + ')')
                .append(input1)
                .append(input2);

           return li;
       }

       function item4(el,i){
           link = $(el).parent().find('input[type=url]').val();
           comment = $(el).parent().find('input[type=text]').val();

           li = document.createElement('li');
           input1 = document.createElement('input');
           input2 = document.createElement('input');

            $(input1).attr('type', 'hidden')
                    .attr('name', 'socials[' + i + '][link]')
                    .val(link);
            $(input2).attr('type', 'hidden')
                    .attr('name', 'socials[' + i + '][comment]')
                    .val(comment);

           $(li).html(comment + '(' + link + ')')
                .append(input1)
                .append(input2);

           return li;
       }

       function item5(el, i){
           list = $(el).parent().find('select').val();
           option = $(el).parent().find('input[name="option"]').val();
           comment = $(el).parent().find('input[name="comment"]').val();

           li = document.createElement('li');
           input = document.createElement('input');
           input1 = document.createElement('input');
           input2 = document.createElement('input');

           $(input).attr('type', 'hidden')
                   .attr('name', 'contact_options['+i+'][list]')
                   .val(list);
            $(input1).attr('type', 'hidden')
                    .attr('name', 'contact_options['+i+'][option]')
                    .val(option);
            $(input2).attr('type', 'hidden')
                    .attr('name', 'contact_options['+i+'][comment]')
                    .val(comment);

            option = option ? '(' + option + ')' : '';

           $(li).html(list + option + ':' + comment)
                .append(input1)
                .append(input2)
                .append(input);

           return li;
       }

       function item6(el,i){
           title = $(el).parent().find('input[name=title]').val();
           description = $(el).parent().find('iframe').contents().find('body').html();

           $(el).parent().find('iframe').contents().find('body').html('');

           li = document.createElement('li');
           input = document.createElement('input');
           input1 = document.createElement('input');
           input2 = document.createElement('input');
           button = document.createElement('button');
           today = new Date();

           $(input).attr('type', 'hidden')
                   .attr('name', 'news['+i+'][title]')
                   .attr('class','title')
                   .val(title);
            $(input1).attr('type', 'hidden')
                    .attr('name', 'news['+i+'][description]')
                    .attr('class','description')
                    .val(description);
             $(input2).attr('type', 'hidden')
                     .attr('name', 'news['+i+'][date]')
                     .attr('class','date')
                     .val(today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate());

            $(button).attr('class','edit button')
                     .html('Edi News');

           $(li).html(title)
                .append(button)
                .append(input1)
                .append(input2)
                .append(input);

           return li;
       }

       function item7(el){
           type = $(el).parent().find('select').val();
           description = $(el).parent().find('textarea[name=description]').val();
           title = $(el).parent().find('input[name=title]').val();

           $(el).parent().find('textarea[name=description]').val('');

           li = document.createElement('li');
           input = document.createElement('input');
           input1 = document.createElement('input');
           input2 = document.createElement('input');

           $(input).attr('type', 'hidden')
                   .attr('name', 'loyality['+i+'][title]')
                   .val(title);
            $(input1).attr('type', 'hidden')
                    .attr('name', 'loyality['+i+'][type]')
                    .val(type);

             $(input2).attr('type', 'hidden')
                     .attr('name', 'loyality['+i+'][description]')
                     .val(description);

           $(li).html(title)
                .append(input1)
                .append(input)
                .append(input2);

           return li;
       }
    });
    </script>
    <?php
}

function bizov_save_images($post_id, $post_type, $array)
{
    if (! file_exists(ABSPATH . 'bizov-' . $post_type . '/' . sanitize_text_field($_POST['title']))) {//wp_die( ABSPATH . 'bizov-franchise/' . sanitize_text_field( $_POST['franchise_name'] ) );
        mkdir(ABSPATH . 'bizov-' . $post_type . '/' . sanitize_text_field($_POST['title']), 0777, 1);
    }


    foreach ($array as $mainkey => $mainvalue) {
        if (! empty($_FILES[ $mainvalue ]) && isset($_POST[ $mainvalue ])) {
            $i = 0;

            while ($i < count($_FILES[ $mainvalue ]['name'])) {
                //print_r($_POST[ $mainvalue ]);
                //wp_die();
                if (in_array($_FILES[ $mainvalue ]['name'][ $i ], $_POST[ $mainvalue ])) {
                    $file_path = ABSPATH . 'bizov-' . $post_type . '/' . sanitize_text_field($_POST['title']) . '/' . sanitize_file_name($_FILES[ $mainvalue ]['name'][ $i ]);

                    if (! file_exists($file_path)) {
                        move_uploaded_file($_FILES[ $mainvalue ]['tmp_name'][ $i ], $file_path);
                    }

                    $pathdata[] = site_url('bizov-' . $post_type . '/' . sanitize_text_field($_POST['title']) . '/' . sanitize_file_name($_FILES[ $mainvalue ]['name'][ $i ]));
                }
                $i++;
            }

            if (isset($pathdata)) {
                update_post_meta($post_id, $mainvalue, maybe_serialize($pathdata));
                unset($pathdata);
            }
        } elseif (isset($_POST[ $mainvalue ])) {
            foreach ($_POST[ $mainvalue ] as $key => $value) {
                $urldata[] = $value;
            }
            update_post_meta($post_id, $mainkey, maybe_serialize($urldata));
            unset($urldata);
        }
    }
}

function bizov_save_taxonomy($taxonomies, $post_id)
{
    foreach ($taxonomies as $key => $taxonomy) {
        if (isset($_POST[ $taxonomy ])) {//wp_die( $_POST[ $taxonomy ] );

            $terms = is_array($_POST[ $taxonomy ]) ? array_map('sanitize_text_field', $_POST[ $taxonomy ]) : sanitize_text_field($_POST[ $taxonomy ]);

            wp_set_object_terms($post_id, $terms, $taxonomy);
        }
    }
}

function bizov_save_postmeta($post_id, $array)
{
    foreach ($array as $key => $value) {
        foreach ($value as $k => $val) {
            //echo $val;
            if (isset($_POST[ $val ])) {
                $newval = maybe_serialize($_POST[ $val ]);
                update_post_meta($post_id, $val, call_user_func($key, $newval));
            }
        }
    }
}

function bizov_week()
{
    return array(
        'monday'    => __('Monday', 'bizov'),
        'tuesday'   => __('Tuesday', 'bizov'),
        'wednesday' => __('Wednesday', 'bizov'),
        'thursday'  => __('Thursday', 'bizov'),
        'friday'    => __('Friday', 'bizov'),
        'satyrday'  => __('Saturday', 'bizov'),
        'sunday'    => __('Sunday', 'bizov'),
    );
}

function bizov_payments()
{
    return array(
        __('Наличный расчет'),
        __('Visa, MasterCard'),
        __('PayPass'),
        __('Безналичный расчет'),
        __('Яндекс деньги'),
        __('Международные переводы'),
        __('Интернет банкинг'),
        __('Мобильные платежи'),
        __('Другое')
    );
}

function bizov_item($slug)
{
    global $post;

    $items = maybe_unserialize(get_post_meta($post->ID, $slug, 1));
    $button = '<button class="button remove">x</button>';
    $i = 0;

    if (empty($items)) {
        return;
    }
    echo '<ul>';
    foreach ($items as $key => $value) {
        echo '<li>';
        switch ($slug) {
        case 'phones':
            $fax = $value['fax'] === 'true' ? '(fax)' : '';
            echo $value['comment'] . $fax . ':' . $value['number'] . $button;
            ?>
            <input type="hidden" name="phones[<?php echo esc_attr($i); ?>][comment]" value="<?php echo esc_attr($value['comment']); ?>">
            <input type="hidden" name="phones[<?php echo esc_attr($i); ?>][number]" value="<?php echo esc_attr($value['number']); ?>">
            <input type="hidden" name="phones[<?php echo esc_attr($i); ?>][fax]" value="<?php echo esc_attr($value['fax']); ?>">
            <?php
            break;

        case 'emails_group':
            echo $value['comment'] . '(' . $value['email'] .')'. $button;
            ?>
            <input type="hidden" name="emails_group[<?php echo esc_attr($i); ?>][comment]" value="<?php echo esc_attr($value['comment']); ?>">
            <input type="hidden" name="emails_group[<?php echo esc_attr($i); ?>][email]" value="<?php echo esc_attr($value['email']); ?>">
            <?php
            break;

        case 'contact_options':
            echo $value['list'] . '(' . $value['option'] .'):'. $value['comment'] . $button;
            ?>
            <input type="hidden" name="contact_options[<?php echo esc_attr($i); ?>][comment]" value="<?php echo esc_attr($value['comment']); ?>">
            <input type="hidden" name="contact_options[<?php echo esc_attr($i); ?>][list]" value="<?php echo esc_attr($value['list']); ?>">
            <input type="hidden" name="contact_options[<?php echo esc_attr($i); ?>][option]" value="<?php echo esc_attr($value['option']); ?>">
            <?php
            break;

        case 'socials':
            echo $value['comment'] . '(' . $value['link'] .')'. $button;
            ?>
            <input type="hidden" name="socials[<?php echo esc_attr($i); ?>][comment]" value="<?php echo esc_attr($value['comment']); ?>">
            <input type="hidden" name="socials[<?php echo esc_attr($i); ?>][link]" value="<?php echo esc_attr($value['link']); ?>">
            <?php
            break;

        case 'news':
            echo $value['title'] . '<button class="button" class="button" class="edit">Edit News</button>'. $button;
            ?>
            <input type="hidden" name="news[<?php echo esc_attr($i); ?>][title]" value="<?php echo esc_attr($value['title']); ?>" class="title">
            <input type="hidden" name="news[<?php echo esc_attr($i); ?>][description]" value="<?php echo esc_attr($value['description']); ?>" class="description">
            <input type="hidden" name="news[<?php echo esc_attr($i); ?>][date]" value="<?php echo esc_attr($value['date']); ?>" class="date">
            <?php
            break;

        case 'loyality':
            echo $value['title'] . $button;
            ?>
            <input type="hidden" name="loyality[<?php echo esc_attr($i); ?>][type]" class="type" value="<?php echo esc_attr($value['type']); ?>">
            <input type="hidden" name="loyality[<?php echo esc_attr($i); ?>][title]" class="title" value="<?php echo esc_attr($value['title']); ?>">
            <input type="hidden" name="loyality[<?php echo esc_attr($i); ?>][description]" value="<?php echo esc_attr($value['description']); ?>">
            <?php
            break;

        default:
            // code...
            break;
    }
        echo '</li>';
        $i++;
    }
    echo'</ul>';
}

add_action('wp_ajax_import', 'bizov_import');

function bizov_import()
{
    require_once('vendor/autoload.php');
    switch ($_FILES['file']['type']) {
        case 'application/pdf':

            $parser = new \Smalot\PdfParser\Parser();
$pdf    = $parser->parseFile($_FILES['file']['tmp_name']);

$string = $pdf->getText();

            break;

        case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':

 $string = getTextFromZippedXML($_FILES['file']['tmp_name'], "word/document.xml");

            break;

        default:
            $string = 'File Type ERROR';
            break;
    }
}

add_action('init', 'bizov_endpoint');

$endpoints = [
    'edit-news',
    'edit-company',
    'edit-franchise',
    'edit-ads',
    'edit-concurs',
    'delete'
];

function bizov_endpoint()
{
    global $endpoints;

    foreach ($endpoints as $key => $value) {
        add_rewrite_endpoint($value, EP_ALL);
    }
}

add_filter('query_vars', 'bizov_vars');
function bizov_vars($vars)
{
    global $endpoints;

    foreach ($endpoints as $key => $value) {
        $vars[] = $value;
    }

    return $vars;
}

function getTextFromZippedXML($archiveFile, $contentFile)
{
    // Создаёт "реинкарнацию" zip-архива...
    $zip = new ZipArchive;
    // И пытаемся открыть переданный zip-файл
    if ($zip->open($archiveFile)) {
        // В случае успеха ищем в архиве файл с данными
        if (($index = $zip->locateName($contentFile)) !== false) {
            // Если находим, то читаем его в строку
            $content = $zip->getFromIndex($index);
            // Закрываем zip-архив, он нам больше не нужен
            $zip->close();

            // После этого подгружаем все entity и по возможности include'ы других файлов
            // Проглатываем ошибки и предупреждения
            @$xml = DOMDocument::loadXML($content, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
            // После чего возвращаем данные без XML-тегов форматирования

            return $xml->saveXML();
        }
        $zip->close();
    }
}

add_action('wp_insert_post', 'action_function_name_2109', 10, 3);
function action_function_name_2109($post_ID, $post, $update)
{
    if (!$update && $post->post_status === 'draft') {
        $to = get_option('admin_email');

        $subject = 'Create new ' . $post->post_type;

        $user=  get_userdata($post->post_author);
        $message  = 'User ' . $user->display_name . ' was created new ' . $post->post_type . edit_post_link($post->post_title, '', '', $post->ID);

        wp_mail($to, $subject, $message);
    }
}

function validation($post_id)
{//echo 0;
    $post = get_post($post_id);

    if (is_a($post, 'WP_Post')) {
        if (get_current_user_id() == $post->post_author) {
            return 1;
        } else {
            wp_die('Access denied!');
        }
    }
    wp_die('Access denied!');
}

add_action('template_redirect','company_update_actiom');
function company_update_actiom(){
	        if (isset($_POST['update_company']) && validation($_POST['company_id'])) {//print_r($_POST);die;
			wp_update_post(array(
                    'post_title' => sanitize_text_field($_POST['title']),
                    'post_content' => wp_kses_post($_POST['content']),
					'ID'		=> $_POST['company_id']
                ));
            company_save_postdata($_POST['company_id']);
				
				wp_redirect(get_permalink($_POST['company_id']));
        }
}