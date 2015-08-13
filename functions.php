<?php

// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');

//load textdomain
load_theme_textdomain('wpthemebootstrapblank');

//support thumbs
add_theme_support('post-thumbnails');

//new custom types projects
function create_post_type_projects() {

register_post_type( 'projects', // Register Custom Post Type
		array(
	        'labels' => array(
	                'name' => __( 'Projects','wpthemebootstrapblank' ), // Rename these to suit
			'singular_name' => __( 'Project','wpthemebootstrapblank' ),
			'add_new' => __( 'Add new','wpthemebootstrapblank' ),
			'add_new_item' => __( 'Add new project','wpthemebootstrapblank' ),
			'edit' => __( 'Edit','wpthemebootstrapblank' ),
			'edit_item' => __( 'Edit project','wpthemebootstrapblank' ),
			'new_item' => __( 'New project','wpthemebootstrapblank' ),
			'view' => __( 'View','wpthemebootstrapblank' ),
			'view_item' => __( 'View project','wpthemebootstrapblank' ),
			'search_items' => __( 'Search projects','wpthemebootstrapblank' ),
			'not_found' => __( 'No projects found','wpthemebootstrapblank' ),
			'not_found_in_trash' => __( 'No projects found in trash','wpthemebootstrapblank' ),
	        ),
		'public' => true,
		'hierarchical' => false,
		'has_archive' => false,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail'),
		'can_export' => true,
		'taxonomies' => array( 'project_category' ),
		'rewrite' => array('slug' => 'projecte')
		)
	);
}

add_action( 'init', 'create_post_type_projects' ); // Add our HTML5 Blank Custom Post Type

function project_taxonomy() {
	$labels = array(
		'name'              => _x( 'Project Categories', 'taxonomy general name','wpthemebootstrapblank' ),
		'singular_name'     => _x( 'Project Category', 'taxonomy singular name','wpthemebootstrapblank' ),
		'search_items'      => __( 'Search Project Categories','wpthemebootstrapblank' ),
		'all_items'         => __( 'All Project Categories','wpthemebootstrapblank' ),
		'parent_item'       => __( 'Parent Project Category','wpthemebootstrapblank' ),
		'parent_item_colon' => __( 'Parent Project Category:','wpthemebootstrapblank' ),
		'edit_item'         => __( 'Edit Project Category','wpthemebootstrapblank' ),
		'update_item'       => __( 'Update Project Category','wpthemebootstrapblank' ),
		'add_new_item'      => __( 'Add New Project Category','wpthemebootstrapblank' ),
		'new_item_name'     => __( 'New Project Category','wpthemebootstrapblank' ),
		'menu_name'         => __( 'Project Categories','wpthemebootstrapblank' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'rewrite' => array('slug' => 'project_category')
	);
	register_taxonomy( 'project_category', 'project', $args );
}
add_action( 'init', 'project_taxonomy', 0 );

// get taxonomies terms links
function custom_taxonomies_terms_links() {
    global $post, $post_id;
    // get post by post id
    $post = &get_post($post->ID);
    // get post type by post
    $post_type = $post->post_type;
    // get post type taxonomies
    $taxonomies = get_object_taxonomies($post_type);
    $out = "<ul>";
    foreach ($taxonomies as $taxonomy) {
        $out .= "<li>";//$out .= "<li>".$taxonomy.": ";
        // get the terms related to post
        $terms = get_the_terms( $post->ID, $taxonomy );
        if ( !empty( $terms ) ) {
            foreach ( $terms as $term )
                $out .= '<a href="' .get_term_link($term->slug, $taxonomy) .'">'.$term->name.'</a>';
        }
        $out .= "</li>";
    }
    $out .= "</ul>";
    return $out;
}

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

if ( ! function_exists( 'my_pagination' ) ) :
	function my_pagination() {
		global $wp_query;

		$big = 999999999; // need an unlikely integer

		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'type' => 'list',
			//'after_page_number' => '</li>'
		) );
	}
endif;

function the_breadcrumbs() {

        global $post;

        if (!is_front_page()) {

            echo '<div class="col-md-12 no-padding"><ul class="breadcrumb"><li><a href="';
            echo get_option('home');
            echo '">'._e('Home','wpthemebootstrapblank').'</a></li>';

            if (is_category() || is_single()) {

                echo '<li>';
		if(is_category()) {
			$cats = get_the_category( $post->ID );

		        foreach ( $cats as $cat ){
		            echo $cat->cat_name.' </li>';
		            echo '<li>';
		        }
		}
                if (is_single()) {

                    if ($post->post_type == 'projects') { echo __('Projects','wpthemebootstrapblank'). '</li><li>'; the_title(); echo '  </li>'; }
		    elseif ($post->post_type == 'post') { echo __('Blog','wpthemebootstrapblank'). '</li><li>'; the_title(); echo '  </li>';}
                }
            } elseif (is_page()) {

                if($post->post_parent){
                    $anc = get_post_ancestors( $post->ID );
                    $anc_link = get_page_link( $post->post_parent );

                    foreach ( $anc as $ancestor ) {
                        $output = "<li> <a href=".$anc_link.">".get_the_title($ancestor)."</a></li>";
                    }
 		    echo $output;
                    echo '<li>';
                    echo the_title(); echo '</li>';

                } else {
                    echo '<li>';
                    echo the_title(); echo '</li>';
                }
            }
	    elseif (is_tax( 'project_category' )) { echo '<li>'._e('Project categories','wpthemebootstrapblank').'</li>'; $terms = get_the_terms($post->ID, 'project_category'); echo $terms[0]->name; }
	    elseif (is_home() ) { echo '<li>'._e('Blog','wpthemebootstrapblank').'</li>'; }
	    echo '</ul></div>';
        }

    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo __('Archive: ','wpthemebootstrapblank'); the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo __('Archive: ','wpthemebootstrapblank'); the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo __('Archive: ','wpthemebootstrapblank'); the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo __('Author archive: ','wpthemebootstrapblank'); echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo __('Blog archive: ','wpthemebootstrapblank'); echo '';}
    elseif (is_search()) {echo __('Search results: ','wpthemebootstrapblank'); }


}

function set_the_terms_in_order ( $terms, $id, $taxonomy ) {
    $terms = wp_cache_get( $id, "{$taxonomy}_relationships_sorted" );
    if ( false === $terms ) {
        $terms = wp_get_object_terms( $id, $taxonomy, array( 'orderby' => 'term_order' ) );
        wp_cache_add($id, $terms, $taxonomy . '_relationships_sorted');
    }
    return $terms;
}
add_filter( 'get_the_terms', 'set_the_terms_in_order' , 10, 4 );

function do_the_terms_in_order () {
    global $wp_taxonomies;  //fixed missing semicolon
    // the following relates to tags, but you can add more lines like this for any taxonomy
    $wp_taxonomies['post_tag']->sort = true;
    $wp_taxonomies['post_tag']->args = array( 'orderby' => 'term_order' );
}
add_action( 'init', 'do_the_terms_in_order');


register_nav_menu('top-bar', __('Primary Menu'));
?>
