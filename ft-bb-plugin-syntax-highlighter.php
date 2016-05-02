<?php
/**
 * Plugin Name: Syntax Highlighter Module for Beaver Builder
 * Plugin URI: http://firetreedesign.com/
 * Description: Display code neatly with syntax highlighting.
 * Version: 1.0
 * Author: FireTree Design, LLC
 * Author URI: http://firetreedesign.com
 */
define( 'FT_BB_SYNTAX_HIGHLIGHTER_DIR', plugin_dir_path( __FILE__ ) );
define( 'FT_BB_SYNTAX_HIGHLIGHTER_URL', plugins_url( '/', __FILE__ ) );

/**
 * Load the module
 */
function ft_syntax_highlighter_load_module() {
	if ( class_exists( 'FLBuilder' ) ) {
	    require_once 'ft-syntax-highlighter/ft-syntax-highlighter.php';
		require_once 'includes/customizer.php';
	}
}
add_action( 'init', 'ft_syntax_highlighter_load_module' );
