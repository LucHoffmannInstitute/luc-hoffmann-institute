<?php

/**
 * Prevent "news" from being highlighted for custom post types
 */
function custom_fix_blog_tab_on_cpt($classes,$item,$args) {
    if(!is_singular('post') && !is_category() && !is_tag()) {
        $blog_page_id = intval(get_option('page_for_posts'));
        if($blog_page_id != 0) {
            if($item->object_id == $blog_page_id) {
				unset($classes[array_search('current_page_parent',$classes)]);
			}
        }
    }
    return $classes;
}
add_filter('nav_menu_css_class','custom_fix_blog_tab_on_cpt',10,3);


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