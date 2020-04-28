<?php
/**
 * Biancaa Theme Customizer.
 *
 * @package    Biancaa
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Load textarea function for customizer.
 *
 * @since 1.0.0
 */
function biancaa_textarea_customize_control() {
	require trailingslashit( get_template_directory() ) . 'inc/classes/customize-control-textarea.php';
}
add_action( 'customize_register', 'biancaa_textarea_customize_control', 1 );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since 1.0.0
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function biancaa_customize_register( $wp_customize ) {
	
	// Enable live preview.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

	// Biancaa Settings Panel
	$wp_customize->add_panel( 'biancaa_settings', array(
		'priority'    => 150,
		'capability'  => 'edit_theme_options',
		'title'       => __( 'Biancaa Settings', 'biancaa' ),
		'description' => __( 'This panel is provides several options from the theme.', 'biancaa' ),
	) );

	// Show hide gravatar setting.
	$wp_customize->add_setting( 
		'biancaa_show_gravatar',
		array(
			'default'           => 0,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'biancaa_sanitize_checkbox'
		) 
	);

		// Show hide gravatar control.
		$wp_customize->add_control(
			'biancaa_show_gravatar_control',
			array(
				'label'    => esc_html__( 'Show gravatar above the Site Title', 'biancaa' ),
				'type'     => 'checkbox',
				'section'  => 'title_tagline',
				'settings' => 'biancaa_show_gravatar'
			)
		);

	// Gravatar email setting.
	$wp_customize->add_setting( 
		'biancaa_gravatar_email',
		array(
			'default'           => get_option( 'admin_email' ),
			'sanitize_callback' => 'is_email',
			'capability'        => 'edit_theme_options'
		) 
	);

		// Gravatar email control.
		$wp_customize->add_control(
			'biancaa_gravatar_email_control',
			array(
				'label'    => esc_html__( 'Gravatar Email', 'biancaa' ),
				'section'  => 'title_tagline',
				'settings' => 'biancaa_gravatar_email'
			)
		);


	// Adds "Logo Settings" section to the Theme Customization screen.
	$wp_customize->add_section(
		'biancaa_logo_settings',
		array(
			'title'    => esc_html__( 'Logo', 'biancaa' ),
			'priority' => 20,
			'panel'    => 'biancaa_settings'
		)
	);

		// Logo setting.
		$wp_customize->add_setting(
			'biancaa_logo',
			array(
				'sanitize_callback' => 'esc_url_raw',
				'capability'        => 'edit_theme_options'
			)
		);

			// Logo control.
			$wp_customize->add_control(
				new WP_Customize_Image_Control( $wp_customize, 'biancaa_logo_control',
				array(
					'label'    => esc_html__( 'Upload Logo', 'biancaa' ),
					'section'  => 'biancaa_logo_settings',
					'settings' => 'biancaa_logo'
				)
			) );

	// Adds "Featured Posts Settings" section to the Theme Customization screen.
	$wp_customize->add_section(
		'biancaa_featured_settings',
		array(
			'title'       => esc_html__( 'Featured Posts', 'biancaa' ),
			'description' => esc_html__( 'Featured posts slider, display a list of posts in a smooth slide effect.', 'biancaa' ),
			'priority'    => 30,
			'panel'       => 'biancaa_settings'
		)
	);

		// Featured Posts setting.
		$wp_customize->add_setting(
			'biancaa_featured_posts',
			array(
				'default'           => 'featured',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options'
			)
		);

			// Featured Posts control.
			$wp_customize->add_control(
				'biancaa_featured_posts_control',
				array(
					'label'    => esc_html__( 'Tag slug for featured post', 'biancaa' ),
					'section'  => 'biancaa_featured_settings',
					'settings' => 'biancaa_featured_posts'
				)
			);

		// Featured Posts setting.
		$wp_customize->add_setting(
			'biancaa_featured_posts_count',
			array(
				'default'           => 5,
				'sanitize_callback' => 'absint',
				'capability'        => 'edit_theme_options'
			)
		);

			// Featured Posts control.
			$wp_customize->add_control(
				'biancaa_featured_posts_count_control',
				array(
					'label'    => esc_html__( 'Number of posts:', 'biancaa' ),
					'section'  => 'biancaa_featured_settings',
					'settings' => 'biancaa_featured_posts_count'
				)
			);

	// Adds "Featured Text Settings" section to the Theme Customization screen.
	$wp_customize->add_section(
		'biancaa_featured_text_settings',
		array(
			'title'       => esc_html__( 'Featured Text', 'biancaa' ),
			'description' => esc_html__( 'The text will appear on home page, below featured posts slider.', 'biancaa' ),
			'priority'    => 32,
			'panel'       => 'biancaa_settings'
		)
	);

		// Featured Text setting.
		$wp_customize->add_setting(
			'biancaa_featured_text',
			array(
				'sanitize_callback' => 'wp_filter_post_kses',
				'capability'        => 'edit_theme_options'
			)
		);

			// Featured Text control.
			$wp_customize->add_control( new Biancaa_Customize_Control_Textarea( $wp_customize, 'biancaa_featured_text_control',
				array(
					'label'    => '',
					'section'  => 'biancaa_featured_text_settings',
					'settings' => 'biancaa_featured_text'
				)
			) );

	// Adds "Color Schemes Settings" section to the Theme Customization screen.
	$wp_customize->add_section(
		'biancaa_color_schemes_settings',
		array(
			'title'       => esc_html__( 'Color Schemes', 'biancaa' ),
			'description' => esc_html__( 'We provide a few premade color schemes to choose but you can also choose a custom colors.', 'biancaa' ),
			'priority'    => 35,
			'panel'       => 'biancaa_settings'
		)
	);

		// Color schemes chooser settings.
		$wp_customize->add_setting(
			'biancaa_schemes_chooser',
			array(
				'default'           => 'premade',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_key'
			)
		);

			// Color schemes chooser control.
			$wp_customize->add_control(
				'biancaa_schemes_chooser_control',
				array(
					'label'    => '',
					'section'  => 'biancaa_color_schemes_settings',
					'settings' => 'biancaa_schemes_chooser',
					'priority' => 1,
					'type'     => 'radio',
					'choices'  => array(
						'premade' => esc_html__( 'Premade Colors', 'biancaa' ),
						'custom' => esc_html__( 'Custom Colors', 'biancaa' )
					)
				)
			);

		// Color Schemes setting.
		$wp_customize->add_setting(
			'biancaa_color_schemes',
			array(
				'default'           => 'default',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_key'
			)
		);

			// Color Schemes control.
			$wp_customize->add_control(
				'biancaa_schemes_control',
				array(
					'label'    => esc_html__( 'Color Schemes', 'biancaa' ),
					'section'  => 'biancaa_color_schemes_settings',
					'settings' => 'biancaa_color_schemes',
					'priority' => 2,
					'type'     => 'radio',
					'choices'  => array(
						'default'     => esc_html__( 'Default', 'biancaa' ),
						'emerald'     => esc_html__( 'Emerald', 'biancaa' ),
						'flatred'     => esc_html__( 'Flat Red', 'biancaa' ),
						'magenta'     => esc_html__( 'Magenta', 'biancaa' ),
						'peter-river' => esc_html__( 'Blue', 'biancaa' ),
						'wisteria'    => esc_html__( 'Purple', 'biancaa' ),
					)
				)
			);

		// Color Accent setting.
		$wp_customize->add_setting(
			'biancaa_color_accent',
			array(
				'default'           => '#000000',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color'
			)
		);

			// Color Accent control.
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'biancaa_color_accent_control',
				array(
					'label'    => esc_html__( 'Custom Colors', 'biancaa' ),
					'section'  => 'biancaa_color_schemes_settings',
					'settings' => 'biancaa_color_accent',
					'priority' => 3
				)
			) );

}
add_action( 'customize_register', 'biancaa_customize_register' );

