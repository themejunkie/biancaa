<?php
/**
 * Custom template tags for this theme.
 * Eventually, some of the functionality here could be replaced by core features.
 * 
 * @package    Biancaa
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'biancaa_site_branding' ) ) :
/**
 * Site branding for the site.
 * 
 * Display site title by default, but user can change it with their custom logo.
 * They can upload it on Customizer admin screen.
 * 
 * @since  1.0.0
 */
function biancaa_site_branding() {

	// Get the logo setting.
	$logo = get_theme_mod( 'biancaa_logo' );

	// Get the gravatar setting.
	$show_gravatar  = get_theme_mod( 'biancaa_show_gravatar', 0 );
	$email_gravatar = is_email( get_theme_mod( 'biancaa_gravatar_email', get_option( 'admin_email' ) ) );

	// Display the gravatar.
	if ( $show_gravatar === 1 && ! empty( $email_gravatar ) ) {
		echo get_avatar( $email_gravatar, 100, 'mystery', esc_attr( get_bloginfo( 'name' ) ) );
	}

	// Check if the logo exist, then display it.
	if ( $logo ) {
		echo '<div class="site-logo">' . "\n";
			echo '<a href="' . esc_url( get_home_url() ) . '" rel="home">' . "\n";
				echo '<img class="logo" src="' . esc_url( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
			echo '</a>' . "\n";
		echo '</div>' . "\n";

	// If not, then display the Site Title and Site Description.
	} else {
		echo '<h1 class="site-title"><a href="' . esc_url( get_home_url() ) . '" rel="home">' . esc_attr( get_bloginfo( 'name' ) ) . '</a></h1>';
		echo '<h2 class="site-description">' . esc_attr( get_bloginfo( 'description' ) ) . '</h2>';
	}

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @since  1.0.0
 * @return bool
 */
function biancaa_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'biancaa_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'biancaa_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so biancaa_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so biancaa_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in biancaa_categorized_blog.
 *
 * @since 1.0.0
 */
function biancaa_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'biancaa_categories' );
}
add_action( 'edit_category', 'biancaa_category_transient_flusher' );
add_action( 'save_post',     'biancaa_category_transient_flusher' );

if ( ! function_exists( 'biancaa_post_thumbnail' ) ) :
/**
 * Featured thumbnail.
 *
 * @since  1.0.0
 */
function biancaa_post_thumbnail() {

	// Setup empty variable.
	$size   = '';

	// Get the layout setting.
	$layout = get_post_layout( get_queried_object_id() );
	$global = get_theme_mod( 'theme_layout' );

	// Check the layout.
	if ( '1c-narrow' === $layout || '1c-narrow' === $global ) {
		$size = 'biancaa-featured-big';
	} elseif ( '1c' === $layout || '1c' === $global && ! is_archive() && ! is_search() ) {
		$size = 'biancaa-featured-full';
	} else {
		$size = 'biancaa-featured';
	}

	// Display the thumbnail along with the size.
	the_post_thumbnail( $size, array( 'alt' => esc_attr( get_the_title() ) ) );
}
endif;

if ( ! function_exists( 'biancaa_featured_content' ) ) :
/**
 * Sets up the featured posts based on user selected tag.
 *
 * @since  1.0.0
 */
function biancaa_featured_content() {
	global $post;

	// Bail if not on home page.
	if ( ! is_home() ) {
		return;
	}
	
	// Get the featured posts setting value.
	$tag   = get_theme_mod( 'biancaa_featured_posts', 'featured' );
	$count = get_theme_mod( 'biancaa_featured_posts_count', 5 );

	// Check if the tag is not empty.
	if ( empty( $tag ) ) {
		return;
	}

	// Get any existing copy of our transient data.
	if ( false === ( $featured = get_transient( 'biancaa_featured_posts' ) ) ) {
		// It wasn't there, so regenerate the data and save the transient.
		
		// Posts query arguments.
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => (int) $count,
			'tag'            => esc_attr( $tag )
		);

		// The post query
		$featured = get_posts( $args );

		// Store the transient.
		set_transient( 'biancaa_featured_posts', $featured );
	}

	// Check if the post(s) exist.
	if ( $featured ) :

		$html = '<div class="featured-slides">';

			$html .= '<div class="container">';
				$html .= '<div class="slides">';

					foreach ( $featured as $post ) :
						setup_postdata( $post );

						$html .= '<div class="slides-item">';
							$html .= '<a href="' . esc_url( get_permalink( $post->ID ) ) . '" rel="bookmark">';
								if ( has_post_thumbnail( $post->ID ) ) {
									$html .= get_the_post_thumbnail( $post->ID, 'biancaa-slides', array( 'alt' => esc_attr( get_the_title( $post->ID ) ) ) );
								}
								$html .= '<div class="slide-data">';
									$html .= '<h1 class="slide-title">' . esc_attr( get_the_title( $post->ID ) ) . '</h1>';
									$html .= '<time class="published" datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time>';
								$html .= '</div>';
							$html .= '</a>';
						$html .= '</div>';

					endforeach;

				$html .= '</div><!-- .slides -->';
			$html .= '</div><!-- .container -->';

		$html .= '</div><!-- .featured-slides -->';

	// End check.
	endif;

	// Restore original post data.
	wp_reset_postdata();

	// Display the featured content.
	if ( ! empty( $html ) ) {
		echo $html;
	}

}
endif;

