<?php
$fr_obj = New FranchiseClass();

?>
<div class="header-mob"><span id="head-title"><?php the_title()?></span></div>

<article id="post-<?php the_ID(); ?>" <?php post_class('consult-post'); ?> style="">
<div class="public-content" style="">
    <header class="entry-header">
        <div class="entry-title">
           <a href="<?php the_permalink();?>"> <?php the_title('<h3>','</h3>');?></a>
        </div>
    </header>
    <hr>
    <div class="entry-thumbnail" style="">

        <?php
        $post_medium_img = $fr_obj->get_thumbnail(get_the_ID(), 'medium');
        $post_full_img = $fr_obj->get_thumbnail(get_the_ID(), 'full');?>

        <img style="visibility: visible" src="<?php echo esc_url($post_medium_img);?>"  data-src="<?php echo esc_url($post_full_img);?>" class="fr_lazyload" alt="<?php the_title_attribute();?>">

    </div>

    <div class="entry-content">            <?php the_excerpt(); ?></div>

</div>

</article>
