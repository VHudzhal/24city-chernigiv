<?php
$fr_obj = new FranchiseClass();
global $post, $current_user;
//get_currentuserinfo();


    ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class('company-post'); ?> >
    <div class="public-content" style="">
   <div class="header"><span id="head-title"><?php the_title() ?></span></div>
<?php if (!(is_user_logged_in())) { ?>
    <center><strong>Только зарегистрированные пользователи могут добавить свою компанию </strong><br/><br/><br/>
        Пожалуйста, зарегистрируйтесь или войдите.<br/><br/></center>
<?php } else {
?>
    <!--Скрипт спойлера, Для работы нужен jquery-->
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
                $('.spoiler_links').click(function () {
                    if ($(this).parent().children('div.spoiler_body').css("display")=="none") {
                        $("div[class^='spoiler_body']").hide('normal');
                        $(this).parent().children('div.spoiler_body').toggle('normal');
                    }
                    else $("div[class^='spoiler_body']").hide('normal');
                });
            $(".edit_link").click(function () {
                $(this).parent().children("div.edit-block").fadeToggle("slow");
            return false;
            })
            });
    </script>
    <!--Скрипт спойлера-->

    <div class="edit-company-form">
        <!--Кнопка спойлера-->
        <a href="" style="position: absolute;
        right: 21%;
    width:auto;
    padding-right: 10px;" class="edit_link">Редактировать</a>
        <!--Кнопка спойлера-->
<?php //the_content();?>
        <!--Форма редактирования в спойлере-->
        <div style="background-color: #FAEBD7; padding: 40px; border-radius: 7px;display: none;" class="edit-block">
            <input type="button" value="Закрыть все"
                   onclick=jQuery("div[class^='spoiler_body']").hide('normal')>
            <input type="button" value="Открыть все"
                   onclick=jQuery("div[class^='spoiler_body']").show('normal')>
            <div>

            <strong>Общая информация</strong> <div  class="spoiler_links" style="cursor: pointer;">Скрыть</div>
            <div class="spoiler_body">
            <?php

            $edit_post = array(
                'post_id' => get_the_ID(), // Get the post ID
                'field_groups' => array(10920), // Create post field group ID(s)
                'form' => true,
                'return' => '%post_url%',
                'html_before_fields' => '<div id="edit-company">',
                'html_after_fields' => '</div>',
                'submit_value' => 'Сохранить изменения'
            );
            acf_form($edit_post);?>
            </div>
        </div>
            <div>
                   <div style="display: flex; flex-flow: row; justify-content: flex-start"><strong>Акции</strong><div class="spoiler_links" style="cursor: pointer;"><i class="fa fa-plus"></i>Показать</div></div>
                    <button class="btn btn-success" data-toggle="modal" data-target="#stockModal">Добавить акцию</button>
                    <div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document" style="max-width: 70%; top: 20%; padding: 20px">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><strong>Акция</strong></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <?php
                                $edit_post = array(
                                    'post_id' => get_the_ID(), // Get the post ID
                                    'field_groups' => array(5901), // Create post field group ID(s)
                                    'form' => true,
                                    'return' => '%post_url%',
                                    'html_before_fields' => '<div id="edit-company-stock">',
                                    'html_after_fields' => '</div>',
                                    'submit_value' => 'Сохранить изменения'
                                );
                                acf_form($edit_post);
                                ?>

                                </div>
                            </div>
                        </div>
                    </div>
                <div class="spoiler_body">

                    <?php if ( have_rows( 'stocks' ) ) : ?>
                        <?php while ( have_rows( 'stocks' ) ) : the_row(); ?>
                        <div style="display: flex; flex-flow: row; justify-content: space-around;">
                            <span>
                            <?php the_sub_field( 'stock_name' ); ?>
                            </span>
                            <span>
                            <?php the_sub_field( 'stock_value' ); ?>
                            </span>
                        </div>
                            <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
                    <strong>Фото</strong><div class="spoiler_links" style="cursor: pointer;">Показать</div>
                <div class="spoiler_body">
                    <div class="spoiler_gallery_body">
                        <?php
                        $edit_gallery = array(
                            'post_id' => get_the_ID(), // Get the post ID
                            'field_groups' => array(5910), // Create post field group ID(s)
                            'form' => true,
                            'return' => '%post_url%',
                            'html_before_fields' => '<div id="edit-company-gallery">',
                            'html_after_fields' => '</div>',
                            'submit_value' => 'Сохранить галерею'
                        );
                        acf_form($edit_gallery);
                        ?>
                    </div>
