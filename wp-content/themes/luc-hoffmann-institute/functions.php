<?php

/**
 * Print the <title> tag based on what is being viewed
 * @return 
 * - echo string
 */
function hoffmann_title() {
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name
	bloginfo( 'name' );

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		echo ' | ' . sprintf( __( 'Page %s', 'vpc' ), max( $paged, $page ) );
	}
}

/**
 * Print styles and scripts in header and footer
 */
add_action( 'wp_enqueue_scripts', 'hoffmann_styles_and_scripts' );
function hoffmann_styles_and_scripts() {

	// for public side only
	if ( is_admin() ) {
		return false;
	}

	wp_register_style( 'screen', get_template_directory_uri() . '/assets/styles/build/screen.css' );
	wp_enqueue_style( 'screen' );

	// include jQuery
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_template_directory_uri() . '/bower_components/jquery/jquery.min.js', array(), '2.0.3', false );
	wp_enqueue_script( 'jquery' );

	// include jQuery migrate plugin
	wp_register_script( 'jquery-migrate', get_template_directory_uri() . '/bower_components/jquery/jquery-migrate.min.js', array( 'jquery' ), '1.1.1', false );
	//wp_enqueue_script( 'jquery-migrate' );

	// include theme scripts in footer
	wp_register_script( 'hoffmann-main', get_template_directory_uri() . '/assets/scripts/build/main.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'hoffmann-main' );
}

/**
 * Open graph doctype
 */
add_filter( 'language_attributes', 'hoffmann_language_attributes' );
function hoffmann_language_attributes( $output ) {
	return $output . ' xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml"';
}

/**
 * Add meta tags to head
 */
add_action( 'wp_head', 'hoffmann_meta_tags' );
function hoffmann_meta_tags() {
	$post = get_queried_object();

	if ( has_post_thumbnail( $post->ID ) ) {
		$thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		$thumbnail = $thumb_src[0];
	} else {
		$thumbnail = get_template_directory_uri() . '/assets/img/build/apple-touch-icon-114x114-precomposed.png';
	}

	?>
	<meta property="og:title" content="<?php echo hoffmann_title() ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="<?php echo get_permalink() ?>" />
	<meta property="og:image" content="<?php echo $thumbnail ?>" />
	<meta property="og:site_name" content="<?php	bloginfo('name') ?>" />
	<?php
}

/**
 * Theme setup
 */
add_action( 'after_setup_theme', 'hoffmann_theme_setup' );
function hoffmann_theme_setup() {

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support('automatic-feed-links');

	// Register nav menus
	register_nav_menus(array(
		'main-menu' => 'Main menu'
	));

	// Featured images
	//if ( function_exists( 'add_theme_support' ) ) {
	//	add_theme_support('post-thumbnails');
	//}

	// Set media sizes
	// thumbnail: 200x200 square crop
	update_option( 'thumbnail_size_w', 200 );
  	update_option( 'thumbnail_size_h', 200 );
  	update_option( 'thumbnail_crop', 1 );

  	// small: 262x262
	if ( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'banner', 1100 );
	}

	// medium: 528x528
	update_option( 'medium_size_w', 528 );
	update_option( 'medium_size_h', 528 );

	// large: 750x750
	update_option( 'large_size_w', 794 );
	update_option( 'large_size_h', 794 );
}

/**
 * Register Project content type
 */
add_action( 'init', 'hoffmann_register_projects' );
function hoffmann_register_projects() {

	$labels = array(
		'name' => __( 'Projects' ),
		'singular_name' => __( 'Project' ),
		'add_new' => __( 'Add New Project' ),
		'edit_item' => __( 'Edit Project' ),
		'add_new_item' => __( 'New Project' ),
		'view_item' => __( 'View Project' ),
		'search_items' => __( 'Search Projects' ),
		'not_found' => __( 'No Projects found' ),
		'not_found_in_trash' => __( 'No Projects found in Trash' )
	);

	$rewrite = array(
		'slug' => 'projects',
		'with_front' => false
	);

	$args = array(
		'labels' => $labels,
		'menu_position' => null,
		'supports' => array('title','editor','page-attributes'),
		'public' => true,
		'has_archive' => false,
		'hierarchical' => false,
		'capability_type' => 'page',
		'rewrite' => $rewrite,
		'exclude_from_search' => false
	);

	register_post_type( 'project', $args );
}

