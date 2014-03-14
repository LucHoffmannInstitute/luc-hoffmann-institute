<?php

/**
 * Enable theme features
 */
//add_theme_support( 'jquery-cdn' );

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

	// Editor styles
	add_editor_style( get_template_directory_uri() . '/assets/styles/build/editor-style.css' );

//	// Featured images
//	if ( function_exists( 'add_theme_support' ) ) {
//		add_theme_support('post-thumbnails');
//	}

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