<!--                        --><?php //the_field( 'gallery_name' ); ?>
<!---->
<!--                        --><?php //$company_gallery_images = get_field( 'company_gallery' ); ?>
<!--                        --><?php //if ( $company_gallery_images ) :  ?>
<!--                            --><?php //foreach ( $company_gallery_images as $company_gallery_image ): ?>
<!--                                <a href="--><?php //echo $company_gallery_image['url']; ?><!--">-->
<!--                                    <img src="--><?php //echo $company_gallery_image['sizes']['thumbnail']; ?><!--" alt="--><?php //echo $company_gallery_image['alt']; ?><!--" />-->
<!--                                </a>-->
<!--                                <p>--><?php //echo $company_gallery_image['caption']; ?><!--</p>-->
<!--                            --><?php //endforeach; ?>
<!--                        --><?php //endif; ?>
                    </div>
        </div><!--Форма редактирования в спойлере-->
<?php }
//Кнопка редактировать с помощью ACF
?>
<!--         <div class="entry-header">
            <div class="entry-title">
                <a href="<?php the_permalink(); ?>"> <?php the_field('company_name'); ?>
                </a>
            </div>
        </div> -->
        <div class="company-detail-info row"><!--    /*begin left block*/-->
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 left-block">

                <div class="entry-thumbnail" style="">
                    <?php $post_img = get_field('post-img'); ?>
                    <?php if ($post_img) { ?>
                        <img src="<?php echo $post_img['url']; ?>" width="150px" alt="<?php echo $post_img['alt']; ?>"/>
                    <?php } ?>
                </div>
                <div class="company-part-block" id="adr-group">
                    <strong>Адрес:</strong>
                    <div id="company-address" class="company-part">
                         <?php $address = get_field( 'address' ); ?>
<?php if ( $address ) : ?>
    <a redirect target="_blank" href="<?php echo esc_url( $address['url'] ); ?>" target="<?php echo esc_attr( $address['target'] ); ?>"><?php echo esc_html( $address['title'] ); ?></a>
<?php endif; ?>
                    </div>
                </div>
                <div class="company-part-block" id="contacts-group">
                    <strong>Контакты:</strong>
                    <div id="company-contacts" class="part-block" style="display: flex; flex-flow: column;">
                        <?php if ( have_rows( 'contacts' ) ) : ?>
                            <?php while ( have_rows( 'contacts' ) ) : the_row(); ?>
                                <?php if ( have_rows( 'phone' ) ) : ?>
                                    <?php while ( have_rows( 'phone' ) ) : the_row(); ?>
                                    <?php echo '<div>';
                                        echo '<span>'; ?>
                                        <?php the_sub_field( 'phone' ); ?>
                                    <?php echo '</span>'; ?>
                                        <?php // fax ( value )
                                        $fax_array = get_sub_field( 'fax' );
                                        if ( $fax_array ):
                                            foreach ( $fax_array as $fax_item ):
                                                echo '<span>';
                                                echo $fax_item;
                                            echo '</span>';
                                            endforeach;
                                        endif; ?>
<?php                                        echo '<span>'; ?>
                                        <?php the_sub_field( 'comment-to-phone' ); ?>
                        <?php
                        echo '</span>';
                                    echo '</div>';
                                    ?>
                                        <?php endwhile; ?>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <?php // no rows found ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="company-part-block" id="links-group">
                    <strong>Ссылки:</strong>
                    <div id="company-links" class="part-block">
                        <?php if (have_rows('links')) : ?>
                            <?php while (have_rows('links')) : the_row(); ?>
                                <?php $link = get_sub_field('link')?> 
						<a  href="<?php echo esc_url($link['url']); ?>" redirect><?php echo esc_html($link['title']); ?>
                                   </a>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <?php //no rows found ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="company-part-block" id="branches-group">
                    <strong>Связанные компании, филиалы:</strong>
                    <div id="company-links" class="part-block company-adr-links" style="display: flex; flex-flow: column;flex-wrap: wrap">
                    <?php $tags = get_field( 'tags' ); ?>
<?php if ( $tags ) : ?>
	<?php foreach ( $tags as $post ) : ?>
		<?php setup_postdata ( $post ); ?>
		<div>
		<a redirect style="color: black" href="<?php the_permalink(); ?>"><?php the_title(); ?>
	<?php $address = get_field( 'address' ); ?>
