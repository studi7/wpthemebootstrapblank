</div> <!-- /container -->

      <footer class="footer">
        <div class="container">
		<div class="row">
			<div class="col-md-3">
				
				<?php $wp_query = new WP_Query(); $wp_query->query('showposts=1&post_type=projects'); ?>
		    		<h4>Box 1</h4>
				
				<?php if ( $wp_query->have_posts() ) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
					<div class="col-md-12"><h4><?php the_title(); ?></h4></div>
					<div class="col-md-6 img-responsive thumbnail"><?php the_post_thumbnail('thumbnail'); ?></div>
					<div class="col-md-6 no-margin"><?php the_excerpt(); ?>
					
					</div>
				<?php endwhile; else: ?>
					<p><?php _e('No published projects.'); ?></p>
				<?php endif; ?>
				
			</div>
			<div class="col-md-3">
				<h4>Box 2</h4>
				
			</div>
			<div class="col-md-3">
				<h4>Box 3</h4>
				<address>
					<span class="glyphicon glyphicon-earphone white"></span><abbr title="Phone">Tel:</abbr>
				</address>
	    			<address>
	    				<span class="glyphicon glyphicon-envelope white"></span>    <a href="mailto:#">some@example.com</a>
	    			</address>
				
			</div>

			<div class="col-md-3">
				<h4>Box 4</h4>
			</div>
		</div>
	</div>
      </footer>

    


    <?php wp_footer(); ?>
  </body>
</html>
