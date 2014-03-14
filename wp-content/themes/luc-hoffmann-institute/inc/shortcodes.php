<?php

/**
 * [lede]...[/lede]
 */
add_shortcode( 'lede', 'hoffmann_shortcode_lede' );
function hoffmann_shortcode_lede( $atts, $content = null ) {
	extract( shortcode_atts( array(
	), $atts ) );
	return '<div class="lede">' . do_shortcode($content) . '</div>';
}

/**
 * [pull]
 *
 * Pullquotes
 */
add_shortcode( 'pull', 'hoffmann_shortcode_pull' );
function hoffmann_shortcode_pull( $atts, $content = null ) {
	extract( shortcode_atts( array(
	), $atts ) );
	return '<blockquote class="pullquote">' . do_shortcode($content) . '</blockquote>';
}

/**
 * [cite]
 *
 * Citation inside pullquote
 */
add_shortcode( 'cite', 'hoffmann_shortcode_cite' );
function hoffmann_shortcode_cite( $atts, $content = null ) {
	extract( shortcode_atts( array(
	), $atts ) );
	return '<cite class="cite">' . do_shortcode($content) . '</cite>';
}

/**
 * [related_posts]
 */
add_shortcode( 'related_posts', 'hoffmann_shortcode_related_posts' );
function hoffmann_shortcode_related_posts( $atts ) {
	extract( shortcode_atts( array(
	), $atts ) );

	global $post;

	$related = get_posts( array(
	    'post_type' => 'post',
	    'posts_per_page' => 5,
	    'orderby' => 'post_date',
	    'order' => 'DESC'
	) );

	if ( !isset($related) || empty($related) ) {
		return;
	}

	$output = '<div class="related-posts">';
	$output .= '<h2 class="related-posts-title">Related posts</h2>';
	$output .= '<ul>';

	foreach ( $related as $related_post ) {
		$output .= '<li><a href="' . get_permalink($related_post->ID) . '">' . $related_post->post_title . '</a></li>';
	}

	$output .= '</ul></div>';

	return $output;
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

	$output = '<section class="Profile-list">';

	while ( has_sub_field( 'profile' ) ) {

		$image_src = wp_get_attachment_image_src( get_sub_field('image'), 'thumbnail' );
		$image_url = $image_src[0];

		$output .= '<article class="Profile" id="' . sanitize_title( get_sub_field( 'name' ) ) . '">';
		$output .= '<header class="Profile-header">';
		$output .= '<div class="Profile-image">';
		$output .= '<img src="' . $image_url . '" alt="Alison Richard" />';
		$output .= '</div>';
		$output .= '<div class="Profile-title">';
		$output .= '<h2 class="Profile-name">' . get_sub_field( 'name' ) . '</h2>';
		if ( get_sub_field( 'lhi_title' ) ) {
			$output .= '<h3 class="Profile-professional-title">' . get_sub_field( 'lhi_title' ) . '</h3>';
		}
		if ( get_sub_field( 'professional_title' ) ) {
			$output .= apply_filters( 'the_content', get_sub_field( 'professional_title' ) );
		}
		if ( get_sub_field( 'text' ) ) {
			$output .= '<a href="#" class="Profile-reveal js-profile-reveal">Show details</a>';
		}
		$output .= '</div>';
		$output .= '</header>';
		if ( get_sub_field( 'text' ) ) {
			$output .= '<div class="Profile-content inactive">';
			$output .= apply_filters( 'the_content', get_sub_field( 'text' ) );
			$output .= '</div>';
		}
		$output .= '</article>';
	}

	$output .= '</section>';

	return $output;



}