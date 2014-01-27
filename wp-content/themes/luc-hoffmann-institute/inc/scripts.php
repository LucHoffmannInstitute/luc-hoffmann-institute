<?php

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
	wp_register_script( 'jquery', get_template_directory_uri() . '/bower_components/jquery/jquery.min.js', array(), '1.11.0', false );
	wp_enqueue_script( 'jquery' );

	// include theme scripts in footer
	wp_register_script( 'hoffmann-main', get_template_directory_uri() . '/assets/scripts/build/main.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'hoffmann-main' );

	if ( comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}