/**
 * Register internal blog "pitches"
 */
add_action( 'init', 'hoffmann_register_pitches' );
function hoffmann_register_pitches() {

	$labels = array(
		'name' => __( 'Pitches' ),
		'singular_name' => __( 'Pitch' ),
		'add_new' => __( 'Add New Pitch' ),
		'edit_item' => __( 'Edit Pitch' ),
		'add_new_item' => __( 'New Pitch' ),
		'view_item' => __( 'View Pitch' ),
		'search_items' => __( 'Search Pitches' ),
		'not_found' => __( 'No Pitches found' ),
		'not_found_in_trash' => __( 'No Pitches found in Trash' )
	);

	$rewrite = array(
		'slug' => 'pitches',
		'with_front' => false
	);

	$args = array(
		'labels' => $labels,
		'menu_position' => null,
		'supports' => array('title','editor', 'attributes'),
		'public' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'capability_type' => 'post',
		'rewrite' => $rewrite,
		'exclude_from_search' => true,
		'show_in_nav_menus' => false
	);

	register_post_type( 'pitch', $args );

}

/**
 * Admin settings
 */
add_action( 'admin_init', 'hoffmann_settings' );
function hoffmann_settings() {

	// handshake statements
	add_option( 'handshake' );
	add_settings_field( 'handshake', 'Handshake statements', 'hoffmann_settings_handshake', 'general' );
	register_setting( 'general', 'handshake', 'hoffmann_settings_handshake_sanitize' );

	// twitter
	add_option( 'twitter_handle' );
	add_settings_field( 'twitter_handle', 'Twitter handle', 'hoffmann_settings_twitter', 'general' );
	register_setting( 'general', 'twitter_handle', 'hoffmann_settings_twitter_sanitize' );

	// contact email
	add_option( 'contact_email' );
	add_settings_field( 'contact_email', 'Contact email', 'hoffmann_settings_contact_email', 'general' );
	register_setting( 'general', 'contact_email', 'hoffmann_settings_twitter_sanitize' );


	// linkedin account
	add_option( 'linked_in' );
	add_settings_field( 'linked_in', 'LinkedIn URL', 'hoffmann_settings_linked_in', 'general' );
	register_setting( 'general', 'linked_in', 'hoffmann_settings_twitter_sanitize' );
}

/**
 * Admin settings: handshake statements
 */
function hoffmann_settings_handshake() {
	$value = get_option( 'handshake' );

	?>
		<p>Animated handshake statement appearing at the top of the home page. Enter one sentance per line.</p>
		<textarea name="handshake" id="handshake" cols="30" rows="10" style="width: 100%;"><?php echo $value ?></textarea>
	<?php
}

/**
 * Admin settings: sanitize handshake statement
 */
function hoffmann_settings_handshake_sanitize( $input ) {
	return strip_tags( stripslashes( $input ) );
}

/**
 * Admin settings: contact email
 */
function hoffmann_settings_contact_email() {
	$value = get_option( 'contact_email' );

	?>
		<p>Contact email address</p>
		<input name="contact_email" id="contact_email" value="<?php echo $value ?>" />
	<?php
}

/**
 * Admin settings: LinkedIn
 */
function hoffmann_settings_linked_in() {
	$value = get_option( 'linked_in' );

	?>
		<p>LinkedIn account URL</p>
		<input name="linked_in" id="linked_in" value="<?php echo $value ?>" />
	<?php
}

/**
 * Admin settings: twitter handle
 */
function hoffmann_settings_twitter() {
	$value = get_option( 'twitter_handle' );

	?>
		<p>Twitter handle for use in the Twitter widget</p>
		<input name="twitter_handle" id="twitter_handle" value="<?php echo $value ?>" />
	<?php
}

/**
 * Admin settings: sanitize twitter handle
 */
