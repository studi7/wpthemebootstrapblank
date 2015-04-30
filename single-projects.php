<?php get_header(); ?>

<div class="row">
  <div class="col-md-12">
	<div class="section-inner bloc">
	    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
	    <h1><?php the_title(); ?></h1>
		<?php echo custom_taxonomies_terms_links(); echo '</br>';?>
		<?php the_content(); ?>
	  	<hr>
	    	<?php echo get_the_tag_list('<p>Etiquetes: ',', ','</p>'); ?>
		
	    
	    <?php endwhile; else: ?>
	      <p><?php _e('Sorry, there are no posts.'); ?></p>
	    <?php endif; ?>

	    <div class="pager"><ul><li><?php previous_post_link(); ?></li>&nbsp;<li><?php next_post_link(); ?></li></ul></div>
	</div>
  </div>

  </div>
</div>


<?php get_footer(); ?>
