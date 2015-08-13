<?php get_header(); ?>

<div class="row">
  <div class="col-md-8">
	<div class="section-inner bloc">
	    <h1><?php _e('Category: ','wpthemebootstrapblank'); ?> <?php single_cat_title(); ?></h1>

	    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php if(has_post_thumbnail()) {?><div class="thumbnail pull-left"><?php the_post_thumbnail('thumbnail');?></div><?php }?>
	    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<p class="time"><?php the_time(get_option('date_format'));?> | <a href="#"><?php comments_number('', __('1 comment','wpthemebootstrapblank'), __('% comments','wpthemebootstrapblank')) ?></a></p>
		<?php the_excerpt(); ?>
		<div class="row-fluid"><?php echo get_the_tag_list(_e('<em>Tags: ','wpthemebootstrapblank'),', ','</em>'); ?><br/><a class="readmore" href="<?php the_permalink();?>"><?php _e('Read more','wpthemebootstrapblank'); ?></a></div>
	  	<hr>


	    <?php endwhile;?>
		<div class="row pagination"><?php my_pagination(); ?></div>
	    <?php else: ?>

	      <p><?php _e('Sorry, there are no posts.','wpthemebootstrapblank'); ?></p>
	    <?php endif; ?>
	</div>
  </div>
  <div class="col-md-4 section">

    <?php get_sidebar(); ?>

  </div>
</div>


<?php get_footer(); ?>