/**
 * Move 'Layout' section to 'biancaa_settings' panel
 *
 * @since 1.0.0
 */
function biancaa_layout_customizer( $wp_customize ) {
	$wp_customize->get_section( 'layout' )->panel    = 'biancaa_settings';
	$wp_customize->get_section( 'layout' )->title    = __( 'Global Layout', 'biancaa' );
	$wp_customize->get_section( 'layout' )->priority = 1;
}
add_action( 'customize_register', 'biancaa_layout_customizer', 99 );

/**
 * Sanitize a checkbox to only allow 0 or 1
 *
 * @since  1.0.1
 */
function biancaa_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
    } else {
		return 0;
    }
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0.0
 */
function biancaa_customize_preview_js() {
	wp_enqueue_script( 'biancaa_customizer', trailingslashit( get_template_directory_uri() ) . 'assets/js/customizer.js', array( 'customize-preview' ), null, true );
}
add_action( 'customize_preview_init', 'biancaa_customize_preview_js' );

/**
 * Add Custom Color Scheme Styles.
 *
 * @since 1.0.0
 */
function biancaa_color_schemes_css() {

	// Get the color schemes.
	$color  = get_theme_mod( 'biancaa_color_schemes', 'default' );
	$scheme = get_theme_mod( 'biancaa_schemes_chooser', 'premade' );

	// Check if user choose the premade color schemes.
	if ( $scheme !== 'premade' ) {
		return;
	}
	
	// Enqueue the stylesheet.
	wp_enqueue_style( 'biancaa-color-schemes', trailingslashit( get_template_directory_uri() ) . 'assets/css/skin-' . $color . '.css', null, null, 'all' );
}
add_action( 'wp_enqueue_scripts', 'biancaa_color_schemes_css', 10 );

