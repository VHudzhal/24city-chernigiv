<?php
/**
 * Template Name: Новая компания во фронт-енде
 *
 * @author Web First Step
 * @link http://web-first-step.ru/new_post_acf_pro/
 * @uses Advanced Custom Fields Pro
 */

/**
 * Добавить  обязательную функцию acf_form_head() в самый верх страницы
 */?>
<?php acf_form_head();?>
<?php get_header();?>
<?php the_post();?>

    <section id="container" class="<?php post_class('company-post') ?>">
        <div id="content" role="main">
            <h1>Создать новую компанию:</h1>

            <?php
            //если пользователь не вошел на сайт
            if ( !( is_user_logged_in()  ) ) {?>
                <center><strong>Только зарегистрированные пользователи могут добавить свой рецепт </strong><br /><br /><br />
                    Пожалуйста, зарегистрируйтесь или войдите.<br /><br /></center>
            <?php  } else {

                $new_post = array(
                    'post_id'            => 'new', // Создать новый пост
                    // ОБЯЗАТЕЛЬНО ПОМЕНЯЙТЕ ID ПОЛЕЙ НА СВОИ
                    'field_groups'       => array(3990), // Группы полей для создания поста
                    'form'               => true,
                    'new_post' => array(
                    'post_type' => 'company',
                    'post_status' => 'publish' // You may use other post statuses like draft, private etc.
                ),
                    'return'             => '%post_url%', // Переадресация на url созданного поста
                    'html_before_fields' => '',
                    'html_after_fields'  => '',
                    'submit_value'       => 'Добавить',
                    'updated_message'    => 'Сохранено!!!'
                );
                acf_form( $new_post );
            }
//            the_content();
            ?>

        </div><!-- #content -->
        <?php //get_sidebar(); ?>
    </section><!-- #container -->

<?php
get_footer();
?>





<?php if ( have_rows( 'graphic' ) ) : ?>
    <?php while ( have_rows( 'graphic' ) ) : the_row(); ?>
        <?php if ( have_rows( 'monday' ) ) : ?>
            <?php while ( have_rows( 'monday' ) ) : the_row(); ?>
                <?php if ( have_rows( 'monday_day' ) ) : ?>
                    <?php while ( have_rows( 'monday_day' ) ) : the_row(); ?>
                        <?php echo '<div id="Monday" class="day1">';
                        echo '<div class="day-val">'
                        ?>
                        <h5>Пн</h5>
                        <?php // on_graphic
                        $field = get_sub_field_object( 'on_graphic' );
                        $value = $field['value'];
                        $choices = $field['choices'];
                        if ( $value ):
                            foreach ( $value as $v ):
                                echo $choices[ $v ];
                            endforeach;
                        endif; ?>
                    <?php  echo '<div class="daycontent">'; ?>
                        <?php the_sub_field( 'monday_from' ); ?>
                        <?php the_sub_field( 'monday_to' ); ?>
                        <?php
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';?>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php if ( have_rows( 'monday_lunch' ) ) : ?>
                    <?php while ( have_rows( 'monday_lunch' ) ) : the_row(); ?>
                        <?php // on_lunch
                        $field = get_sub_field_object( 'on_lunch' );
                        $value = $field['value'];
                        $choices = $field['choices'];
                        if ( $value ):
                            foreach ( $value as $v ):
                                echo $choices[ $v ];
                            endforeach;
                        endif; ?>
                        <?php the_sub_field( 'monday_from_lunch' ); ?>
                        <?php the_sub_field( 'monday_lunch_to' ); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
        <?php if ( have_rows( 'tuesday' ) ) : ?>
            <?php while ( have_rows( 'tuesday' ) ) : the_row(); ?>
                <?php if ( have_rows( 'tuesday_day' ) ) : ?>
                    <?php while ( have_rows( 'tuesday_day' ) ) : the_row(); ?>
                       <?php echo '<div id="Tuesday" class="day2">';
                       echo '<div class="day-val">'
                        ?>
                        <h5>Вт</h5>
                        <?php // on_graphic
                        $field = get_sub_field_object( 'on_graphic' );
                        $value = $field['value'];
                        $choices = $field['choices'];
                        if ( $value ):
                            foreach ( $value as $v ):
                                echo $choices[ $v ];
                            endforeach;
                        endif; ?>
                        <?php  echo '<div class="daycontent">'; ?>
                        <?php the_sub_field( 'tuesday_from' ); ?>
                        <?php the_sub_field( 'tuesday_to' ); ?>
                        <?php
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';?>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php if ( have_rows( 'tuesday_lunch' ) ) : ?>
                    <?php while ( have_rows( 'tuesday_lunch' ) ) : the_row(); ?>
                        <?php // on_lunch
                        $field = get_sub_field_object( 'on_lunch' );
                        $value = $field['value'];
                        $choices = $field['choices'];
                        if ( $value ):
                            foreach ( $value as $v ):
                                echo $choices[ $v ];
                            endforeach;
                        endif; ?>
                        <?php the_sub_field( 'tuesday_from_lunch' ); ?>
                        <?php the_sub_field( 'Tuesday_lunch_to' ); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
        <?php if ( have_rows( 'Wednesday' ) ) : ?>
            <?php while ( have_rows( 'Wednesday' ) ) : the_row(); ?>
                <?php if ( have_rows( 'wednesday_day' ) ) : ?>
                    <?php while ( have_rows( 'wednesday_day' ) ) : the_row(); ?>
