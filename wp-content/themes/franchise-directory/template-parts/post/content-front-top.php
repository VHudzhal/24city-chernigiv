<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 17.07.2020
 * Time: 14:56
 */
?>
<div class=" front-page-carousel front-carousel">
    <?php if (have_posts()):
        while (have_posts()) : the_post() ?>
            <?php the_content(); ?>
        <?php
        endwhile;
    endif;
    ?>
</div>
