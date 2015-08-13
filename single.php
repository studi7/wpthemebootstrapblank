<?php get_header(); ?>

<div class="row">
  <div class="col-md-8">
	<div class="section-inner bloc">
	    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	    <h1><?php the_title(); ?></h1>
		<?php the_category();?>
	  	<p><em><?php the_time(get_option('date_format')); ?></em></p>
		<?php the_content(); ?>
	  	<hr>
	    	<?php echo get_the_tag_list(_e('<p>Tags: ','wpthemebootstrapblank'),', ','</p>'); ?>


	    <?php endwhile; else: ?>
	      <p><?php _e('Sorry, there are no posts.','wpthemebootstrapblank'); ?></p>
	    <?php endif; ?>

	    <div class="pager"><ul><li><?php previous_post_link(); ?></li>&nbsp;<li><?php next_post_link(); ?></li></ul></div>

	    <?php comments_template(); ?>
	</div>
  </div>
  <div class="col-md-4 section">

    <?php get_sidebar(); ?>

  </div>
</div>


<?php get_footer(); ?>
