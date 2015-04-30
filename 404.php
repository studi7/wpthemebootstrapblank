<?php get_header(); ?>


<div class="row">

  <div class="col-md-12">
	<div class="section-inner bloc">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<h1><?php the_title(); ?></h1>
	  	<?php the_content(); ?>

	<?php endwhile; else: ?>
		<div class="alert alert-danger"><h1><?php _e('Ooops, aquesta pàgina no existeix :('); ?></h1></div>
	<?php endif; ?>
	</div>
  </div>

</div>


<?php get_footer(); ?>
