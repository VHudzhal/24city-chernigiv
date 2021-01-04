<?php
$fr_obj = New FranchiseClass();
$taxonomy = 'konkurs_categories'; ?>

<?php get_header(); ?>

<?php

// Gets every term in this taxonomy
$terms = wp_get_object_terms($post->ID, $taxonomy);
$taxonomy_slug = $terms[0]->slug;
$term_id = get_queried_object()->term_id;
$args = array(
    'post_type' => 'concurs',
    'taxonomy' => $taxonomy,
    'term' => $taxonomy_slug,
);
$args_1 = array(
    'post_type' => 'concurs',
    'taxonomy' => $taxonomy,
    'term' => $taxonomy_slug,
    'orderby' => 'rand',
    'posts_per_page' => 1,
);
//go through each term in this taxonomy one at a time
$custom_loop = new WP_Query($args);
$custom_loop_rand = new WP_Query($args_1);
global $wp_query;
?>
<section class="konkurses bizov-container" id="primary">
    <?php get_sidebar('head-left');?>
    <div class="content-area" style="">
        <main id="main-concurs-<?php echo $post->ID;?>" class="concurses-list concurs-main">
            <div class="header"><span id="head-title"><?php  $tax = $wp_query->get_queried_object();
                    $tax_term = $tax->name;
                    $tax = get_taxonomy($tax->taxonomy);
                    echo "$tax_term";?></span></div>
            <section class="left-part">

                <div class="concurs-header">
                    <?php $bkg = esc_url(get_template_directory_uri()).'/images/bg-konkurs-basic.jpg';?>
                    <div class="overlay-bkg" style=" background-image: url('<?php echo $bkg?>'); background-size: contain; background-position: center top"></div>
                    <label for=""><i class="fas fa-trophy-alt"></i> &nbsp  <b>Конкурс "<?php echo "$tax_term";?>"</b></label>
                    <?php
                    //            if ($custom_loop_rand->have_posts()):
                    while ($custom_loop_rand->have_posts()) : $custom_loop_rand->the_post(); ?>
                        <div class="concurs-random-entry-thumbnail" style="">

                            <?php $post_medium_img = $fr_obj->get_thumbnail(get_the_ID(), 'small');
                            $post_full_img = $fr_obj->get_thumbnail(get_the_ID(), 'full');?>

                            <img style="visibility: visible; max-height: 230px" width="auto" height="auto" src="<?php echo esc_url($post_medium_img);?>"  data-src="<?php echo esc_url($post_full_img);?>" class="fr_lazyload" alt="<?php the_title_attribute();?>">
                            <div style="display: flex; flex-flow: column">
                                <a class="concurs-title" href="<?php get_the_permalink()?>" id=""><?php the_title() ?></a>
                                <a class="concurs-comments_link" href="<?php comments_link(); ?>"> <i class="far fa-pencil"></i>Оставить комментарий</a>

                            </div>
                        </div>

                        <?php
                        wp_reset_postdata();
                    endwhile;
                    //            endif;
                    ?>
                    <span style="font-size: 12px;">В конкурсі можуть брати участь жінки та дівчата, що мешкають у місті</span>
                </div>
                <div class="contest-results">
                    <h4>Результаты конкурса</h4>
                    <span>По результатам пользовательского голосования победили следующие фотографии:</span>
                    <ul class="contest-result-lists">
                        <li id="first-place" class="contest-place">
                            <span class="place-number">1 место</span>
                            <div class="place-thumb">
                                <?php
                                $post = get_post(10184);
                                setup_postdata($post);
                                                          the_content();
                                the_post_thumbnail('contest-result');
                                // the_title('<b>', '</b>');
                                //                          wp_reset_postdata();
                                ?>
                            </div>
                            <div class="place-title">

                                <a class="" href="<?php echo get_the_permalink()?>"><?php the_title();  ?></a>
                                <?php
                                wp_reset_postdata();

                                ?>
                            </div>
                            <div class="prize-descr">
                          <span>
                              	Приз - подарочный сертификат на 200 грн нагородження тут
<?php the_field( 'first_place_description' ); ?>
                          </span>
                            </div>
                        </li>
<!--                        <li id="second-place" class="contest-place">-->
<!--                            <span class="place-number">2 место</span>-->
<!--                            <div class="place-thumb">-->
<!--                                --><?php
//                                $post = get_post(10016);
//                                setup_postdata($post);
//                                //                          the_content();
//                                the_post_thumbnail('contest-result');
//                                //the_title('<b>', '</b>');
//                                //wp_reset_postdata();
//                                ?>
<!--                            </div>-->
<!--                            <div class="place-title">-->
<!--                                <a class="" href="--><?php //echo get_the_permalink()?><!--">--><?php //the_title();  ?><!--</a>-->
<!---->
<!--                                --><?php
//                                wp_reset_postdata();
//
//                                ?>
<!--                            </div>-->
<!--                            <div class="prize-descr">-->
<!--                          <span>-->
<!--                        Приз - подарочный сертификат на 200 грн нагородження тут-->
<!--                              --><?php //the_field( 'second_place_description' ); ?>
<!--                          </span>-->
<!--                            </div>-->
<!---->
<!--                        </li>-->
<!--                        <li id="third-place" class="contest-place">-->
<!--                            <span class="place-number">3 место</span>-->
<!--                            <div class="place-thumb">-->
<!--                                --><?php
//                                $post = get_post(10014);
//                                setup_postdata($post);
//                                //                          the_content();
//                                the_post_thumbnail('contest-result');
//                                //the_title('<b>', '</b>');
//                                //wp_reset_postdata();
//                                ?>
<!--                            </div>-->
<!--                            <div class="place-title">-->
<!--                                <a class="" href="--><?php //echo get_the_permalink()?><!--">--><?php //the_title();  ?><!--</a>-->
<!---->
<!--                                --><?php
//                                wp_reset_postdata();
//                                ?>
<!--                            </div>-->
<!--                            <div class="prize-descr">-->
<!--                          <span>-->
                        <!--                        Приз - подарочный сертификат на 200 грн нагородження тут-->

                        <!--                              --><?php //the_field( 'third_place_description' ); ?>
