<?php
/**
 * Demo importer custom function
 * We use https://wordpress.org/plugins/one-click-demo-import/ to import our demo content
 */

/**
 * Define demo file
 */
function biancaa_import_files() {
	return array(
		array(
			'import_file_name'             => 'Demo Standard',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo/dummy-data.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demo/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/demo/customizer.dat',
			'import_preview_image_url'     => trailingslashit( get_template_directory() ) . 'screenshot.png'
		),
	);
}
add_filter( 'pt-ocdi/import_files', 'biancaa_import_files' );

/**
 * After import function
 */
function biancaa_after_import_setup() {

	// Assign menus to their locations.
	$primary = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
	$social  = get_term_by( 'name', 'Social Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary' => $primary->term_id,
			'social'  => $social->term_id
		)
	);

}
add_action( 'pt-ocdi/after_import', 'biancaa_after_import_setup' );