<?php echo '<div id="Wednesday" class="day3">';
    echo '<div class="day-val">'
        ?>
        <h5>Ср</h5>
                        <?php // on_graphic ( value )
                        $on_graphic_array = get_sub_field( 'on_graphic' );
                        if ( $on_graphic_array ):
                            foreach ( $on_graphic_array as $on_graphic_item ):
                                echo $on_graphic_item;
                            endforeach;
                        endif; ?>
                        <?php  echo '<div class="daycontent">'; ?>
                        <?php the_sub_field( 'wednesday_from' ); ?>
                        <?php the_sub_field( 'wednesday_to' ); ?>
                        <?php
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';?>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php if ( have_rows( 'wednesday_lunch' ) ) : ?>
                    <?php while ( have_rows( 'wednesday_lunch' ) ) : the_row(); ?>
                        <?php // on_lunch ( value )
                        $on_lunch_array = get_sub_field( 'on_lunch' );
                        if ( $on_lunch_array ):
                            foreach ( $on_lunch_array as $on_lunch_item ):
                                echo $on_lunch_item;
                            endforeach;
                        endif; ?>
                        <?php the_sub_field( 'wednesday_from_lunch' ); ?>
                        <?php the_sub_field( 'wednesday_lunch_to' ); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
        <?php if ( have_rows( 'thursday' ) ) : ?>
            <?php while ( have_rows( 'thursday' ) ) : the_row(); ?>
                <?php if ( have_rows( 'thursday_day' ) ) : ?>
                    <?php while ( have_rows( 'thursday_day' ) ) : the_row(); ?>

                        <?php
                        echo '<div id="Thursday" class="day4">';
                        echo '<div class="day-val">'
                        ?>
                        <h5>Чт</h5>
                    <?php
                        // on_graphic
                        $field = get_sub_field_object( 'on_graphic' );
                        $value = $field['value'];
                        $choices = $field['choices'];
                        if ( $value ):
                            foreach ( $value as $v ):
                                echo $choices[ $v ];
                            endforeach;
                        endif; ?>
<?php echo '<div class="daycontent">';?>

    <?php the_sub_field( 'thursday_from' ); ?>
                        <?php the_sub_field( 'thursday_to' ); ?>
                        <?php
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';?>

                    <?php endwhile; ?>
                <?php endif; ?>
                <?php if ( have_rows( 'thursday_lunch' ) ) : ?>
                    <?php while ( have_rows( 'thursday_lunch' ) ) : the_row(); ?>
                        <?php // on_lunch
                        $field = get_sub_field_object( 'on_lunch' );
                        $value = $field['value'];
                        $choices = $field['choices'];
                        if ( $value ):
                            foreach ( $value as $v ):
                                echo $choices[ $v ];
                            endforeach;
                        endif; ?>
                        <?php the_sub_field( 'thursday_from_lunch' ); ?>
                        <?php the_sub_field( 'thursday_lunch_to' ); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
        <?php if ( have_rows( 'friday' ) ) : ?>
            <?php while ( have_rows( 'friday' ) ) : the_row(); ?>
                <?php if ( have_rows( 'friday_day' ) ) : ?>
                    <?php while ( have_rows( 'friday_day' ) ) : the_row(); ?>
