<?php
/*
 * The template for displaying all single posts
  Template Name: My Concurs Single
  Template Post: post
 */
$fr_obj = New FranchiseClass();

$taxonomy = 'konkurs_categories';
$terms = wp_get_object_terms($post->ID, $taxonomy);
$taxonomy_slug = $terms[0]->slug;
$term_id = get_queried_object()->term_id;
$post_ids = get_objects_in_term($terms[0]->term_id, $taxonomy);
$post = get_post($post_id);
$args = array(
    'post_type' => 'concurs',
    'taxonomy' => $taxonomy,
);
global $wp_query;
?>
<section class="left-part">
    <div class="concurs-header">
        <?php $bkg = esc_url(get_template_directory_uri()) . '/images/bg-konkurs.jpg'; ?>
        <?php echo '<div class="overlay-bkg" style=" background-image: url(' . $bkg . ');"></div>'; ?>
        <label for=""><i class="fas fa-trophy-alt"></i> &nbsp <b>Конкурс "<?php echo "$taxonomy_slug"; ?>"</b></label>
        <div class="concurs-single-entry-thumbnail" style="">

            <?php $post_medium_img = $fr_obj->get_thumbnail(get_the_ID(), 'small');
            $post_full_img = $fr_obj->get_thumbnail(get_the_ID(), 'full'); ?>
            <div class="concurs-image">
                <img style="visibility: visible; max-height: 470px" width="auto" height="auto"
                     src="<?php echo esc_url($post_medium_img); ?>" data-src="<?php echo esc_url($post_full_img); ?>"
                     class="fr_lazyload" alt="<?php the_title_attribute(); ?>">
            </div>
            <?php the_title('<span class="concurs-title">', '</span>'); ?>
            <div class="zoom-in-photo">
                <a style="background: none; border: none; display: flex;"><i class="fas fa-search-plus"
                                                                             style="color: black"></i><h5>Увеличить
                        фото</h5></a>
                <div class="modal-dialog modal-dialog-scrollable" id="imagemodal" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-content">
                        <div class="modal-header">
                        </div>
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal"><span
                                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <img src="" class="imagepreview" style="width: 100%;" alt="<?php the_title_attribute(); ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contest-votes">
                <span>Текущая оценка</span>
                <div class="sv_container">
                    <?php
                    the_content();
                                        echo do_shortcode('[social_votes]');

                    //echo getPostLikeLink(get_the_ID());
                    //                    if (have_posts()):
                    //                    while (have_posts()) : the_post();
                    //the_excerpt();
                    //                                            wp_reset_postdata();
                    //                    endwhile;
                    //                    endif;
                    ?>
                </div>
                <?php get_sidebar('comm');
                //echo get_comments_link();
                ?>
            </div>
        </div>


    </div>
    <label for=""> Другие фото участников</label>

    <div id="posts-carousel" class="concurs-2">
        <?php
        $customTaxonomyTerms = wp_get_object_terms($post->ID, $taxonomy, array('fields' => 'ids'));
        $args_1 = array(
            'post_type' => 'concurs',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'rand',
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field' => 'id',
                    'terms' => $customTaxonomyTerms
                )
            ),
            'post__not_in' => array($post->ID),
        );

        //the query
        $relatedPosts = new WP_Query($args_1);

        //loop through query
        if ($relatedPosts->have_posts()) { ?>
            <?php while ($relatedPosts->have_posts()) {
                $relatedPosts->the_post();
                ?>
                <div class="">
                    <?php $post_medium_img = $fr_obj->get_thumbnail(get_the_ID(), 'small');
                    $post_full_img = $fr_obj->get_thumbnail(get_the_ID(), 'full'); ?>
                    <img style="visibility: visible; max-height: 470px" width="100" height="100"
                         src="<?php echo esc_url($post_medium_img); ?>"
                         data-src="<?php echo esc_url($post_full_img); ?>"
                         alt="<?php the_title_attribute(); ?>">
                </div>
                <?php
            }
            //restore original post data
            wp_reset_postdata();
        }
        ?>

    </div>

    <section class="contest-shares-block">
        <div class="contest-datas">
            <label id="contest-author" for="">Разместила: <b><?php echo get_the_author(); ?></b></label>
            <label id="contest-date" for="">Опубликовано: <b><?php echo get_the_date(); ?></b></label>
            <label for=""><b><?php echo do_shortcode('[post-views]') ?></b></label>
        </div>
        <div class="contests-like">
            <div class="address-content">
                <label>Постоянный адрес фото</label><br>
                <input id="tax-link" type="text" value="<?php echo get_the_post_thumbnail_url($post_id) ?>"
                       style="width: 330px">
            </div>
            <div class="share-content">
                <label for="tax-link"><b>Нравиться? Поделись с друзьями!</b></label>
                <?php echo do_shortcode('[TheChamp-Sharing total_shares="ON"]') ?>
            </div>
        </div>
    </section>
    <div id="photo-likes">
        <label for=""><b>Вам нравиться фото"<?php the_title(); ?>"?</b>
        </label>
        <span>Жмите Нравиться, "Тweet" или "+1" </span>

        <?php echo do_shortcode('[TheChamp-Counter style="background-color:#fff;"]') ?>
    </div>
    <?php echo do_shortcode('[TheChamp-FB-Comments style="background-color:lightgreen;"]') ?>
    <div id="concurs-rules" class="">
        <label for=""><b>Этапы конкурса</b></label>
        <section class="contest-stages">
            <table width="690px" cellpadding="0" cellspacing="0" border="0">
                <tbody>
                <tr>
                    <td height="88">
                        <table style="width:100%; height: 103px; background-color: #ededed;">
                            <tbody>
                            <tr>
                                <td style="width:190px" class="timelineLeftBorder">
                                    <div class="" style="vertical-align: middle; display: table-cell; width: 190px;">
                                        <table style="margin: 0 auto;">
                                            <tbody>
                                            <tr>
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
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                                <td>
                                    <div class="timelineSplitter"></div>
                                </td>
                                <td style="width:190px">
                                    <div class="" style="vertical-align: middle; display: table-cell; width: 190px;">
                                        <table style="margin: 0 auto;">
                                            <tbody>
                                            <tr>
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
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                                <td>
                                    <div class="timelineSplitter"></div>
                                </td>
                                <td style="width:190px" class="timelineRightBorder">
                                    <div class="timelineActive"
                                         style="vertical-align: middle; display: table-cell; width: 190px;">
                                        <table style="margin: 12px 12px 12px 6px;">
                                            <tbody>
                                            <tr>
                                                <td class="timelineThird"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div style="color: red; margin-left:57px;font-style: italic;">
                                                        <span>06 Июл 2015<br>&nbsp;</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="background-image: url('http://priluki.in.ua/skin/index/img/contest/big_rounded_bg.gif');background-position: top left;background-repeat: repeat-y;">
                        <div style="padding: 12px;font-size: 14px;" align="center">

                            <p>
                                <span style="color: #cc1c24;font-size: 20px;">Определение победителей и вручение призов</span>
                            </p>

                        </div>
                    </td>
                </tr>
                <tr>
                    <td height="6"><img src="http://priluki.in.ua/skin/index/img/contest/big_rounded_footer.gif"
                                        width="690px" height="6"></td>
                </tr>
                </tbody>
            </table>
        </section>
    </div>
    <div class="comments-wrapper section-inner">

        <?php
        echo do_shortcode('[ratemypost]');
        echo do_shortcode('[ratemypost-result]');

        //comment_form(); ?>

    </div><!-- .comments-wrapper -->
</section>
<?php //get_sidebar('right-concurs');?>