<!--                          </span>-->
<!--                            </div>-->
<!---->
<!--                        </li>-->
                    </ul>
                </div>

                <h3>Фото участников</h3>
                <div class="contests-list row">
                    <?php
                    if ($custom_loop->have_posts()):
                        while ($custom_loop->have_posts()) : $custom_loop->the_post(); ?>
                            <div class="concurs-entry-thumbnail col-md-4" style="">
                                <div class="concurs-image">
                                    <?php $post_medium_img = $fr_obj->get_thumbnail(get_the_ID(), 'small');
                                    $post_full_img = $fr_obj->get_thumbnail(get_the_ID(), 'full');?>
                                    <img style="visibility: visible; max-height: 250px; max-width: 210px;" width="auto" height="auto" src="<?php echo esc_url($post_medium_img);?>"  data-src="<?php echo esc_url($post_full_img);?>" class="fr_lazyload" alt="<?php the_title_attribute();?>">
                                </div>
                                <a class="concurs-title" href="<?php echo get_the_permalink()?>"><?php the_title(); ?></a>
                                <a class="concurs-comments_link" href="<?php comments_link(); ?>"><i class="far fa-pencil"></i> Оставить комментарий</a>
                                <?php $comments = wp_count_comments($post->ID);
                                ?>
                            </div>
                            <?php
                            wp_reset_postdata();
                        endwhile;
                    endif;
                    ?>
                    <div id="concurs-rules" class="">
                        <label for=""><b>Этапы конкурса</b></label>
                        <section class="contest-stages">
                            <table width="690px" cellpadding="0" cellspacing="0" border="0">
                                <tbody><tr>
                                    <td height="88">
                                        <table style="width:100%; height: 103px; background-color: #ededed;">
                                            <tbody><tr>
                                                <td style="width:190px" class="timelineLeftBorder">
                                                    <div class="" style="vertical-align: middle; display: table-cell; width: 190px;">
                                                        <table style="margin: 0 auto;">
                                                            <tbody><tr>
                                                                <td class="timelineFirst"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div style="color: red; margin-left:55px;font-style: italic;">
                                           <span>с 02 Июн 2015 <br>
                                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;по 26 Июн 2015</span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody></table>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="timelineSplitter"></div>
                                                </td>
                                                <td style="width:190px">
                                                    <div class="" style="vertical-align: middle; display: table-cell; width: 190px;">
                                                        <table style="margin: 0 auto;">
                                                            <tbody><tr>
                                                                <td class="timelineSecond"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div style="color: red; margin-left:62px;font-style: italic;">
                                           <span>с 27 Июн 2015 <br>
                                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;по 05 Июл 2015</span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody></table>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="timelineSplitter"></div>
                                                </td>
                                                <td style="width:190px" class="timelineRightBorder">
                                                    <div class="timelineActive" style="vertical-align: middle; display: table-cell; width: 190px;">
                                                        <table style="margin: 12px 12px 12px 6px;">
                                                            <tbody><tr>
                                                                <td class="timelineThird"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div style="color: red; margin-left:57px;font-style: italic;">
                                                                        <span>06 Июл 2015<br>&nbsp;</span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody></table>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background-image: url('http://priluki.in.ua/skin/index/img/contest/big_rounded_bg.gif');background-position: top left;background-repeat: repeat-y;">
                                        <div style="padding: 12px;font-size: 14px;" align="center">

                                            <p><span style="color: #cc1c24;font-size: 20px;">Определение победителей и вручение призов</span></p>

                                        </div>
                                    </td>
                                </tr>
                                <tr><td height="6"><img src="http://priluki.in.ua/skin/index/img/contest/big_rounded_footer.gif" width="690px" height="6"></td></tr>
                                </tbody></table>
                        </section>
                    </div>
                </div>
                <div class="contests-like-cat" style="margin-bottom: 10px">
                    <label for="tax-link">Нравиться конкурс? Приглашай друзей!</label>
                    <div class="like-content">
                        <b>Постоянный адрес конкурса   "<?php echo $taxonomy_slug?>"</b><br>
                        <input id="tax-link" type="text" value="<?php echo get_term_link($term_id, $taxonomy);?>" style="width: 330px">
                    </div>
                    <!--    --><?php //get_sidebar('comments');?>

                </div>
                <?php echo do_shortcode('[TheChamp-Sharing total_shares="ON"]') ?>
                <?php echo do_shortcode('[TheChamp-FB-Comments style="background-color:lightgreen;"]') ?>

                <div class="comments-wrapper section-inner">

                    <?php comment_form(); ?>

                </div><!-- .comments-wrapper -->
            </section>
            <?php get_sidebar('right-concurs');?>
        </main>
    </div>
</section>

<?php get_footer() ?>
