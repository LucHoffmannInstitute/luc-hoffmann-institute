<?php
/**
 * Theme wrapper
 *
 * http://scribu.net/wordpress/theme-wrappers.html
 */

function elcontraption_template_path()
{
	return ElContraption_Wrapper::$main_template;
}

function elcontraption_template_base()
{
	return ElContraption_Wrapper::$base;
}

class ElContraption_Wrapper {

	/**
	 * Stores the full path to the main template file
	 */
	static $main_template;

	/**
	 * Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
	 */
	static $base;

	static function wrap($template)
	{
		self::$main_template = $template;

		self::$base = substr( basename( self::$main_template ), 0, -4 );

		if (self::$base == 'index')
		{
			self::$base = false;
		}

		$templates = array('wrapper.php');

		if (self::$base)
		{
			array_unshift($templates, sprintf('wrapper-%s.php', self::$base));
		}

		return locate_template($templates);
	}
}

add_filter('template_include', array('ElContraption_Wrapper', 'wrap'), 99);