<?php if ( $address ) : ?>
    <span style="color: gray"><?php echo esc_html( $address['title'] ); ?></span>
</a>
</div>
<?php endif; ?>
	<?php endforeach; ?>
	<?php wp_reset_postdata(); ?>
<?php endif; ?>
                    </div>
                </div>
                <div class="company-part-block" id="soc-list-group">
                    <strong>В социальных сетях:</strong>
                    <div id="social-links" class="part-block">
                        <?php if (have_rows('social_links')) : ?>
                            <?php while (have_rows('social_links')) : the_row(); ?>
                                <?php $soc_link = get_sub_field('social_link');
                               $colors = get_sub_field( 'social_lists' );
                                ?>
<?php
echo '<div style="display: flex">';
if( $colors === "Youtube"){
    echo '<i class="fab fa-youtube"></i>';
}
elseif( $colors === "Facebook"){
    echo '<i class="fab fa-facebook"></i>';
}elseif( $colors === "Twitter"){
echo '<i class="fab fa-twitter"></i>';
}elseif( $colors === "Instagram"){
    echo '<i class="fab fa-instagram"></i>';
}else if( $colors === "VKontakte"){
    echo '';
}
?>
                                	<a style="margin-left: 5px" href="<?php echo esc_url($soc_link); ?>" redirect><?php echo esc_html($soc_link); ?>
                                   </a></div></br>
                                   <?php

// Create a comma-separated list from selected values.
//if( $colors ): ?>

<?php //endif; ?>
               
                            <?php endwhile; ?>
                        <?php else : ?>
                            <?php // no rows found ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!--    end left block-->
            <!--   begin right block-->

            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 right-block">
                <div class="company-part-block">
                    <div class="work-graphic">
                        <strong>График работы:</strong>
                        <div id="" class="company-graphic part-block">
                            <?php if (have_rows('graphic')) : ?>
                                <?php while (have_rows('graphic')) : the_row(); ?>
                                    <?php if (have_rows('monday')) : ?>
                                        <?php while (have_rows('monday')) : the_row(); ?>
                                            <?php if (have_rows('monday_day')) : ?>
                                                <?php while (have_rows('monday_day')) : the_row(); ?>
                                                    <div id="Monday" class="day1 day-block">
                                                    <div class="day-val">

                                                    <h5>Пн</h5>
                                                    <div class="daycontent">
                                                    <h6>
                                                        <?php the_sub_field('monday_from'); ?>
                                                    </h6>
                                                    <h6>
                                                        <?php the_sub_field('monday_to'); ?>
                                                    </h6>

                                                    </div>
                                                    </div>

                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                            <?php if (have_rows('monday_lunch')) : ?>
                                                <?php while (have_rows('monday_lunch')) : the_row(); ?>
                                                <div class="lunch-content">
                                                    <h6>
                                                        <?php the_sub_field('monday_from_lunch'); ?>
                                                    </h6>
                                                    <h6>
                                                        <?php the_sub_field('monday_lunch_to'); ?>
                                                    </h6>
                                                </div>
                                              </div>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                    <?php if (have_rows('tuesday')) : ?>
                                        <?php while (have_rows('tuesday')) : the_row(); ?>
                                            <?php if (have_rows('tuesday_day')) : ?>
                                                <?php while (have_rows('tuesday_day')) : the_row(); ?>
                                                    <div id="Tuesday" class="day2 day-block">
                                                    <div class="day-val">

                                                    <h5>Вт</h5>

                                                    <div class="daycontent">
                                                    <h6>
                                                        <?php the_sub_field('tuesday_from'); ?>
                                                    </h6>
                                                    <h6>
                                                        <?php the_sub_field('tuesday_to'); ?>
                                                    </h6>

                                                    </div>
                                                    </div>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                            <?php if (have_rows('tuesday_lunch')) : ?>
                                                <?php while (have_rows('tuesday_lunch')) : the_row(); ?>
                                                <div class="lunch-content">
                                                    <h6>
                                                    <?php the_sub_field('tuesday_from_lunch'); ?>
                                                </h6>
                                                <h6>
                                                    <?php the_sub_field('Tuesday_lunch_to'); ?>
                                                </h6>
                                                </div>
                    </div>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                    <?php if (have_rows('Wednesday')) : ?>
                                        <?php while (have_rows('Wednesday')) : the_row(); ?>
                                            <?php if (have_rows('wednesday_day')) : ?>
                                                <?php while (have_rows('wednesday_day')) : the_row(); ?>
                                                    <div id="Wednesday" class="day3 day-block">
                                                    <div class="day-val">

                                                    <h5>Ср</h5>
                                                    <div class="daycontent">
                                                    <h6>
                                                        <?php the_sub_field('wednesday_from'); ?>
                                                    </h6>
                                                    <h6>
                                                        <?php the_sub_field('wednesday_to'); ?>
                                                    </h6>

                                                    </div>
                                                    </div>

                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                            <?php if (have_rows('wednesday_lunch')) : ?>
                                                <?php while (have_rows('wednesday_lunch')) : the_row(); ?>
                      <div class="lunch-content">
                                                <h6>
                                                    <?php the_sub_field('wednesday_from_lunch'); ?>
                                                </h6>
                                                <h6>
                                                    <?php the_sub_field('wednesday_lunch_to'); ?>
                                                </h6>
                      </div>
                </div>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                    <?php if (have_rows('thursday')) : ?>
                                        <?php while (have_rows('thursday')) : the_row(); ?>
                                            <?php if (have_rows('thursday_day')) : ?>
                                                <?php while (have_rows('thursday_day')) : the_row(); ?>


                                                    <div id="Thursday" class="day4 day-block">
                                                    <div class="day-val">

                                                    <h5>Чт</h5>
                                                    <div class="daycontent">
                                                    <h6>
                                                        <?php the_sub_field('thursday_from'); ?>
                                                    </h6>
                                                    <h6>
                                                        <?php the_sub_field('thursday_to'); ?>
                                                    </h6>

                                                    </div>
                                                    </div>

                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                            <?php if (have_rows('thursday_lunch')) : ?>
                                                <?php while (have_rows('thursday_lunch')) : the_row(); ?>
