<?php /*Template Name: Projects*/ ?>

<?php get_header(); ?>


<div class="row">

<div class="col-md-12">
	<div class="section-inner bloc">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<h1><?php the_title(); ?></h1>
	  	<?php the_content(); ?>

	<?php endwhile; else: ?>
		<p><?php _e('Sorry, this page does not exist.','wpthemebootstrapblank'); ?></p>
	<?php endif; ?>
	</div>

<?php
	echo '<div class="row">';
	$terms = get_terms('project_category');
foreach ($terms as $term) $termsid[] = $term->term_id;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_type' => 'projects',
    'posts_per_page' => 4,
'paged' => $paged,
    'tax_query' => array(
        array(
            'taxonomy' => 'project_category',
            'terms' => $termsid
        )
    )
);
$myquery = new WP_Query( $args );


			 while ($myquery->have_posts()) : $myquery->the_post();
			echo '<div class="col-sm-6 col-md-3"><div class="thumbnail">';

				if ( has_post_thumbnail() ) {
					the_post_thumbnail();
				}
				else {
					echo '<a href="'.get_permalink($post->ID).'"><img class="img-responsive" src="holder.js/250x170"></a>';
				}



				echo '<div class="caption">
              				<a href="'.get_permalink($post->ID).'"><h4>'.$post->post_title.'</h4></a>
              				<p>'; the_excerpt(); echo '</p>
            			<div class="row"><a class="readmore" href="'.get_permalink($post->ID).'">'.__('Read more','wpthemebootstrapblank').'</a></div></div>';
				echo '</div></div>';

		 endwhile;?>
	</div><div class="pager"><ul><li><?php previous_posts_link(__('Previous projects','wpthemebootstrapblank')) ?></li>&nbsp;<li><?php next_posts_link(__('Next Projects','wpthemebootstrapblank'), $myquery->max_num_pages); ?></li></ul></div>

</div></div>

<?php get_footer(); ?>
