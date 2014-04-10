<?php

/**
 * Register Project taxonomies
 *
 * Must be registered before Project post type
 */
add_action('init', 'hoffmann_register_project_taxonomies');
function hoffmann_register_project_taxonomies() {

	// Project themes
	register_taxonomy('project_themes', array('project', 'post'), array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( 'Project Themes', 'taxonomy general name' ),
			'singular_name' => _x( 'Theme', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Themes' ),
			'popular_items' => __( 'Popular Themes' ),
			'all_items' => __( 'All Themes' ),
			'edit_item' => __( 'Edit Theme' ),
			'update_item' => __( 'Update Theme' ),
			'add_new_item' => __( 'Add New Theme' ),
			'new_item_name' => __( 'New Theme Name' ),
		),
		'show_ui' => true,
		'query_var' => true,
		'sort' => true,
		'rewrite' => array(
			'slug' => 'projects/themes',
			'with_front' => false
		)
	));

	// Work streams
	register_taxonomy('work_streams', array('project', 'post'), array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( 'Work Streams', 'taxonomy general name' ),
			'singular_name' => _x( 'Work Stream', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Work Streams' ),
			'popular_items' => __( 'Popular Work Streams' ),
			'all_items' => __( 'All Work Streams' ),
			'edit_item' => __( 'Edit Work Stream' ),
			'update_item' => __( 'Update Work Stream' ),
			'add_new_item' => __( 'Add New Work Stream' ),
			'new_item_name' => __( 'New Work Stream Name' ),
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array(
			'slug' => 'work-streams',
			'with_front' => false
		)
	));
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
		'has_archive' => true,
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
		'supports' => array('title','editor', 'attributes', 'comments'),
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
 * Add 'pitches' to admin bar
 */
add_action( 'admin_bar_menu', 'hoffmann_admin_bar_pitches', 999 );
function hoffmann_admin_bar_pitches( $wp_admin_bar ) {

	// https://codex.wordpress.org/Function_Reference/add_node

	$args = array(
		'id' => 'pitches',
		'title' => 'Pitches',
		'href' => home_url( 'pitches' )
	);

	$wp_admin_bar->add_node( $args );
}

/**
 * Lock down pitches section
 */
add_action( 'template_redirect', 'hoffmann_lock_pitches' );
function hoffmann_lock_pitches() {

	if ( ( get_post_type() == 'pitch' || is_page( 'pitches' ) ) && !is_user_logged_in() ) {
		wp_redirect( home_url('wp-login.php') );
	}
}