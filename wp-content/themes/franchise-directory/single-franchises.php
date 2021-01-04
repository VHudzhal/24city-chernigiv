<?php
/*
 * The template for displaying all single posts
 */

get_header();

?>
<style type="text/css">
    .fixed {
        position: fixed;
        z-index: 99;
        bottom: 0;
    }

    .absolute {
        position: absolute;
        z-index: 99;
    }
</style>
    <section id="primary" class="bizov-container row" style="">
        <?php get_sidebar('head-left');?>
        <div class="content-area" style="">
            <?php   get_sidebar('left-main');?>
        <div class="franchise-content col-lg-9 col-md-12 col-xs-12 col-sm-12">
            <div class="franchise" style="">
                <div class="header"><span id="head-title"><?php the_title()?></span></div>
                <article id="main" class="site-main" style="">
                    <div class="content container" style="">
                        <div class="publication-franchise-layout">

                            <ul id="content">
                                <li>
                                    <?php //the_field('slider'); ?>
                                </li>


                                <li><h1>Франшиза <?php //the_field('franchise_name'); ?></h1></li>

                                <li class="invest" style="color: #00b4f0;"><h2><strong>Инвестиции <?php the_field('price_min');
                                        echo '  -  ';
                                            the_field('price_max'); ?></strong></h2></li>
                                <li id="buttons-group">
 <!-- Button trigger modal -->
                                            <a class="link-text" id="share-link" data-toggle="modal" data-target="#shareModal">
                                                <i class="fal fa-share" style="color: gainsboro;"></i> Поделиться
                                            </a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="shareModal" tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title" id="exampleModalLabel">
                                                                <b>Расскажите друзьям об этой франшизе</b>
                                                            </h1>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <span id="page-link"><?php echo get_page_link(); ?></span>
                                                            <button class="copy_link" onclick="copytext('#page-link')"><i class="far fa-share"></i>Скопировать ссылку</button>
                                    <?php get_sidebar('share-group');?>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                                            </button>
                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                </li>
<!--                                        <li>--><?php //echo do_shortcode('[likebtn lang="ru" addthis_service_codes="vk,odnoklassniki_ru,twitter,facebook,preferred_1,preferred_2,preferred_3,compact"]')?><!--</li>-->

<!--                                    </li>-->
<!--                                    </ul>-->
                                <li>
                                    <ul id="links-group">
                                        <li><a href="#about"><div class="link-text">О компании</div></a></li>
                                        <li><a href="#descr"><div class="link-text">Описание</div></a></li>
                                        <li><a href=""><div class="link-text">Адреса</div></a></li>
                                    </ul>
                                </li>
                                <li id="side-bar-mob">
                                    <?php get_sidebar('right-mob');?>
                                </li>
                                <li><div id="about"><h1><strong>О компании </strong></h1><hr><?php the_field('description'); ?></div></li>
                            </ul>

                        </div>
                        <div class="public-franchise-content">
                            <?php the_content(); ?>

                        </div>
                        <?php if(function_exists('the_ratings')) { the_ratings(); } ?>

                    </div>
                </article>
                <?php

                ?>
            </div>

        </div>
        <div id="right-bar" style="width: max-content">
        <?php get_sidebar('right'); ?>
        </div>
        </div>
    </section>

<?php
get_footer();
