<?php acf_form_head(); ?>
<?php
get_header();
$fr_obj = New FranchiseClass();

?>
	<section id="primary" class="content-area bizov-container">
        <div class="content-area">
            <?php get_sidebar('left-main');?>
		<main id="main" class="site-main">
            <div class="header"><span id="head-title"><?php the_title()?></span></div>

            <div class="content">
    <script id="bx24_form_inline" data-skip-moving="true">
        (function(w,d,u,b){w['Bitrix24FormObject']=b;w[b] = w[b] || function(){arguments[0].ref=u;
            (w[b].forms=w[b].forms||[]).push(arguments[0])};
            if(w[b]['forms']) return;
            var s=d.createElement('script');s.async=1;s.src=u+'?'+(1*new Date());
            var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
        })(window,document,'https://b24-85edjg.bitrix24.ua/bitrix/js/crm/form_loader.js','b24form');

        b24form({"id":"6","lang":"ua","sec":"7ksbti","type":"inline"});
    </script>
			<?php

//			/* Start the Loop */
//			while ( have_posts() ) :
//				the_post();
//
////				get_template_part( 'template-parts/content/content', 'single' );
//
////				// If comments are open or we have at least one comment, load up the comment template.
////				if ( comments_open() || get_comments_number() ) {
////					comments_template();
////				}
////				acf_form( array(
////					'post_id'      => 'new_post',
////					'post_title'   => 'New Franchise',
////					'field_groups' => array( 192 ), // Create post field group ID(s)
////					'new_post'     => array(
////						'post_type'   => 'franchises',
////						'post_status' => 'publish'
////					),
////					'submit_value' => 'Отправить заявку'
////				) );
//			endwhile; // End of the loop.
//			?>
</div>
		</main><!-- #main -->
        </div>
	</section><!-- #primary -->



<?php get_footer(); ?>
