<?php
$fr_obj = New FranchiseClass();

?>

<li class="line-content" style="">
                        <table class="company-excerpt" cellpadding="0" cellspacing="0" border="0" width="680">
                            <tbody><tr>
                            <!--Company description begin-->
                            <td class="descr-company " style="" colspan="0">
                                <a href="<?php the_permalink()?>" id=""><?php the_title() ?></a>                                
                                <div id="company-address" class="company-part">
                                               <?php $address = get_field( 'address' ); ?>

                        <?php if ( $address ) : ?>
                             <a style="color: black; font-size: 12px;" target="_blank" href="<?php echo esc_url( $address['url'] ); ?>" target="<?php echo esc_attr( $address['target'] ); ?>"><?php echo esc_html( $address['title'] ); ?></a>
                        <?php endif; ?>
                            </div>
                            <div id="company-contacts" class="part-block" style="display: flex; flex-flow: row;">
                    <div class="company-contacts part-block" style="display: flex; flex-flow: column;">
                        <?php if ( have_rows( 'contacts' ) ) : ?>
                            <?php while ( have_rows( 'contacts' ) ) : the_row(); ?>
                                <?php if ( have_rows( 'phone' ) ) : ?>
                                    <?php while ( have_rows( 'phone' ) ) : the_row(); ?>
                                    <?php echo '<div style="font-size: 12px">';
                                        echo '<span>т.&nbsp;'; ?>
                                        <?php  the_sub_field('phone');?>
                                    <?php echo '</span><br>'; ?>
                                    <?php echo '<i class="fab fa-viber"></i>&nbsp<a href="viber://chat?number='.get_sub_field('phone') .'">искать в Viber</a>';?>
                                        <?php // fax ( value )
                                        $fax_array = get_sub_field( 'fax' );
                                        if ( $fax_array ):
                                            foreach ( $fax_array as $fax_item ):
                                                echo '<span>';
                                                echo $fax_item;
                                            echo '</span>';
                                            endforeach;
                                        endif; ?>
<?php  //                                      echo '<span>'; ?>
                           <?php //the_sub_field( 'comment-to-phone' ); ?>
                        <?php
           //             echo '</span>';
                                    echo '</div>';
                                    ?>
                                        <?php endwhile; ?>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <?php // no rows found ?>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div id="company-links" class="part-block">
                        <?php if (have_rows('links')) : ?>
                            <?php while (have_rows('links')) : the_row(); ?>
                                <?php $link = get_sub_field('link')?> 
						<a style="word-break: break-all; font-size: 12px" href="<?php echo esc_url($link['url']); ?>" redirect><?php echo esc_html($link['title']); ?>
                                   </a><br>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <?php //no rows found ?>
                        <?php endif; ?>
                    </div>
                    </td>
                            <!--Company description end-->
                            <!--Company excerpt begin-->

                            <td class="excerpt-company" colspan="0">
         <?php
    if ( has_post_thumbnail() ) {?>
			<div class="entry-thumbnail" style="padding: 6px;     border-left: 1px solid lightgray;">
                            <?php $post_medium_img = $fr_obj->get_thumbnail(get_the_ID(), 'small');
                            $post_full_img = $fr_obj->get_thumbnail(get_the_ID(), 'full');?>
                            <img class="thumb-img" style="visibility: visible" width="auto" height="auto" src="<?php echo esc_url($post_medium_img);?>"  data-src="<?php echo esc_url($post_full_img);?>" class="fr_lazyload" alt="<?php the_title_attribute();?>" style="max-width: 150px">
                        </div>
		 <?php
				}else{?>
<?php	} ?>

        <?php the_excerpt(); ?>
                            </td>
<!-- Company description end -->
                            <td class="company-shares" style="" colspan="0"></td>
</tr>
</tbody>
        </table>
</li>