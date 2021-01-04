<?php

bizov_input(array(
    'label'     => __('Classificator', 'bizov'),
    'id'        => 'classificator',
    'type'      => 'chekboxes',
    'labels'    => array(
        __('Class1', 'bizov'),
        __('Class2', 'bizov')
    ),
    'taxonomy'  => 0,
    'required'  => 1
));

bizov_input(array(
    'label'     => __('Thumbnail', 'bizov'),
    'id'        => 'thumbnail',
    'type'      => 'image',
    'multiple'  => 0,
    'required'  => 0
));

$address  = maybe_unserialize(get_post_meta($post->ID, 'address', 1));
?>
<div>
    <label><?php echo esc_html__('Address', 'bizov'); ?><span class="required">*</span><label>
    <span  class="row">
        <input type="text" placeholder="<?php echo esc_attr__('Link Text', 'bizov'); ?>" name="address[text]" required value="<?php echo isset($address['text']) ? esc_attr($address['text']) : ''; ?>"/>
        <input type="url" placeholder="<?php echo esc_attr__('Link URL', 'bizov'); ?>" required name="address[link]" value="<?php echo isset($address['link']) ? esc_attr($address['link']) : ''; ?>"/>
    </span>
</div>
<?php

bizov_input(array(
    'label'     => __('SEO Title', 'bizov'),
    'id'        => 'seotitle',
    'type'      => 'text',
    'required'  => 0
));

bizov_input(array(
    'label'     => __('SEO Description', 'bizov'),
    'id'        => 'seodescription',
    'type'      => 'textarea',
    'required'  => 0
));

bizov_input(array(
    'label'     => __('SEO Keywords', 'bizov'),
    'id'        => 'seokeywords',
    'type'      => 'text',
    'required'  => 0
));

bizov_input(array(
    'label'     => __('Locate', 'bizov'),
    'id'        => 'map_place',
    'type'      => 'textarea',
    'required'  => 0,
    'placeholder'   => 'lat:lnd on GoogleMaps'
));

bizov_input(array(
    'label'     => __('Tags', 'bizov'),
    'id'        => 'tags',
    'type'      => 'textarea',
    'required'  => 0
));

bizov_input(array(
    'label'     => __('Category', 'bizov'),
    'id'        => 'company_categories',
    'type'      => 'chekboxes',
    'labels'    => maybe_unserialize(get_terms(array( 'taxonomy' => 'company_categories', 'hide_empty' => 0 ))),
    'required'  => 1,
    'taxonomy'  => 0,
    'add'       => 1
));

$option_list = bizov_option_list();

?>
<div class="">
    <label for="contacts"><?php echo esc_html__('Contacts', 'bizov'); ?></label>
        <div class="list">
            <?php bizov_item('phones'); ?>
        </div>
        <div class="new">
            <input type="tel"  pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="phone" placeholder="Phone(xxx-xxx-xxxx)"/>
            <label>
                <input type="checkbox" name="fax" value="">
                fax
            </label>
            <input name="comment" placeholder="Comment to phone" type="text"/>
            <button type="button" name="button" class="add-new button"><?php echo esc_html__('Add New Phone', 'bizov'); ?></button>
        </div>
</div>

<div class="">
    <label for="emails_group"><?php echo esc_html__('Emails', 'bizov'); ?></label>
        <div class="list">
            <?php bizov_item('emails_group'); ?>
        </div>
        <div class="new">
            <input type="email" name="email" placeholder="Email"/>
            <input name="comment" placeholder="Comment to email" type="text"/>
            <button type="button" name="button" class="button add-new"><?php echo esc_html__('Add New Email', 'bizov'); ?></button>
        </div>
</div>

<div class="">
    <label for="contact_options"><?php echo esc_html__('Contact Options', 'bizov'); ?></label>
        <div class="list">
            <?php bizov_item('contact_options'); ?>
        </div>
        <div class="new">
            <label for="contact_ptions">Option List</label>
            <select class="" name="option_list">
                <?php foreach ($option_list as $key => $value) { ?>
                    <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($value); ?></option>
                <?php } ?>
            </select>
            <input type="text" name="option" placeholder="Option"/>
            <input name="comment" placeholder="Comment to Option" type="text"/>
            <button type="button" name="button" class="button add-new"><?php echo esc_html__('Add New Option', 'bizov'); ?></button>
        </div>
</div>
<?php

bizov_input(array(
    'label'     => __('Site URL', 'bizov'),
    'id'        => 'links',
    'type'      => 'url',
    'required'  => 0
));

?>
<div class="">
    <label for="socials_group"><?php echo esc_html__('Socials', 'bizov'); ?></label>
        <div class="list">
            <?php bizov_item('socials'); ?>
        </div>
        <div class="new">
            <input type="url" name="link" placeholder="Link"/>
            <input name="comment" placeholder="Comment to link" type="text"/>
            <button type="button" name="button" class="button add-new"><?php echo esc_html__('Add New Link', 'bizov'); ?></button>
        </div>
</div>
<?php

bizov_input(array(
    'label'     => __('Company Slider', 'bizov'),
    'id'        => 'company_slider',
    'type'      => 'image',
    'multiple'  => 1,
    'required'  => 0
));

