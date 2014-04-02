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
} else if (
	is_search()
) {
	$sidebar = 'Search';
} else {
	$sidebar = $post->post_title;
}

?>

<div class="Sidebar">

	<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar( $sidebar )): endif; ?>

</div>