<div class="lunch-content">
                                                <h6>
                                                    <?php the_sub_field('thursday_from_lunch'); ?>
                                                </h6>
                                                <h6>
                                                    <?php the_sub_field('thursday_lunch_to'); ?>
                                                </h6>
            </div>
        </div>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                    <?php if (have_rows('friday')) : ?>
                                        <?php while (have_rows('friday')) : the_row(); ?>
                                            <?php if (have_rows('friday_day')) : ?>
                                                <?php while (have_rows('friday_day')) : the_row(); ?>
                                                    <div id="Friday" class="day5 day-block">
                                                    <div class="day-val">

                                                    <h5>Пт</h5>

                                                    <div class="daycontent">
                                                    <h6>
                                                        <?php the_sub_field('friday_from'); ?>
                                                    </h6>
                                                    <h6>
                                                        <?php the_sub_field('friday_to'); ?>
                                                    </h6>
                                                    </div>
                                                    </div>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                            <?php if (have_rows('friday_lunch')) : ?>
                                                <?php while (have_rows('friday_lunch')) : the_row(); ?>
                                                    <div class="lunch-content">
                                                    <h6>
                                                        <?php the_sub_field('friday_from_lunch'); ?>
                                                    </h6>
                                                    <h6>
                                                        <?php the_sub_field('friday_lunch_to'); ?>
                                                    </h6>
                                                    </div>

        </div>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                    <?php if (have_rows('saturday')) : ?>
                                        <?php while (have_rows('saturday')) : the_row(); ?>
                                            <?php if (have_rows('saturday_day')) : ?>
                                                <?php while (have_rows('saturday_day')) : the_row(); ?>
                                                    <div id="Saturday" class="day6 day-block">
                                                    <div class="day-val">

                                                    <h5>Сб</h5>

                                                    <div class="daycontent">
                                                    <h6>
                                                        <?php the_sub_field('saturday_from'); ?>
                                                    </h6>
                                                    <h6>
                                                        <?php the_sub_field('saturday_to'); ?>
                                                    </h6>

                                                    </div>
                                                    </div>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                            <?php if (have_rows('saturday_lunch')) : ?>
                                                <?php while (have_rows('saturday_lunch')) : the_row(); ?>
