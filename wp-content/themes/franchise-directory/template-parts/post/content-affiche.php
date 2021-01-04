<?php
$fr_obj = New FranchiseClass();

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('affiche-post'); ?> style="">
<div class="public-content" style="">
    <div class="header"><span id="head-title"><?php the_title()?></span></div>
    <div class="entry-thumbnail" style="">
        <?php //$post_medium_img = $fr_obj->get_thumbnail(get_the_ID(), 'small');
        //$post_full_img = $fr_obj->get_thumbnail(get_the_ID(), 'full');?>
<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
//echo $thumb_url[0];
?>
<img src="<?php echo $thumb_url[0];?>" width="250px">
    </div>

    <div class="entry-content">
        <?php the_content('more'); ?>
    </div>

</div>

</article>
