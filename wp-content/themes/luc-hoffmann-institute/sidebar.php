<?php

if ( 
	is_home() ||
	get_post_type() == 'post'
) {
	$sidebar = 'News';
} else if (
	is_page( 'pitches' ) ||
	get_post_type() == 'pitch'
) {
	$sidebar = 'Pitches';
} else {
	$sidebar = $post->post_title;
}

if (!function_exists('dynamic_sidebar') || !dynamic_sidebar( $sidebar )): endif;