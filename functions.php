<?php
/**
 * Theme functions file
 *
 * Contains all of the Theme's setup functions, custom functions,
 * custom hooks and Theme settings.
 * 
 * @package    Biancaa
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660; /* pixels */
}

if ( ! function_exists( 'biancaa_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since  1.0.0
 */
function biancaa_theme_setup() {

	// Make the theme available for translation.
	load_theme_textdomain( 'biancaa', trailingslashit( get_template_directory() ) . 'languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Declare image sizes.
	add_image_size( 'biancaa-featured', 660, 330, true );
	add_image_size( 'biancaa-featured-big', 800, 370, true );
	add_image_size( 'biancaa-featured-full', 960, 370, true );
	add_image_size( 'biancaa-slides', 960, 400, true );
	add_image_size( 'biancaa-widget', 262, 200, true );
	add_image_size( 'biancaa-related', 195, 110, true );

	// Register custom navigation menu.
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'biancaa' ),
			'social'  => __( 'Social Menu' , 'biancaa' ),
		)
	);

	// Add custom stylesheet file to the TinyMCE visual editor.
	add_editor_style( array( 'assets/css/editor-style.css' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'biancaa_custom_background_args', array(
		'default-color' => 'f2f2f2'
	) ) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list', 'search-form', 'comment-form', 'gallery', 'caption'
	) );

	// Enable theme-layouts extensions.
	add_theme_support( 
		'theme-layouts', 
		array(
			'1c'        => __( '1 Column Wide', 'biancaa' ),
			'1c-narrow' => __( '1 Column Narrow', 'biancaa' ),
			'2c-l'      => __( '2 Columns: Content / Sidebar', 'biancaa' ),
			'2c-r'      => __( '2 Columns: Sidebar / Content', 'biancaa' )
		),
		array( 'default' => '2c-l' ) 
	);

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

}
endif; // biancaa_theme_setup
add_action( 'after_setup_theme', 'biancaa_theme_setup' );

/**
 * Registers sidebars.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function biancaa_register_sidebars() {

	register_sidebar(
		array(
			'name'          => _x( 'Primary', 'sidebar', 'biancaa' ),
			'id'            => 'primary',
			'description'   => __( 'The main sidebar.', 'biancaa' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		)
	);

	register_sidebar(
		array(
			'name'          => _x( 'Subsidiary', 'sidebar', 'biancaa' ),
			'id'            => 'subsidiary',
			'description'   => __( 'The sidebar will appear on the footer of your site.', 'biancaa' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		)
	);
	
}
add_action( 'widgets_init', 'biancaa_register_sidebars' );

/**
 * Register Raleway Google font.
 *
 * @since  1.0.4
 * @return string
 */
function biancaa_raleway_font_url() {
	
	$raleway_font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Raleway, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'tj_basic' ) ) {
		$raleway_font_url = add_query_arg( 'family', urlencode( 'Raleway:400' ), "//fonts.googleapis.com/css" );
	}

	return $raleway_font_url;
}

/**
 * Register Open Sans Google font.
 *
 * @since  1.0.4
 * @return string
 */
function biancaa_open_sans_font_url() {
	
	$opensans_font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'tj_basic' ) ) {
		$opensans_font_url = add_query_arg( 'family', urlencode( 'Open Sans:400italic,600italic,400,600' ), "//fonts.googleapis.com/css" );
	}

	return $opensans_font_url;
}

/**
 * Custom template tags for this theme.
 */
require trailingslashit( get_template_directory() ) . 'inc/template-tags.php';

/**
 * Enqueue scripts and styles.
 */
require trailingslashit( get_template_directory() ) . 'inc/scripts.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require trailingslashit( get_template_directory() ) . 'inc/extras.php';

/**
 * Customizer additions.
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer.php';

/**
 * We use some part of Hybrid Core to extends our themes.
 *
 * @link  http://themehybrid.com/hybrid-core Hybrid Core site.
 */
require trailingslashit( get_template_directory() ) . 'inc/hybrid/loop-pagination.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/theme-layouts.php';

/**
 * Custom widgets.
 */
require trailingslashit( get_template_directory() ) . 'inc/classes/widget-about.php';
require trailingslashit( get_template_directory() ) . 'inc/classes/widget-slides.php';