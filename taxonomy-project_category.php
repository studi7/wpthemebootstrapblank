<?php get_header(); ?>


<div class="row">

  <div class="col-md-6">
	<div class="section-inner bloc">
	<h1><?php single_cat_title(); ?></h1>
	<?php /*the_field('content', get_queried_object()->taxonomy.'_'.get_queried_object()->term_id);*/ ?>

	</div>
  </div>

  <div class="col-md-6">
	<div class="section-inner bloc">
		<h2>Alguns projectes...</h2>
		<?php 
		$first = true;
		$wpq = array ('taxonomy'=>get_queried_object()->taxonomy,'term'=>get_queried_object()->slug, 'posts_per_page' => '-1');
		$myquery = new WP_Query ($wpq);
		$article_count = $myquery->post_count;
		echo '<div id="myCarousel" class="carousel slide"><ol class="carousel-indicators">';
		for($i=0;$i<$article_count;$i++) {
			if($first) { echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" class="active"></li>'; $first = false;}
			else { echo '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>'; }
		}
		$first = true;
		echo '</ol><div class="carousel-inner">';
			//echo '<div class="col-md-4"><p>'.$term->description.'</p>';
			//echo '<a class="readmore" href="'.get_term_link( $term ).'">Llegir més</a></div>'; //get_term_link( $term ); echo var_dump($term);
			if ($article_count) {
				 while ($myquery->have_posts()) : $myquery->the_post();
				
				if($first) { 
					
					echo '<div class="active item">'; 

					echo '<img src="">';
					
					echo '<a class="carousel-link" href="'.get_permalink($post->ID).'"><div class="carousel-caption">
                      				<h3>'.$post->post_title.'</h3>
                      				<p>'.$post->post_excerpt.'</p>
                    			</div></a>';
					echo '</div>';
					$first = false;
				}
				else { 
					echo '<div class="item">'; 
					echo '<img src="">';
					echo '<a class="carousel-link" href="'.get_permalink($post->ID).'"><div class="carousel-caption">
                      				<h3>'.$post->post_title.'</h3>
                      				<p>'.$post->post_excerpt.'</p>
                    			</div></a>';
					echo '</div>'; 
				}


			    //$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID, 'medium') );
			    //echo '<li class="col-md-2"><div class="thumbnail">';
			    //echo '<img src="'.$url['0'].'">';
			    //echo '<div class="caption"><h5><a href="'.get_permalink().'">'.$post->post_title.'</a></h5></div></div></li>';
			    //echo $post->post_excerpt;	
			 endwhile;
			}
			 echo "</div>";	
			echo '<a class="carousel-control left" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
<a class="carousel-control right" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>';
echo "</div>";
?>
	
  </div></div>

</div>


<?php get_footer(); ?>
