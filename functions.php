<?php 

// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');

//support thumbs
add_theme_support('post-thumbnails');

//new custom types projects
function create_post_type_projects() {

register_post_type( 'projects', // Register Custom Post Type
		array(
	        'labels' => array(
	                'name' => __( 'Projects' ), // Rename these to suit
			'singular_name' => __( 'Project' ),
			'add_new' => __( 'Add new' ),
			'add_new_item' => __( 'Add new project' ),
			'edit' => __( 'Edit' ),
			'edit_item' => __( 'Edit project' ),
			'new_item' => __( 'New project' ),
			'view' => __( 'View' ),
			'view_item' => __( 'View project' ),
			'search_items' => __( 'Search projects' ),
			'not_found' => __( 'No projects found' ),
			'not_found_in_trash' => __( 'No projects found in trash' ),
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
		'name'              => _x( 'Project Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Project Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Project Categories' ),
		'all_items'         => __( 'All Project Categories' ),
		'parent_item'       => __( 'Parent Project Category' ),
		'parent_item_colon' => __( 'Parent Project Category:' ),
		'edit_item'         => __( 'Edit Project Category' ), 
		'update_item'       => __( 'Update Project Category' ),
		'add_new_item'      => __( 'Add New Project Category' ),
		'new_item_name'     => __( 'New Project Category' ),
		'menu_name'         => __( 'Project Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'rewrite' => array('slug' => 'serveis')
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
            echo '"> Inici</a></li>';
 
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

                    if ($post->post_type == 'projects') { echo 'Projectes </li><li>'; the_title(); echo '  </li>'; }
		    elseif ($post->post_type == 'post') { echo 'Bloc </li><li>'; the_title(); echo '  </li>';}
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
	    elseif (is_tax( 'project_category' )) { echo '<li>Serveis</li>'; $terms = get_the_terms($post->ID, 'project_category'); echo '<li>'.$terms[0]->name.'</li>'; } //the_title(); get_term_by('id', $post->ID, 'projects')
	    elseif (is_home() ) { echo '<li>Bloc</li>'; } //the_title();
	    echo '</ul></div>';
        }
    
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo "Archive: "; the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo "Archive: "; the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo "Archive: "; the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo"Author's archive: "; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "Blogarchive: "; echo'';}
    elseif (is_search()) {echo "Search results: "; }

    
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


