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
class Biancaa_About_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-biancaa-about',
			'description' => __( 'Display your profile info.', 'biancaa' )
		);

		// Create the widget.
		$this->WP_Widget(
			'biancaa-about',                    // $this->id_base
			__( 'Biancaa - About', 'biancaa' ), // $this->name
			$widget_options                     // $this->widget_options
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

		echo '<div class="about-widget-content">';

			if ( $instance['gravatar'] ) {
				echo get_avatar( $instance['gravatar'], 70 );
			}

			if ( $instance['bio'] ) {
				echo '<p>' . stripslashes( $instance['bio'] ) . '</p>';
			}

			echo '<ul>';
				if ( $instance['twitter'] ) {
					echo '<li><a href="' . esc_url( $instance['twitter'] ) . '"><span class="genericon genericon-twitter"></span></a></li>';
				} 

				if ( $instance['facebook'] ) {
					echo '<li><a href="' . esc_url( $instance['facebook'] ) . '"><span class="genericon genericon-facebook"></span></a></li>';
				}

				if ( $instance['gplus'] ) {
					echo '<li><a href="' . esc_url( $instance['gplus'] ) . '"><span class="genericon genericon-googleplus"></span></a></li>';
				}

				if ( $instance['linkedin'] ) {
					echo '<li><a href="' . esc_url( $instance['linkedin'] ) . '"><span class="genericon genericon-linkedin-alt"></span></a></li>';
				}
			echo '</ul>';

		echo '</div>';

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
		$instance['title']    = strip_tags( $new_instance['title'] );
		$instance['gravatar'] = is_email( $new_instance['gravatar'] );
		$instance['bio']      = wp_filter_post_kses( $new_instance['bio'] );
		$instance['twitter']  = esc_url_raw( $new_instance['twitter'] );
		$instance['facebook'] = esc_url_raw( $new_instance['facebook'] );
		$instance['gplus']    = esc_url_raw( $new_instance['gplus'] );
		$instance['linkedin'] = esc_url_raw( $new_instance['linkedin'] );

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
			'title'    => '',
			'gravatar' => get_option( 'admin_email' ),
			'bio'      => '',
			'twitter'  => '',
			'facebook' => '',
			'gplus'    => '',
			'linkedin' => '',
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
			<label for="<?php echo $this->get_field_id( 'gravatar' ); ?>">
				<?php _e( 'Gravatar Email:', 'biancaa' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'gravatar' ); ?>" name="<?php echo $this->get_field_name( 'gravatar' ); ?>" value="<?php echo is_email( $instance['gravatar'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'bio' ); ?>">
				<?php _e( 'Biographical Info:', 'biancaa' ); ?>
			</label>
			<textarea class="widefat" name="<?php echo $this->get_field_name( 'bio' ); ?>" id="<?php echo $this->get_field_id( 'bio' ); ?>" cols="30" rows="5"><?php echo stripslashes( $instance['bio'] ); ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>">
				<?php _e( 'Twitter:', 'biancaa' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" placeholder="<?php echo esc_attr( 'http://' ); ?>" value="<?php echo esc_url( $instance['twitter'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>">
				<?php _e( 'Facebook:', 'biancaa' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" placeholder="<?php echo esc_attr( 'http://' ); ?>" value="<?php echo esc_url( $instance['facebook'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'gplus' ); ?>">
				<?php _e( 'Google Plus:', 'biancaa' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'gplus' ); ?>" name="<?php echo $this->get_field_name( 'gplus' ); ?>" placeholder="<?php echo esc_attr( 'http://' ); ?>" value="<?php echo esc_url( $instance['gplus'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>">
				<?php _e( 'LinkedIn:', 'biancaa' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" placeholder="<?php echo esc_attr( 'http://' ); ?>" value="<?php echo esc_url( $instance['linkedin'] ); ?>" />
		</p>

	<?php

	}

}

/**
 * Register the widget.
 *
 * @since  1.0.0
 */
function biancaa_register_about_widget() {
	register_widget( 'Biancaa_About_Widget' );
}
add_action( 'widgets_init', 'biancaa_register_about_widget' );