function hoffmann_settings_twitter_sanitize( $input ) {
	return strip_tags( stripslashes( $input ) );
}

/**
 * Set up sidebars
 */
add_action( 'widgets_init', 'hoffmann_sidebars_init' );

function hoffmann_sidebars_init() {

	// include custom widgets
	$file = dirname(__FILE__) . '/widgets.php';

	if ( file_exists( $file ) ) {
		require( $file );
	}

	$before_widget	= '<section id="%1$s" class="widget %2$s">';
	$before_title 	= '<header class="widget-header"><h2 class="widget-title">';
	$after_title	= '</h2></header>';
	$after_widget	= '</section>';

	$additional_sidebars = array( 'Home' );

	// add project post types as additional sidebars
	$projects = get_posts( array(
		'post_type' => 'project'
	) );

	foreach ( $projects as $project ) {
		array_push( $additional_sidebars, $project->post_title );
	}

	if ( !empty( $additional_sidebars ) ) {
		foreach ( $additional_sidebars as $sidebar ) {
			register_sidebar( array(
				'name' => $sidebar,
				'id' => 'sidebar-' . str_replace(' ', '-', strtolower( $sidebar ) ),
				'before_widget' => $before_widget,
				'after_widget'	=> $after_widget,
				'before_title' 	=> $before_title,
				'after_title'	=> $after_title
			) );
		}
	}

	// this will return only top-level pages
	$pages = get_pages('sort_column=menu_order&sort_order=ASC');

	// remove specific pages by page name
	$pages_to_remove = array( );

	if ( empty( $pages ) ) {
		return false;
	}

	foreach( $pages as $page ) {
		// remove specific pages
		if( !in_array( $page->post_name, $pages_to_remove ) ) {
			register_sidebar( array(
				'name' 			=> $page->post_title,
				'id'			=> 'sidebar-' . $page->ID,
				'before_widget' => $before_widget,
				'after_widget'	=> $after_widget,
				'before_title' 	=> $before_title,
				'after_title'	=> $after_title
			) );
		}
	}

}

/**
 * Secondary menu walker
 */
class Hoffmann_Secondary_Menu_Walker extends Walker_Nav_Menu {

	function __construct() {
		$this->ancestor_id = hoffmann_page_ancestor();
	}

	// Don't start the top level
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( $depth == 0 ) {
			return;
		}
		parent::start_lvl( $output, $depth, $args );
	}

	// Don't end the top level
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		if ( $depth == 0 ) {
			return;
		}
		parent::end_lvl( $output, $depth, $args );
	}

	// Don't print top-level elements
	function start_el( &$output, $item, $depth = 0, $args = array() ) {
		if ( $depth == 0 ) {
			return;
		}
		parent::start_el( $output, $item, $depth, $args );
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ( $depth == 0 ) {
			return;
		}
		parent::end_el( $output, $item, $depth, $args );
	}

	// only follow down one branch
	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

		if ( !$this->check_current_element( $element, $depth ) ) {
			return;
		}

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	function check_current_element ( $element, $depth ) {

		// Check if element has a 'current element' class
		$current_element_markers = array( 'current-menu-item', 'current-menu-parent', 'current-menu-ancestor' );
		$current_class = array_intersect( $current_element_markers ,  $element->classes );
		
		// If element has a 'current' class, it is an ancestor of the current element
		$ancestor_of_current = !empty( $current_class );

		// If this is a top-level link and not the current, or ancestor of the current menu item, stop here
		if ( $depth == 0 && !$ancestor_of_current ) {
			return false;
		}

		return true;
	}
}

/**
 * Secondary menu walker for next/prev items
 */
class Hoffmann_Secondary_Menu_Walker_Next_Prev extends Hoffmann_Secondary_Menu_Walker {

	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

		if ( !$this->check_current_element( $element, $depth ) ) {
			return;
		}

		// output should be previous/next items
		$output .= '<li class="prev"><a class="button align-left"><i class="icon-arrow-left"></i> <span>Back: Conservation research panel</span></a></li>';
	}

}

/**
 * Profile list shortcode
 */
