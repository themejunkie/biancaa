<?php
/**
 * About widget.
 *
 * @package    Biancaa
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Biancaa_Posts_Slides_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-biancaa-posts-slides',
			'description' => __( 'Display recent post thumbnails in a slides mode.', 'biancaa' )
		);

		// Create the widget.
		$this->WP_Widget(
			'biancaa-posts-slides',                        // $this->id_base
			__( 'Biancaa - Thumbnail Slides', 'biancaa' ), // $this->name
			$widget_options                                // $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base ) . $after_title;
		} 

		// Perform the query.
		$posts = get_posts( array( 'posts_per_page' => absint( $instance['count'] ) ) );

		if ( $posts ) {
			echo '<div class="posts-slides">';
				echo '<div class="slides">';

					foreach( $posts as $post ) {
						setup_postdata( $post );

						echo '<div class="slide-item">';
							if ( has_post_thumbnail( $post->ID ) ) {
								echo '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">' . get_the_post_thumbnail( $post->ID, 'biancaa-widget', array( 'alt' => esc_attr( get_the_title( $post->ID ) ) ) ) . '</a>';
							}
						echo '</div>';

					}

				echo '</div>';
			echo '</div>';
		}

		// Restore original Post Data.
		wp_reset_postdata();

		// Close the theme's widget wrapper.
		echo $after_widget;

	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 1.0.0
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $new_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = absint( $new_instance['count'] );

		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 1.0.0
	 */
	function form( $instance ) {

		// Default value.
		$defaults = array(
			'title' => '',
			'count' => 5,
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title:', 'biancaa' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>">
				<?php _e( 'Number of Posts:', 'biancaa' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo (int)$instance['count']; ?>" />
		</p>

	<?php

	}

}

/**
 * Register the widget.
 *
 * @since  1.0.0
 */
function biancaa_register_slides_widget() {
	register_widget( 'Biancaa_Posts_Slides_Widget' );
}
add_action( 'widgets_init', 'biancaa_register_slides_widget' );