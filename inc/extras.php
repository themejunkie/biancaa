<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package    Biancaa
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since  1.0.0
 * @param  array $args Configuration arguments.
 * @return array
 */
function biancaa_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'biancaa_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the body element.
 * @return array
 */
function biancaa_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a custom class on about page.
	if ( is_page_template( 'page-templates/about.php' ) ) {
		$classes[] = 'about';
	}

	$text = get_theme_mod( 'biancaa_featured_text' );
	if ( ! empty( $text ) && is_home() ) {
		$classes[] = 'has-featured-text';
	}

	return $classes;
}
add_filter( 'body_class', 'biancaa_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the post element.
 * @return array
 */
function biancaa_post_classes( $classes ) {
	// Adds a class custom class on singular post.
	if ( is_single() ) {
		$classes[] = 'singular-post';
	}

	// Adds a class if a post hasn't a thumbnail.
	if ( ! has_post_thumbnail() ) {
		$classes[] = 'no-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'biancaa_post_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function biancaa_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'biancaa' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'biancaa_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function biancaa_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'biancaa_render_title' );
endif;

/**
 * Change the excerpt more string.
 *
 * @since  1.0.0
 * @param  string  $more
 */
function biancaa_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'biancaa_excerpt_more' );

/**
 * Control the excerpt length.
 *
 * @since  1.0.0
 * @param  $length
 */
function biancaa_excerpt_length( $length ) {
	return 70;
}
add_filter( 'excerpt_length', 'biancaa_excerpt_length', 999 );

/**
 * Modifies the theme layout on archive and search pages.
 *
 * @since  1.0.0
 * @param  string  $layout
 */
function biancaa_mod_theme_layout( $layout ) {
	if ( is_archive() || is_search() ) {
		$layout = '1c';
	}

	if ( is_page_template( 'page-templates/about.php' ) ) {
		$layout = '1c';
	}

	return $layout;
}
add_filter( 'theme_mod_theme_layout', 'biancaa_mod_theme_layout', 15 );

/**
 * Remove theme-layouts meta box on attachment post type.
 * 
 * @since 1.0.0
 */
function biancaa_remove_theme_layout_metabox() {
	remove_post_type_support( 'attachment', 'theme-layouts' );
}
add_action( 'init', 'biancaa_remove_theme_layout_metabox', 11 );

/**
 * Register custom contact info fields.
 *
 * @since  1.0.0
 * @param  array $contactmethods
 * @return array
 */
function biancaa_contact_info_fields( $contactmethods ) {
	$contactmethods['facebook'] = 'Facebook';
	$contactmethods['twitter']  = 'Twitter';
	$contactmethods['linkedin'] = 'LinkedIn';
	$contactmethods['dribbble'] = 'Dribbble';

	return $contactmethods;
}
add_filter( 'user_contactmethods', 'biancaa_contact_info_fields' );

/**
 * Extend archive title
 *
 * @since  1.0.0
 */
function biancaa_extend_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'biancaa_extend_archive_title' );

/**
 * Customize tag cloud widget
 *
 * @since  1.0.0
 */
function biancaa_customize_tag_cloud( $args ) {
	$args['largest']  = 12;
	$args['smallest'] = 12;
	$args['unit']     = 'px';
	$args['number']   = 20;
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'biancaa_customize_tag_cloud' );