$i = 0;
$k = 12;
$week = bizov_week();

$graphic = maybe_unserialize(get_post_meta($post->ID, 'graphic', 1));//print_r($graphic);
?>
<div>
    <label for="graphic"><?php echo esc_html__('Graphic', 'bizov'); ?></label>
    <ul id="graphic">
        <?php foreach ($week as $key => $value) { ?>
        <li>
            <label><?php echo esc_html($value); ?></label><?php echo esc_html__('Day', 'bizov'); ?>
            <select class="" name="graphic[<?php echo esc_attr($key); ?>][day_from]">
                <?php while ($i < 24) { ?>
                    <option value="<?php echo esc_attr($i); ?>"
                        <?php isset($graphic[$key]) ? selected($graphic[ $key ]['day_from'], $i) : 0; ?>
                        ><?php echo esc_attr($i . ':00'); ?></option>
                <?php $i++; } $i = 0; ?>
            </select>
            <select class="" name="graphic[<?php echo esc_attr($key); ?>][day_to]">
                <?php while ($i < 24) { ?>
                    <option value="<?php echo esc_attr($i); ?>"
                        <?php isset($graphic[$key]) ? selected($graphic[ $key ]['day_to'], $i):0; ?>
                        ><?php echo esc_attr($i . ':00'); ?></option>
                <?php $i++; } $i = 0; ?>
            </select><?php echo esc_html__('Lunch', 'bizov'); ?>
            <select class="" name="graphic[<?php echo esc_attr($key); ?>][lunch_from]">
                <?php while ($k < 15) { ?>
                    <option value="<?php echo esc_attr($k); ?>"
                        <?php isset($graphic[$key]) ?  selected($graphic[ $key ]['lunch_from'], $k):0; ?>
                        ><?php echo esc_attr($k . ':00'); ?></option>
                <?php $k++; } $k = 12; ?>
            </select>
            <select class="" name="graphic[<?php echo esc_attr($key); ?>][lunch_to]">
                <?php while ($k < 15) { ?>
                    <option value="<?php echo esc_attr($k); ?>"
                        <?php isset($graphic[$key]) ? selected($graphic[ $key ]['lunch_to'], $k):0; ?>
                        ><?php echo esc_attr($k . ':00'); ?></option>
                <?php $k++; } $k = 12; ?>
            </select>
            <label>
                <input type="checkbox" name="graphic[<?php echo esc_attr($key); ?>][lunch_off]" <?php checked(isset($graphic[ $key ]['lunch_off'])); ?>>
                <?php echo esc_html__('witout lunch', 'bizov'); ?>
            </label>
        </li>
    <?php } ?>
    </ul>
</div>
<?php

bizov_input(array(
    'label'     => __('Payment Methods', 'bizov'),
    'id'        => 'payments',
    'type'      => 'chekboxes',
    'labels'    => bizov_payments(),
    'taxonomy'  => 0,
    'required'  => 1
));

$commpany_news = get_posts(array(
    'post_type' => 'company_news',
    'author'    => $post->post_author
));

if (!empty($commpany_news)) {
    ?>
<div class="news">
    <label for="news"><?php echo esc_html__('News', 'bizov'); ?></label>
        <ul>
            <?php foreach ($commpany_news as $key => $value) { ?>
                <?php if (is_admin()) { ?>
                    <li>
                        <?php edit_post_link($value->post_title, '', '', $commpany_news); ?>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
</div>
<?php
}

bizov_input(array(
    'label'     => __('Services', 'bizov'),
    'id'        => 'services_list',
    'type'      => 'textarea',
    'required'  => 0
));

bizov_input(array(
    'label'     => __('Additional Information', 'bizov'),
    'id'        => 'additional_information',
    'type'      => 'textarea',
    'required'  => 0
));

$loyality_types = array(
    __('Карточка на скидку', 'bizov'),
    __('Скидка при условии', 'bizov'),
    __('Накопительные программы', 'bizov'),
    __('Сезонные скидки', 'bizov'),
    __('Карточки на скидку', 'bizov'),
    __('Карточки на скидку', 'bizov'),
    __('Карточки на скидку', 'bizov'),
    __('Карточки на скидку', 'bizov'),
    __('Карточки на скидку', 'bizov'),
    __('Карточки на скидку', 'bizov'),
    __('Карточки на скидку', 'bizov'),
);

?>
<div class="">
    <label for="loyality"><?php echo esc_html__('Loyality Programs', 'bizov'); ?></label>
        <div class="list">
            <?php bizov_item('loyality'); ?>
        </div>
        <div class="new">
            <p><select class="" name="type">
                <?php foreach ($loyality_types as $key => $value) { ?>
                    <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                <?php } ?>
            </select>
            <input type="text" name="program_title" placeholder="Program Title" value=""></p>
            <textarea name="program_description" rows="8" cols="80" placeholder="Program Description"></textarea>
            <button class="button add-new"><?php echo esc_html__('Add New', 'bizov'); ?></button>
        </div>
</div>
<?php
		
		
    bizov_input(array(
        'label' => __('Страна'),
        'id'    => 'country',
        'metaoptions'=> [ 'Украина', 'Россия', 'Белорусь' ],
        'required' => 0,
        'type' => 'select'
    ));
