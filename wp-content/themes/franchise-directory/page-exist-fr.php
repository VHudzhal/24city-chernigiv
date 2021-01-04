<?php get_header();
?>
<!--<div style="background-color: white">-->
<?php
//if (function_exists('dimox_breadcrumbs'))
//    dimox_breadcrumbs();
//?>
<!--</div>-->
<!--<div style="background-color: white; display: flex; flex-flow: row; justify-content: space-between">-->
<!---->
<!--<div style="display: flex; flex-flow: column; flex: 0 0 70%">-->
<!--<h1 id="service-title" style="">Реклама уже зарегистрированной франшизы на портале</h1>-->
<!--<h5>Выберите подходящее для себя предложение</h5>-->
<!--</div>-->
<!--    <div style="background-color: lightgrey; padding: 5px 15px;display: flex; width: 20%; margin-right: 40px">-->
<!--    <a style="background-color: white; border-radius: 100px; padding: 13px 16px; color: black; width: 60px; height: 60px; margin-right: 15px" href="http://bizov.com.ua/wp-content/uploads/2019/10/Уильямс-Б.-Дэмстра-Д.-Стэрн-Х.-WordPress-для-профессионалов-Для-профессионалов-2014.pdf" target="_blank"><i class="fa fa-file-pdf-o fa-2x"></i></a>-->
<!--    <a href="http://bizov.com.ua/wp-content/uploads/2019/10/Уильямс-Б.-Дэмстра-Д.-Стэрн-Х.-WordPress-для-профессионалов-Для-профессионалов-2014.pdf" target="_blank">Скачать комерческое предложение</a>-->
<!--    </div>-->
<!--    </div>-->
<div>
    <?php get_template_part('category', 'services-list');?>
</div>
<?php
get_footer();
