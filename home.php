<?php get_header(); ?>

<div class="row">
  <div class="col-md-8">
	<div class="section-inner bloc">
	    <h1>Bloc</h1>

	    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php if(has_post_thumbnail()) {?><div class="thumbnail pull-left"><?php the_post_thumbnail('thumbnail');?></div><?php }?>
	    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	  	<?php the_category();?>
		<p class="time"><?php the_time(get_option('date_format'));?> <a href="#"><?php comments_number('', '| 1 comentari', '| % comentaris') ?></a></p>
		<?php the_excerpt(); ?>
		<div class="row-fluid"><?php echo get_the_tag_list('<em>Etiquetes: ',', ','</em>'); ?><a class="readmore" href="<?php the_permalink();?>">Llegir més</a></div>
	  	<hr>
	    
	    
	    <?php endwhile;?>
		<div class="row"><?php my_pagination(); ?></div>
	    <?php else: ?>
	      <p><?php _e('Sorry, there are no posts.'); ?></p>
	    <?php endif; ?>
	</div>
  </div>
  <div class="col-md-4 section">

    <?php get_sidebar(); ?>   

  </div>
</div>


<?php get_footer(); ?>