add_shortcode( 'profile_list', 'hoffmann_profile_list' );
function hoffmann_profile_list( $atts ) {

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	// check for advanced custom field plugin
	if ( !is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
		return;
	}

	if ( !get_field( 'profile' ) ) {
		return;
	}

	$output = '<section class="profile-list">';

	while ( has_sub_field( 'profile' ) ) {

		$image_src = wp_get_attachment_image_src( get_sub_field('image'), 'thumbnail' );
		$image_url = $image_src[0];

		$output .= '<article class="profile" id="' . sanitize_title( get_sub_field( 'name' ) ) . '">';
		$output .= '<header class="profile-header">';
		$output .= '<div class="profile-image">';
		$output .= '<img src="' . $image_url . '" alt="Alison Richard" />';
		$output .= '</div>';
		$output .= '<div class="profile-title">';
		$output .= '<h2>' . get_sub_field( 'name' ) . '</h2>';
		if ( get_sub_field( 'lhi_title' ) ) {
			$output .= '<h3>' . get_sub_field( 'lhi_title' ) . '</h3>';
		}
		if ( get_sub_field( 'professional_title' ) ) {
			$output .= apply_filters( 'the_content', get_sub_field( 'professional_title' ) );
		}
		if ( get_sub_field( 'text' ) ) {
			$output .= '<a href="#" class="show-profile-content">Show details</a>';
		}
		$output .= '</div>';
		$output .= '</header>';
		if ( get_sub_field( 'text' ) ) {
			$output .= '<div class="profile-content inactive">';
			$output .= apply_filters( 'the_content', get_sub_field( 'text' ) );
			$output .= '</div>';
		}
		$output .= '</article>';
	}

	$output .= '</section>';

	return $output;



}

/**
 * Get page ancestor
 */
function hoffmann_page_ancestor( $attr = 'ID' ) {
	global $post;

	// test for search
	if ( is_search() ) {
		return false;
	}

	// test for blog
	if ( ( $post->post_type == 'post' || is_archive() ) ) {
		$page_for_posts = get_option( 'page_for_posts' );

		if ( $page_for_posts == 0 ) {
			return false;
		}

		$ancestor = get_post( $page_for_posts );
		return $ancestor->$attr;
	}

	// test for pages
	if ( $post->post_type == 'page' ) {

		// test for top-level pages
		if ( $post->post_parent == 0 ) {
			return $post->attr;
		}

		// child page
		$ancestors = get_post_ancestors( $post->ID );
		$ancestor = get_post( array_pop( $ancestors ) );
		return $ancestor->$attr;
	}

	// test for custom post types
	$custom_post_types = get_post_types( array( '_builtin' => false ), 'object' );
	if ( !empty( $custom_post_types ) && array_key_exists( $post->post_type, $custom_post_types ) ) {

		// is parent_page slug defined?
		if ( isset( $custom_post_types[ $post->post_type ]->parent_page ) ) {

			// parent_page slug is defined.
			$parent = get_page_by_path( $custom_post_types[ $post->post_type ]->parent_page );

		} else {

			// parent_page slug is not defined
			// find custom slug
			$slug = $custom_post_types[ $post->post_type ]->rewrite[ 'slug' ];

			// if a page exists with the same slug, assume that's the parent page
			$parent = get_page_by_path( $slug );
		}

		// get ancestors of $parent
		$ancestors = get_post_ancestors( $parent->ID );

		// if ancestors is empty, just return $parent;
		if ( empty( $ancestors ) ) {
			return $parent->$attr;
		}

		$ancestor = get_post( array_pop( $ancestors ) );
		return $ancestor->$attr;
	}
}

/*
|---------------------------------------------------------------------------
| Pagination
|---------------------------------------------------------------------------
*/
function hoffmann_paginate() {

	if( is_singular() )
		return;

	global $wp_query;

	$prev_label = '&laquo;';
	$next_label = '&raquo;';

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<nav class="pagination"><ul>' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link( $prev_label ) );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="current"' : '';
		printf( '<li><a%s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="current"' : '';
		printf( '<li><a%s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link( $next_label ) );

	echo '</ul></nav>' . "\n";
}






