/**
 * Flush out the transients used in biancaa_featured_content.
 *
 * @since 1.0.0
 */
function biancaa_featured_content_transient_flusher() {
	delete_transient( 'biancaa_featured_posts' );
}
add_action( 'save_post'     , 'biancaa_featured_content_transient_flusher' );
add_action( 'customize_save', 'biancaa_featured_content_transient_flusher' );

if ( ! function_exists( 'biancaa_pre_get_posts' ) ) :
/**
 * Exclude featured posts from the home page blog query.
 *
 * @since  1.0.0
 */
function biancaa_pre_get_posts( $query ) {

	// Bail if not home or not main query.
	if ( ! $query->is_home() || ! $query->is_main_query() ) {
		return;
	}

	$page_on_front = get_option( 'page_on_front' );

	// Bail if the blog page is not the front page.
	if ( ! empty( $page_on_front ) ) {
		return;
	}

	// Get the tag.
	$featured = get_theme_mod( 'biancaa_featured_posts', 'featured' );

	// Bail if no featured posts.
	if ( ! $featured ) {
		return;
	}

	// Get the tag name.
	$exclude = get_term_by( 'name', $featured, 'post_tag' );

	// Exclude the main query.
	if ( ! empty( $exclude ) ) {
		$query->set( 'tag__not_in', $exclude->term_id );
	}

}
add_action( 'pre_get_posts', 'biancaa_pre_get_posts' );
endif;

if ( ! function_exists( 'biancaa_featured_text' ) ) :
/**
 * Sets up the featured text.
 *
 * @since  1.0.0
 */
function biancaa_featured_text() {

	// Bail if not on home page.
	if ( ! is_home() ) {
		return;
	}

	// Get the featured text.
	$text = get_theme_mod( 'biancaa_featured_text' );

	if ( $text ) {
		echo '<div class="featured-text"><p>' . wp_filter_post_kses( stripslashes( $text ) ) . '</p></div>';
	}

}
endif;

if ( ! function_exists( 'biancaa_related_posts' ) ) :
/**
 * Related posts.
 *
 * @since  1.0.0
 */
function biancaa_related_posts() {

	// Only display related posts on single post.
	if ( ! is_single() ) {
		return;
	}

	// Get the taxonomy terms of the current page for the specified taxonomy.
	$terms = wp_get_post_terms( get_the_ID(), 'category', array( 'fields' => 'ids' ) );

	// Bail if term empty.
	if ( empty( $terms ) ) {
		return;
	}

	// Query arguments.
	$query = array(
		'tax_query' => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'id',
				'terms'    => $terms,
				'operator' => 'IN'
			)
		),
		'posts_per_page' => 3,
		'exclude'        => get_the_ID(),
		'post_type'      => 'post',
	);

	// Allow plugins/themes developer to filter the default query.
	$query = apply_filters( 'biancaa_related_posts_query', $query );

	// Perform the query.
	$related = new WP_Query( $query );
	
	if ( $related->have_posts() ) :

		$html = '<div id="related-posts" class="related-posts">';

			$html .= '<h3>' . __( 'Related Articles &hellip;', 'biancaa' ) . '</h3>';
			$html .= '<ul class="related-items">';

				while ( $related->have_posts() ) :
					$related->the_post();

					$html .= '<li>';

						if ( has_post_thumbnail() ) {
							$html .=  '<a href="' . get_permalink() . '" rel="bookmark">' . get_the_post_thumbnail( get_the_ID(), 'biancaa-related', array( 'class' => 'related-thumb', 'alt' => esc_attr( get_the_title() ) ) ) . '</a>';
						}
						$html .= '<h2 class="related-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . esc_attr( get_the_title() ) . '</a></h2>';
						$html .= '<time class="entry-published" datetime="' . esc_html( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time>';

					$html .= '</li>';

				endwhile;

			$html .= '</ul>';

		$html .= '</div><!-- #related-posts -->';

	endif;

	// Restore original Post Data.
	wp_reset_postdata();

	if ( isset( $html ) ) {
		echo $html;
	}

}
endif;

if ( ! function_exists( 'biancaa_post_author' ) ) :
/**
 * Author post informations.
 *
 * @since  1.0.0
 */
function biancaa_post_author() {

	// Bail if not on the single post.
	if ( ! is_single() ) {
		return;
	}

	// Bail if user hasn't fill the Biographical Info field.
	if ( ! get_the_author_meta( 'description' ) ) {
		return;
	}
?>

	<section class="author-box">
		<?php echo get_avatar( is_email( get_the_author_meta( 'user_email' ) ), apply_filters( 'biancaa_author_bio_avatar_size', 72 ) ); ?>
		<p class="author-title">
			<a class="author-name url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo strip_tags( get_the_author() ); ?></a>
		</p>
		<p><?php echo stripslashes( get_the_author_meta( 'description' ) ); ?></p>
	</section><!-- .author-box -->

<?php
}
endif;