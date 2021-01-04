<?php
/**
 * The template for displaying the footer
 */

wp_footer(); ?>
<footer class="footer fixed_block_stop">
    <section class="foot-block bizov-container">
        <div id="top-footer">
            <div id="left-foot" class="foot">
                <h5 class="foot-title">Разделы</h5>
                <?php wp_nav_menu(array(
                    'container' => 'div',
                    'theme_location' => 'foot-left',
                    'menu_id' => 'foot-left-menu',
                    'menu_class' => 'nav-foot-link',
                    'depth' => 1,
                ));
                ?>
            </div>
            <div id="right-foot" class="foot">
                <h5 class="foot-title">Мой сайт</h5>
                <?php wp_nav_menu(array(
                    'container' => 'div',
                    'theme_location' => 'foot-right',
                    'menu_id' => 'foot-right-menu',
                    'menu_class' => 'nav-foot-link',
                    'depth' => 1,
                ));
                ?>
                <button class="btn btn-success" data-toggle="modal" data-target="#footerModal">Служба поддержки</button>

                <div class="modal fade" id="footerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document" style="max-width: 70%; top: 20%; padding: 20px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><strong>Служба поддержки</strong></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <h5 style="padding: 5px 17px">Выберите удобный для себя способ связи</h5>

                            <div class="modal-body">
                                <section class="contacts-group">
                                    <div class="contact-block" id="free-calls">
                                        <div class="col">
                                            <strong>8 800 123-45-67</strong>
                                            <h6>Для бесплатных звонков</h6>
                                        </div>
                                    </div>
                                    <div class="contact-block" id="inter-calls">
                                        <div class="col">
                                            <strong>+38 (012) 345-67-89</strong>
                                            <h6>Для международных звонков</h6>
                                        </div>
                                    </div>
                                </section>
                                <section class="contacts-group">
                                    <div class="contact-block" id="graphic">
                                        <div>
                                            <h5><strong>9:00 &nbsp; - &nbsp; 18:00 </strong></h5>
                                            <h6>Понедельник - Пятница</h6>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="" class="foot">
                <h5 class="foot-title">Соцсети</h5>
                <?php wp_nav_menu(array(
                    'container' => 'div',
                    'theme_location' => 'foot-soc',
                    'menu_id' => 'foot-social-menu',
                    'menu_class' => 'nav-foot-link',
                    'depth' => 1,
                ));
                ?>
            </div>

        </div>
    </section>
    <style type="text/css">

    </style>
    <div class="foot-modals-group" style="">
        <a class="btn btn-default" id="btn"><i class="fas fa-2x fa-pencil-alt"></i></a>
        <ul class="foot-buttons-group" style="">
            <li class="foot-item">
                <div class="foot-item-title">
                <span>Добавить новость</span><div class="triangle-left"></div>
                </div>
                    <a href="https://24city.cn.ua/sozdat-novost/" class="btn btn-default" value="Добавить новость" placeholder="Search" alt="Добавить новость" >
                    <i class="fas fa-2x fa-bullhorn"></i>
                </a>
            </li>
            <li class="foot-item">
                <div class="foot-item-title">
                    <span>Добавить акцию</span><div class="triangle-left"></div>
                </div>
                <a href="https://24city.cn.ua/dobavit-akciyu/" class="btn btn-default" value="Добавить акцию" ><i class="fas fa-2x fa-meteor"></i></a>
            </li>
            <li class="foot-item">
                <div class="foot-item-title">
                    <span>Добавить компанию</span><div class="triangle-left"></div>
                </div>
                <a href="https://24city.cn.ua/moya-kompaniya/" class="btn btn-default" value="Добавить компанию"><i class="fas fa-2x fa-address-card"></i></a>
            </li>
            <li class="foot-item">
                <div class="foot-item-title">
                    <span>Добавить обьявление</span><div class="triangle-left"></div>
                </div>
                <a href="https://24city.cn.ua/sozdat-obyavlenie/" class="btn btn-default" value="Добавить обьявление"><i class="fas fa-2x fa-comment-plus"></i></a>
            </li>

        </ul>
    </div>
</footer>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

<!-- FB -->
<script type="text/javascript" src="http://userapi.com/js/api/openapi.js?34"></script>

<!-- VK -->
<script type="text/javascript">
  //VK.init({apiId: , onlyWidgets: true});
</script>
<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6AL5TEsQqnTIa-xpYm6hK2CK587giyqM&callback=initMap"-->
<!--        type="text/javascript"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
</body>
</html>