<div class="lunch-content">
                                                <h6>
                                                    <?php the_sub_field('saturday_from_lunch'); ?>
                                                </h6>
                                                <h6>
                                                    <?php the_sub_field('saturday_lunch_to'); ?>
                                                </h6>
                                                </div>
                </div>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                    <?php if (have_rows('sunday')) : ?>
                                        <?php while (have_rows('sunday')) : the_row(); ?>
                                            <?php if (have_rows('sunday_day')) : ?>
                                                <?php while (have_rows('sunday_day')) : the_row(); ?>
                                                    <div id="Sunday" class="day7 day-block">
                                                    <div class="day-val">
                                                    <h5>Вс</h5>
                                                    <div class="daycontent">
                                                    <h6>
                                                        <?php the_sub_field('sunday_from'); ?>
                                                    </h6>
                                                    <h6>
                                                        <?php the_sub_field('sunday_to'); ?>
                                                    </h6>

                                                    </div>
                                                    </div>

                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                            <?php if (have_rows('sunday_lunch')) : ?>
                                                <?php while (have_rows('sunday_lunch')) : the_row(); ?>

                                                <div class="lunch">
                                                <h6>
                                                    <?php the_sub_field('sunday_from_lunch'); ?>
                                                </h6>
                                                <h6>
                                                    <?php the_sub_field('sunday_lunch_to'); ?>
                                                </h6>
                                                </div>
                                                </div>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="company-part-block payments" id="payments-group">
                    <strong>Оплата</strong>
                    <div id="company-graphic" class="part-block">
                        <?php if (have_rows('оплата')) : ?>
                            <?php while (have_rows('оплата')) : the_row(); ?>
                                <?php // payments ( value )
                                $payments_array = get_sub_field('payments');
                                if ($payments_array):
                                    foreach ($payments_array as $payments_item):
                                        echo '<span>';
                                        echo $payments_item;
                                        echo '</span></br>';
                                    endforeach;
                                endif; ?>
                                <?php the_sub_field('own_payments'); ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="company-part-block payments" id="loyalty-group">
                    <strong>Скидки, программы лояльности</strong>
                    <div id="company-graphic" class="part-block">
                        <?php if ( have_rows( 'loyalty_programs' ) ) : ?>
                            <?php while ( have_rows( 'loyalty_programs' ) ) : the_row(); ?>
                                <?php the_sub_field( 'loyalty_program' ); ?>
                                <?php the_sub_field( 'loyalty_content' ); ?>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <?php // no rows found ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!--end right block-->

            </div>
        </div>
        <div class="entry-content">
            <strong>О компании:</strong>
            <div class="about-company" style="margin-bottom: 10px"><?php
                            the_field('about_company');
                ?></div>
            <div class="services-company-list" style="margin-bottom: 10px">
                <strong>Предоставляемые услуги</strong>
                <?php the_field( 'services_list' ); ?>
            </div>
            <div class="additional-information-company">
                <strong>Дополнительная информация</strong>
                <?php the_field( 'additional_information' ); ?>
            </div>
        </div>
        <div class="container-fluid" id="slider">
<!--            --><?php //the_field('company_slider'); ?>
            <style type="text/css">
                #company-slider div.sp-slide img{
                    width: 100%;
                    height: auto;
                    /*max-height: 450px;*/
                }
            </style>
            <?php
            $images = get_field('company_slider');
            if( $images ): ?>
            <div class="slider-pro" id="company-slider" style="max-width: 750px">
<!--                <div class="sp-slides-container">-->
                <div class="sp-slides">
                    <?php foreach( $images as $image ): ?>

                    <div class="sp-slide">
<div class="sp-image-container">
                            <img class="sp-image"  src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
</div>
                        </div>
                    <?php endforeach; ?>
                </div>
<!--                </div>-->
                <div class="sp-thumbnails">

                <?php foreach( $images as $image ): ?>
                        <img class="sp-thumbnail" src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="Thumbnail of <?php echo esc_url($image['alt']); ?>" />
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php $map_place = get_field('map_place'); ?>
        <?php if ($map_place) { ?>
            <?php echo $map_place['address']; ?>
            <?php echo $map_place['lat']; ?>
            <?php echo $map_place['lng']; ?>
        <?php } ?>
        <div>
            <?php if (have_rows('Новости')): ?>
                <?php while (have_rows('Новости')) : the_row(); ?>
                    <?php if (get_row_layout() == 'new') : ?>
                        <?php the_sub_field('news'); ?>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php else: ?>
                <?php // no layouts found ?>
            <?php endif; ?>
        </div>
    </div>
    </div>
    </div>
<?php
//get_sidebar('right-company');
