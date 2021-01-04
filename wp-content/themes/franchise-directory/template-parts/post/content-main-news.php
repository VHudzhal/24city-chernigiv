<?php
$fr_obj = New FranchiseClass();
global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('mainnews-post'); ?> style="">
<div class="public-content" style="">
    <div class="header"><span id="head-title"><?php the_title()?></span></div>
<?php if ( has_post_thumbnail() ) {
?>
			<div class="entry-thumbnail" style="padding: 6px;">
                            <?php $post_medium_img = $fr_obj->get_thumbnail(get_the_ID(), 'small');
                            $post_full_img = $fr_obj->get_thumbnail(get_the_ID(), 'full');?>
                            <img class="thumb-img" style="visibility: visible" width="100%" height="100%" src="<?php echo esc_url($post_medium_img);?>"  data-src="<?php echo esc_url($post_full_img);?>" class="fr_lazyload" alt="<?php the_title_attribute();?>" style="max-width: 150px">
                        </div>
		 <?php
				}?>
    <div class="entry-content">
        <?php the_content();
        get_post_gallery_images($post->ID)?>
    </div>

</div>

</article>
