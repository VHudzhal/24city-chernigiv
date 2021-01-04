<?php
/*
 * The sidebar containing the main widget area
 */

 if ( is_active_sidebar( 'sidebar-3' ) || dynamic_sidebar('sidebar-3') ) : ?>

 <?php
 return;
 endif;?>

<aside class="widget" id="right-sidebar" style="">
    <div id="right-sidebar-content" style="">
   <div id="sidebar-block-person">
 <?php
 dynamic_sidebar('sidebar-3');

 if (is_single()):
                echo get_avatar(get_the_author_meta('ID'), 55);
//                echo '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'">Link</a>';
                echo do_shortcode('[user archive-link]');
                endif;
                ?>
        <button class="btn btn-success" data-toggle="modal" data-target="#send-application">
            Запросить финплан
        </button>
        <div class="modal fade" id="send-application" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Запросить план франшизы</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea name="" id="" cols="30" rows="5">Заинтересовала ваша франшиза! Вышлите на почту бизнес-план и подробную информацию о франшизе.
                        </textarea>
                        <?php echo do_shortcode("[contact-form-7 id='1002' title='Отправить заявку']"); ?>
                    </div>
                </div>
            </div>
        </div>
   </div>
    </div>
    <style type="text/css">
        a#banner div{
            background:  url(http://bizov.com.ua/wp-content/uploads/2020/02/БЛЕЭСТ-банер-360х360.gif);
            background-repeat: no-repeat;
            background-position: top;
            background-size: contain;
            display: flex;
            width: auto;
            height: 100%;
            min-height: 230px;
        }
    </style>
    <a id="banner" href="http://map.cn.ua/info/7045/"   redirect><div></div></a>
</aside>