<?php echo '<div id="Friday" class="day5">';
    echo '<div class="day-val">';
        ?>
        <h5>Пт</h5>
                        <?php // on_graphic
                        $field = get_sub_field_object( 'on_graphic' );
                        $value = $field['value'];
                        $choices = $field['choices'];
                        if ( $value ):
                            foreach ( $value as $v ):
                                echo $choices[ $v ];
                            endforeach;
                        endif; ?>
    <?php echo '<div class="daycontent">';?>

        <?php the_sub_field( 'friday_from' ); ?>
                        <?php the_sub_field( 'friday_to' ); ?>
                        <?php
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';?>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php if ( have_rows( 'friday_lunch' ) ) : ?>
                    <?php while ( have_rows( 'friday_lunch' ) ) : the_row(); ?>
                        <?php // on_lunch
                        $field = get_sub_field_object( 'on_lunch' );
                        $value = $field['value'];
                        $choices = $field['choices'];
                        if ( $value ):
                            foreach ( $value as $v ):
                                echo $choices[ $v ];
                            endforeach;
                        endif; ?>

                        <?php the_sub_field( 'friday_from_lunch' ); ?>
                        <?php the_sub_field( 'friday_lunch_to' ); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
        <?php if ( have_rows( 'saturday' ) ) : ?>
            <?php while ( have_rows( 'saturday' ) ) : the_row(); ?>
                <?php if ( have_rows( 'saturday_day' ) ) : ?>
                    <?php while ( have_rows( 'saturday_day' ) ) : the_row(); ?>
<?php echo '<div id="Saturday" class="day6">';
    echo '<div class="day-val">';
        ?>
        <h5>Сб</h5>
                        <?php // on_graphic
                        $field = get_sub_field_object( 'on_graphic' );
                        $value = $field['value'];
                        $choices = $field['choices'];
                        if ( $value ):
                            foreach ( $value as $v ):
                                echo $choices[ $v ];
                            endforeach;
                        endif; ?>
                        <?php echo '<div class="daycontent">';?>

                        <?php the_sub_field( 'saturday_from' ); ?>
                        <?php the_sub_field( 'tuesday_to' ); ?>
                        <?php
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';?>

                    <?php endwhile; ?>
                <?php endif; ?>
                <?php if ( have_rows( 'saturday_lunch' ) ) : ?>
                    <?php while ( have_rows( 'saturday_lunch' ) ) : the_row(); ?>
                        <?php // on_lunch
                        $field = get_sub_field_object( 'on_lunch' );
                        $value = $field['value'];
                        $choices = $field['choices'];
                        if ( $value ):
                            foreach ( $value as $v ):
                                echo $choices[ $v ];
                            endforeach;
                        endif; ?>
                        <?php the_sub_field( 'saturday_from_lunch' ); ?>
                        <?php the_sub_field( 'saturday_lunch_to' ); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
        <?php if ( have_rows( 'sunday' ) ) : ?>
            <?php while ( have_rows( 'sunday' ) ) : the_row(); ?>
                <?php if ( have_rows( 'sunday_day' ) ) : ?>
                    <?php while ( have_rows( 'sunday_day' ) ) : the_row(); ?>
<?php echo '<div id="Sunday" class="day7">';
    echo '<div class="day-val">';

        ?>
        <h5>Вс</h5>
                        <?php // on_graphic
                        $field = get_sub_field_object( 'on_graphic' );
                        $value = $field['value'];
                        $choices = $field['choices'];
                        if ( $value ):
                            foreach ( $value as $v ):
                                echo $choices[ $v ];
                            endforeach;
                        endif; ?>
                        <?php echo '<div class="daycontent">';?>
                        <?php the_sub_field( 'sunday_from' ); ?>
                        <?php the_sub_field( 'sunday_to' ); ?>
                        <?php
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';?>

                    <?php endwhile; ?>
                <?php endif; ?>
                <?php if ( have_rows( 'sunday_lunch' ) ) : ?>
                    <?php while ( have_rows( 'sunday_lunch' ) ) : the_row(); ?>
                        <?php // on_lunch
                        $field = get_sub_field_object( 'on_lunch' );
                        $value = $field['value'];
                        $choices = $field['choices'];
                        if ( $value ):
                            foreach ( $value as $v ):
                                echo $choices[ $v ];
                            endforeach;
                        endif; ?>
                        <?php the_sub_field( 'sunday_from_lunch' ); ?>
                        <?php the_sub_field( 'sunday_lunch_to' ); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>
