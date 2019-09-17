<?php
/**
 * Child theme functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Text Domain: oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function oceanwp_child_enqueue_parent_style() {
	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme)
	$theme   = wp_get_theme( 'OceanWP' );
	$version = $theme->get( 'Version' );
	// Load the stylesheet
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), $version );
	
}
add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );

// Add custom font to font settings
function ocean_add_custom_fonts() {
	return array( 'Jotia-Medium', 'FoundrySterling-Medium' ); // You can add more then 1 font to the array!
}

function my_post_layout_class( $class ) {

	// Alter your layout
	if (function_exists('tribe_is_event')) {
		if ( tribe_is_event()
		|| tribe_is_view()
		|| tribe_is_list_view()
		|| tribe_is_event_category()
		|| tribe_is_in_main_loop()
		|| tribe_is_day()
		|| tribe_is_month()
		|| is_singular( 'tribe_events' ) ) {
		$class = 'left-sidebar';
		}
	}

	// Return correct class
	return $class;

}
add_filter( 'ocean_post_layout_class', 'my_post_layout_class', 20 );