/**
 * Customizer css output.
 *
 * @since 1.0.0
 */
function biancaa_customize_css() {
	
	$accent = get_theme_mod( 'biancaa_color_accent', '#000000' );
	$scheme = get_theme_mod( 'biancaa_schemes_chooser', 'premade' );

	if ( $scheme !== 'custom'  ) {
		return;
	}
?>
<style type="text/css">
/* Custom Accent Color. */
.menu-primary-items li.current-menu-item a,.menu-primary-items a:hover,.menu-primary-items .sub-menu,.menu-primary-items li.sfHover .sf-with-ul,.owl-theme .owl-controls .owl-page.active span.owl-numbers,.owl-theme .owl-controls .owl-page span.owl-numbers:hover,.slides-item:hover .slide-title,.slides-item:hover .published,.post .img-link:hover>.entry-title,.post .img-link:hover>.published,.pagination .page-numbers.current,.pagination .page-numbers:hover,button,a.button,input[type=reset],input[type=submit],input[type=button],.menu-primary-items .sub-menu a:hover,button:hover,a.button:hover,input[type=reset]:hover,input[type=submit]:hover,input[type=button]:hover {
	background-color: <?php echo $accent; ?>;
}
a:link, a:visited, .site-header .site-title a,a:hover, a:visited:hover,.entry-header .entry-byline,.entry-header .entry-byline a,.entry-header .entry-byline a:hover {
	color: <?php echo $accent; ?>;
}
.pagination .page-numbers.current,.pagination .page-numbers:hover,button,a.button,input[type=reset],input[type=submit],input[type=button] {
	border-color: <?php echo $accent; ?>;
}
.main-navigation .menu-wrapper {
	border-bottom: 5px solid <?php echo $accent; ?>;
}
.menu-primary-items a:hover,
.menu-primary-items a:visited:hover {
	color: #fff;
}
</style>
<?php
}
add_action( 'wp_head', 'biancaa_customize_css', 11 );