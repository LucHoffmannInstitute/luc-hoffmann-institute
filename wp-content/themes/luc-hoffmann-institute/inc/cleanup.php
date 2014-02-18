<?php
/**
 * Clean up WordPress
 *
 * Much of this is taken from the Roots theme: http://roots.io/
 */

/**
 * Open graph doctype
 */
add_filter( 'language_attributes', 'hoffmann_language_attributes' );
function hoffmann_language_attributes( $output ) {
	return $output . ' xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml"';
}

/**
 * Clean up wp_head()
 *
 * http://wpengineer.com/1438/wordpress-header/
 */
add_action('init', 'hoffmann_wp_head');
function hoffmann_wp_head() {

	// remove general feed links like post and comment
	remove_action('wp_head', 'feed_links', 2);

	// remove extra feed links such as category feed
	remove_action('wp_head', 'feed_links_extra', 3);

	// remove link to Really Simple Discovery service endpoint
	remove_action('wp_head', 'rsd_link');

	// remove link to Windows Live Writer manifest file
	remove_action('wp_head', 'wlwmanifest_link');

	// remove index rel link
	remove_action('wp_head', 'index_rel_link');

	// remove adjacent posts rel links
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

	// remove XHTML generator (WP version)
	remove_action('wp_head', 'wp_generator');

	// remove shortlink
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

	// remove recent comments inline css
	global $wp_widget_factory;
	remove_action('wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ));

	// replace canonical link
	remove_action('wp_head', 'rel_canonical');
	add_action('wp_head', 'hoffmann_rel_canonical');
}

/**
 * Better canonical links
 */
function hoffmann_rel_canonical() {
	global $wp_the_query;

	if (!is_singular()) {
		return;
	}

	if (!$id = $wp_the_query->get_queried_object_id()) {
		return;
	}

	$link = get_permalink($id);
	echo "\t<link rel=\"canonical\" href=\"$link\">\n";
}

/**
 * Add open graph meta tags to head
 */
add_action('wp_head', 'hoffmann_meta_tags');
function hoffmann_meta_tags() {
	global $post;

	if ( has_post_thumbnail( $post->ID ) ) {
		$thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		$thumbnail = $thumb_src[0];
	} else {
		$thumbnail = get_template_directory_uri() . '/assets/img/build/apple-touch-icon-114x114-precomposed.png';
	}

	?>
	<meta property="og:title" content="<?php wp_title( '|', true, 'right' ) ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="<?php echo get_permalink() ?>" />
	<meta property="og:image" content="<?php echo $thumbnail ?>" />
	<meta property="og:site_name" content="<?php  bloginfo('name') ?>" />
	<?php
}

/**
 * Remove the WordPress version from RSS feeds
 */
add_filter('the_generator', '__return_false');

/**
 * Manage output of wp_title()
 */
add_filter('wp_title', 'hoffmann_wp_title', 10);
function hoffmann_wp_title($title) {
	if ( is_feed() ) {
		return $title;
	}

	$title .= get_bloginfo('name');

	return $title;
}

/**
 * Clean up output of stylesheet <link> tags
 */
add_filter('style_loader_tag', 'hoffmann_clean_style_tag');
function hoffmann_clean_style_tag($input) {
	preg_match_all("!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches);
	// Only display media if it is meaningful
	$media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';
	return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
}

/**
 * Add and remove body_class() classes
 */
add_filter('body_class', 'hoffmann_body_class');
function hoffmann_body_class($classes) {
	// Add post/page slug
	if ( is_single() || is_page() && !is_front_page() ) {
		$classes[] = basename( get_permalink() );
	}

	// Remove unnecessary classes
	$home_id_class = 'page-id-' . get_option('page_on_front');
	$remove_classes = array(
		'page-template-default',
		$home_id_class
	);
	$classes = array_diff($classes, $remove_classes);

	return $classes;
}

/**
 * Wrap embedded media as suggested by Readability
 *
 * https://gist.github.com/965956
 * http://www.readability.com/publishers/guidelines#publisher
 */
add_filter('embed_oembed_html', 'hoffmann_embed_wrap', 10, 4);
function hoffmann_embed_wrap($cache, $url, $attr = '', $post_ID = '') {
	return '<div class="entry-content-asset">' . $cache . '</div>';
}

/**
 * Add Bootstrap thumbnail styling to images with captions
 * Use <figure> and <figcaption>
 *
 * http://justintadlock.com/archives/2011/07/01/captions-in-wordpress
 */
add_filter('img_caption_shortcode', 'hoffmann_caption', 10, 3);
function hoffmann_caption( $output, $attr, $content ) {

	// do not apply to feeds
	if ( is_feed() ) {
		return $output;
	}

	$defaults = array(
		'id'      => '',
		'align'   => 'alignnone',
		'width'   => '',
		'caption' => ''
	);

	$attr = shortcode_atts($defaults, $attr);

	// If the width is less than 1 or there is no caption, return the content wrapped between the [caption] tags
	if ($attr['width'] < 1 || empty($attr['caption'])) {
		return $content;
	}

	// Set up the attributes for the caption <figure>
	$attributes  = ( !empty( $attr['id'] ) ? ' id="' . esc_attr( $attr['id'] ) . '"' : '' );
	$attributes .= ' class="Figure ' . esc_attr( $attr['align'] ) . '"';
	$attributes .= ' style="width: ' . esc_attr( $attr['width'] ) . 'px"';

	$output  = '<figure' . $attributes .'>';
	$output .= do_shortcode( $content ) . '<figcaption class="Caption">' . $attr['caption'] . '</figcaption>';
	$output .= '</figure>';

	return $output;
}

/**
 * Remove unnecessary dashboard widgets
 *
 * http://www.deluxeblogtips.com/2011/01/remove-dashboard-widgets-in-wordpress.html
 */
add_action('admin_init', 'hoffmann_remove_dashboard_widgets');
function hoffmann_remove_dashboard_widgets() {
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
	remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
	remove_meta_box('dashboard_primary', 'dashboard', 'normal');
	remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
}

/**
 * Clean up the_excerpt()
 */
//add_filter('excerpt_length', 'hoffmann_excerpt_length');
//function hoffmann_excerpt_length($length) {
//	return POST_EXCERPT_LENGTH;
//}

add_filter('excerpt_more', 'hoffmann_excerpt_more');
function hoffmann_excerpt_more($more) {
	return ' &hellip; <a href="' . get_permalink() . '">' . __('Read more', 'hoffmann') . '</a>';
}

/**
 * Remove unnecessary self-closing tags
 */
add_filter('get_avatar',          'hoffmann_remove_self_closing_tags'); // <img />
add_filter('comment_id_fields',   'hoffmann_remove_self_closing_tags'); // <input />
add_filter('post_thumbnail_html', 'hoffmann_remove_self_closing_tags'); // <img />
function hoffmann_remove_self_closing_tags($input) {
	return str_replace(' />', '>', $input);
}

/**
 * Don't return the default description in the RSS feed if it hasn't been changed
 */
add_filter('get_bloginfo_rss', 'hoffmann_remove_default_description');
function hoffmann_remove_default_description($bloginfo) {
	$default_tagline = 'Just another WordPress site';
	return ( $bloginfo === $default_tagline ) ? '' : $bloginfo;
}

/**
 * Redirects search results from /?s=query to /search/query/, converts %20 to +
 *
 * http://txfx.net/wordpress-plugins/nice-search/
 */
add_action('template_redirect', 'hoffmann_nice_search_redirect');
function hoffmann_nice_search_redirect() {
	global $wp_rewrite;
	if (!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->using_permalinks()) {
		return;
	}

	$search_base = $wp_rewrite->search_base;
	if (is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false) {
		wp_redirect(home_url("/{$search_base}/" . urlencode(get_query_var('s'))));
		exit();
	}
}

/**
 * Fix for empty search queries redirecting to home page
 *
 * http://wordpress.org/support/topic/blank-search-sends-you-to-the-homepage#post-1772565
 * http://core.trac.wordpress.org/ticket/11330
 */
add_filter('request', 'hoffmann_request_filter');
function hoffmann_request_filter($query_vars) {
	if (isset($_GET['s']) && empty($_GET['s'])) {
		$query_vars['s'] = ' ';
	}

	return $query_vars;
}

/**
 * Tell WordPress to use searchform.php from the templates/ directory. Requires WordPress 3.6+
 */
add_filter('get_search_form', 'hoffmann_get_search_form');
function hoffmann_get_search_form($form) {
	$form = '';
	locate_template('/templates/searchform.php', true, false);
	return $form;
}

/**
 * Change "Howdy" to "Welcome"
 */
add_action( 'admin_bar_menu', 'hoffmann_change_howdy', 11 );
function hoffmann_change_howdy( $wp_admin_bar ) {
	$user_id = get_current_user_id();
	$current_user = wp_get_current_user();
	$profile_url = get_edit_profile_url( $user_id );

	if ( $user_id != 0 ) {
		$avatar = get_avatar( $user_id, 28 );
		$howdy = sprintf( __( 'Welcome, %1$s' ), $current_user->display_name );
		$class = empty( $avatar ) ? '' : 'with-avatar';

		$wp_admin_bar->add_menu( array(
			'id' => 'my-account',
			'parent' => 'top-secondary',
			'title' => $howdy . $avatar,
			'href' => $profile_url,
			'meta' => array( 'class' => $class )
		) );
	}
}

/**
 * No dashboard access for subscribers
 */
add_action( 'admin_init', 'hoffmann_lock_dashboard' );
function hoffmann_lock_dashboard() {
	global $pagenow;

	if ( current_user_can( 'manage_options' ) ) {
		return;
	}

	// remove 'dashboard' from admin menu
	remove_menu_page( 'index.php' );

	// disable access to anything but the profile page
	if ( $pagenow !== 'profile.php' ) {
		wp_redirect( home_url( 'wp-admin/profile.php' ) );
	}
}

/**
 * Remove 'dashboard' from admin bar
 */
add_action( 'admin_bar_menu', 'hoffmann_lock_admin_bar_menu', 999 );
function hoffmann_lock_admin_bar_menu( $wp_admin_bar ) {

	if ( current_user_can( 'manage_options' ) ) {
		return;
	}

	$ids = array( 'dashboard' );
	foreach ( $ids as $id ) {
		$wp_admin_bar->remove_menu( $id );
	}
}

/**
 * Remove wp menu for non-admins
 */
add_action( 'admin_head', 'hoffmann_lock_admin_head' );
function hoffmann_lock_admin_head() {

	if ( current_user_can( 'manage_options' ) ) {
		return;
	}

	$output = '<style type="text/css">#adminmenuback, #adminmenuwrap {display: none;}.wrap {margin-top: 1.5%;}#wpcontent {margin-left: 2%;}';
	echo $output;
}