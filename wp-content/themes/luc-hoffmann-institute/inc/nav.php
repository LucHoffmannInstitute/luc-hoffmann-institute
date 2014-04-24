<?php

/**
 * Fix nav menu active classes for custom post types
 */
function hoffmann_cpt_active_menu($classes, $item) {
	global $post;

	$ancestor_id = hoffmann_ancestor('ID');

	if ( in_array( $item->object_id, array( $ancestor_id, $post->ID ) ) )
	{
		array_push( $classes, 'current-menu-item' );
	}
	else if ( $item->object_id == get_option('page_for_posts') )
	{
		unset( $classes[4] );
	}

	return $classes;
}
add_filter('nav_menu_css_class', 'hoffmann_cpt_active_menu', 10, 2);

/**
 * Main menu walker to add descriptions as data-description
 */
class Menu_With_Description extends Walker_Nav_Menu {

	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';
		$attributes .= ! empty( $item->description ) ? ' data-description="' . esc_attr( $item->description ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**
 * Secondary menu walker
 */
class Hoffmann_Secondary_Menu_Walker extends Walker_Nav_Menu {

	function __construct() {
		$this->ancestor_id = hoffmann_ancestor();
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

		// check if this item
		$color = $this->has_work_stream( $item );

		if ( $color) {
			$args->link_before = '<span class="Secondary-menu-item-border" style="background-color: ' . $color . ';"></span>';
		} else {
			$args->link_before = '<span class="Secondary-menu-item-border"></span>';
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
		global $post;

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


	function has_work_stream( $element ) {


		$page = get_post(get_post_meta($element->ID, '_menu_item_object_id', true));

		// Check if page is associated with a work_stream
		$work_stream = get_term(get_field('work_stream', $page->ID), 'work_streams');

		if ( ! is_wp_error( $work_stream ) ) {
			return get_field('color', 'work_streams_' . $work_stream->term_id);
		}

		return false;
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
