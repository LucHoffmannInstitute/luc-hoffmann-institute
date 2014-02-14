<?php

/**
 * [lede]...[/lede]
 */
add_shortcode( 'lede', 'expedart_shortcode_lede' );
function expedart_shortcode_lede( $atts, $content = null ) {
	extract( shortcode_atts( array(
	), $atts ) );
	return '<div class="lede">' . do_shortcode($content) . '</div>';
}

/**
 * [pull]
 *
 * Pullquotes
 */
add_shortcode( 'pull', 'expedart_shortcode_pull' );
function expedart_shortcode_pull( $atts, $content = null ) {
	extract( shortcode_atts( array(
	), $atts ) );
	return '<blockquote class="pullquote">' . do_shortcode($content) . '</blockquote>';
}

/**
 * [cite]
 *
 * Citation inside pullquote
 */
add_shortcode( 'cite', 'expedart_shortcode_cite' );
function expedart_shortcode_cite( $atts, $content = null ) {
	extract( shortcode_atts( array(
	), $atts ) );
	return '<cite class="cite">' . do_shortcode($content) . '</cite>';
}

/**
 * [related_posts]
 */
add_shortcode( 'related_posts', 'expedart_shortcode_related_posts' );
function expedart_shortcode_related_posts( $atts ) {
	extract( shortcode_atts( array(
	), $atts ) );
	return '[related posts go here.]';
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