<?php
/*
 * The template for displaying all single posts
  Template Name: My Single
  Template Post: post
 */
acf_form_head();
$taxonomy = 'comp_categories';
global $post;
get_header();
$terms = wp_get_object_terms($post->ID, $taxonomy);
$taxonomy_slug = $terms[0]->slug;
$term_slug = get_query_var('term');
$term_id = get_queried_object()->term_id;
$term = get_term( $term_id, $taxonomy );
$slug = $term->slug;
$shares_args = array(
    'post_type' => 'shares',
//'post_parent'=>get_the_ID(),
    'taxonomy' => $taxonomy,
    'tax_query' => array(
        array(
            'taxonomy' => $taxonomy,
            'field' => 'slug',
            'terms' => $slug,
            'include_children' => false
        )
    ),
    'field' => 'slug',
    'term' => $taxonomy_slug,
    'posts_per_page' => -1
);

//go through each term in this taxonomy one at a time
$shares_loop = get_posts($shares_args);
?>
    <style type="text/css">
        div.breadcrumbs span.company-name{
           display: none;
        }
        div.breadcrumbs span.company-name:before{
            display: none;
        }
        .breadcrumbs__link.current-item:after {
            display: none;
        }
        a.toggler{
            color: black;
        }
    </style>
	<section id="primary" class="bizov-container" style="">
<?php get_sidebar('head-left');?>
    <div class="content-area" style="">
        <?php   get_sidebar('left-main');?>
        <main id="main" class="single-main single-company" style="">
<?php
if (have_posts()) :

while (have_posts()) : the_post();
   get_template_part('template-parts/post/content', 'company');
            endwhile;
wp_reset_postdata();
echo '<h1>Акция</h1>';
// получим команду у игрока
$post = get_post( $post->post_parent );
// теперь $post это команда игрока
//setup_postdata($post); // установим данные
echo '<ul>';

if( $players ){
	foreach( $shares_loop as $post ){
		setup_postdata($post);?>
		<a href="<?php the_permalink($post); ?>"><?php echo $post->post_title; ?> </a>
	<?php
	}
	// вернем $post Обратно
	wp_reset_postdata();
}
foreach ($shares_loop as $post) : setup_postdata($post);
?>
    <li class="share-block">
	<a href="<?php the_permalink($post); ?>"><?php echo $post->post_title; ?> </a>
                    <?php
// выводим данные 
get_template_part( 'template-parts/post/content', 'share');
the_title(); // выводим имя игрока
                    ?>
                    <?php
                    echo '</li>';

                    endforeach;
wp_reset_postdata(); // вернем $post обратно

                    echo '</ul>';
else :
    get_template_part( 'no-results' );

endif;?>
<div style="display: flex; justify-content: space-between">
<?php
$prev_post = get_previous_post();
if($prev_post) {
   $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
   echo "\t" . '<a rel="prev" href="' . get_permalink($prev_post->ID) . '" title="' . $prev_title. '" class=" ">&laquo; Previous post<br /><strong>&quot;'. $prev_title . '&quot;</strong></a>' . "\n";
}

$next_post = get_next_post();
if($next_post) {
   $next_title = strip_tags(str_replace('"', '', $next_post->post_title));
   echo "\t" . '<a rel="next" href="' . get_permalink($next_post->ID) . '" title="' . $next_title. '" class=" ">Next post &raquo;<br /><strong>&quot;'. $next_title . '&quot;</strong></a>' . "\n";
}
?>
</div>
		</main>
    </div>
    </section>


<?php get_footer();
