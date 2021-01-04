<?php
$fr_obj = New FranchiseClass();

?>
<style>




</style>
<article id="post-<?php the_ID(); ?>" <?php post_class('one-post'); ?> style="">
<div class="public-content" style="">
    <div class="header-mob"><span id="head-title"><?php the_title()?></span></div>

    <div class="entry-thumbnail" style="">

        <?php $post_medium_img = $fr_obj->get_thumbnail(get_the_ID(), 'small');
        $post_full_img = $fr_obj->get_thumbnail(get_the_ID(), 'full');?>

        <img style="visibility: visible" src="<?php echo esc_url($post_medium_img);?>"  data-src="<?php echo esc_url($post_full_img);?>" class="fr_lazyload" alt="<?php the_title_attribute();?>">

    </div>
    <header class="entry-header">
        <div class="breadcrumbs" typeof="breadcrumbList" vocab="http://schema.org"><?php
            if (function_exists('dimox_breadcrumbs'))
                dimox_breadcrumbs();
            ?>
        </div>
        <div class="entry-title">
        <?php the_title('<h3>','</h3>');?>
        </div>
    </header>

</div>
    <div class="entry-content">            <?php the_content(); ?></div>

</article>
