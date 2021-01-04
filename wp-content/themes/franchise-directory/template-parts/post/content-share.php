<?php
$fr_obj = New FranchiseClass();
//global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('share-post'); ?> style="">
<div class="public-content" style="">
    <div class="header"><span id="head-title"><?php the_title()?></span></div>
    <div class="entry-content">
        <?php the_content();?>
    </div>

</div>

</article>
