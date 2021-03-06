<?php
/**
 * Enqueue scripts and styles.
 *
 * @package    Biancaa
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Loads the theme styles & scripts.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @link  http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 */
function biancaa_enqueue() {

	// Load google fonts.
	wp_enqueue_style( 'biancaa-raleway', biancaa_raleway_font_url(), array(), null );
	wp_enqueue_style( 'biancaa-opensans', biancaa_open_sans_font_url(), array(), null );

	// Load plugins stylesheet
	wp_enqueue_style( 'delivery-plugins-style', trailingslashit( get_template_directory_uri() ) . 'assets/css/plugins.min.css' );

	// if WP_DEBUG and/or SCRIPT_DEBUG turned on, load the unminified styles & script.
	if ( ! is_child_theme() && WP_DEBUG || SCRIPT_DEBUG ) {

		// Load main stylesheet
		wp_enqueue_style( 'biancaa-style', get_stylesheet_uri(), array( 'dashicons' ) );

		// Load custom js plugins.
		wp_enqueue_script( 'biancaa-plugins', trailingslashit( get_template_directory_uri() ) . 'assets/js/plugins.min.js', array( 'jquery' ), null, true );

		// Load custom js methods.
		wp_enqueue_script( 'biancaa-main', trailingslashit( get_template_directory_uri() ) . 'assets/js/main.js', array( 'jquery' ), null, true );

	} else {

		// Load main stylesheet
		wp_enqueue_style( 'biancaa-style', trailingslashit( get_template_directory_uri() ) . 'style.min.css', array( 'dashicons' ) );

		// Load custom js plugins.
		wp_enqueue_script( 'biancaa-scripts', trailingslashit( get_template_directory_uri() ) . 'assets/js/biancaa.min.js', array( 'jquery' ), null, true );

	}

	// If child theme is active, load the stylesheet.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'biancaa-child-style', get_stylesheet_uri() );
	}

	// Load comment-reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'biancaa_enqueue' );
