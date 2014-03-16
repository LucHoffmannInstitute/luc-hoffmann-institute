<?php

/**
 * Register Project content type
 */
add_action( 'init', 'hoffmann_register_projects' );
function hoffmann_register_projects() {

	$labels = array(
		'name' => __( 'Projects' ),
		'singular_name' => __( 'Project' ),
		'add_new' => __( 'Add New Project Page' ),
		'edit_item' => __( 'Edit Project Page' ),
		'add_new_item' => __( 'New Project Page' ),
		'view_item' => __( 'View Project Page' ),
		'search_items' => __( 'Search Project Pages' ),
		'not_found' => __( 'No Project Pages found' ),
		'not_found_in_trash' => __( 'No Project Pages found in Trash' )
	);

	$rewrite = array(
		'slug' => 'projects',
		'with_front' => false
	);

	$args = array(
		'labels' => $labels,
		'menu_position' => null,
		'supports' => array('title','editor','page-attributes', 'excerpt'),
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