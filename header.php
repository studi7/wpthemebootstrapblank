
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ca" lang="ca">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php if(is_home()) { echo bloginfo("name"); echo " | "; echo bloginfo("description"); } else { echo wp_title(" | ", false, 'right'); echo bloginfo("name"); } ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Le styles -->
    <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet"/>

    <meta name="description" content="<?php if ( is_single() || is_page() ) {
  		single_post_title('', true);
	} else if(is_category() || is_archive()) {
  		single_cat_title();
    } else {
        bloginfo('name'); echo " - "; bloginfo('description');
    }
    ?>" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <?php wp_enqueue_script("jquery"); ?>
    <?php wp_head(); ?>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.6.0/holder.min.js"></script>
<script type="text/javascript">
/**
* This code changes the default behavior of the navbar:
* now the submenu pops in when the user rolls his mouse
* over the parent level menu entry.
* Many tanks to Hanzi for this idea and code!
*/
jQuery(document).ready(function($) {
$('ul.nav li.dropdown, ul.nav li.dropdown-submenu').hover(function() {
$(this).find(' > .dropdown-menu').stop(true, true).delay(200).fadeIn();
}, function() {
$(this).find(' > .dropdown-menu').stop(true, true).delay(200).fadeOut();
});
$('ul.nav li.dropdown, ul.nav li.dropdown-submenu').click(function() {
	location.href = $('.dropdown-toggle').attr('href');
});
});
</script>


  </head>
  <body>


<div class="container">

  <div class="row">
        <!--<a class="brand" href="<?php echo site_url(); ?>"><?php bloginfo('name'); ?></a>-->
	<div class="col-md-4">
	<a href="<?php echo site_url(); ?>"><h1><?php bloginfo('name'); ?></h1></a>
	<?php bloginfo('description'); ?>
	</div>
	<div class="col-md-8">

        </div>
  </div>
  <div class="row">
	<div class="col-md-12"><nav class="navbar navbar-default" role="navigation">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		<span class="sr-only"><?php _e('Toggle navigation','wpthemebootstrapblank'); ?></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand visible-xs" href="#"><?php echo __('Navigation','wpthemebootstrapblank'); ?></a>
	    </div>

		<!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse no-padding" id="bs-example-navbar-collapse-1">

<?php
            wp_nav_menu( array(
                'theme_location'    => 'top-bar',
                'depth'             => 0,
                'container'         => false,
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>

      	</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
    </nav></div></div>

  <div class="row">
<div class="col-md-12">
<?php if(function_exists('the_breadcrumbs')) the_breadcrumbs(); ?>
</div>
</div>
