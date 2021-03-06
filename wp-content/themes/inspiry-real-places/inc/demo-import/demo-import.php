<?php
if ( ! function_exists( 'inspiry_demo_import_files' ) ) {

	/**
	 * Files for importing demo.
	 *
	 * @return array
	 * @since  1.7.0
	 */
	function inspiry_demo_import_files() {
		return array(
			array(
				'import_file_name'             => 'Real Places',
				'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo-import/default-demo/content.xml',
				'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demo-import/default-demo/widgets.wie',
				'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/demo-import/default-demo/inspiry-customizer.dat',
				'local_import_redux'           => array(
					array(
						'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demo-import/default-demo/inspiry_options.json',
						'option_name' => 'inspiry_options',
					)
				),
				'import_preview_image_url'     => get_template_directory_uri() . '/inc/demo-import/default-demo/screen-image.jpg',
				'preview_url'                  => 'http://realplaces-min.inspirydemos.com/',
			),
		);
	}

	add_filter( 'pt-ocdi/import_files', 'inspiry_demo_import_files' );
}


if ( ! function_exists( 'inspiry_settings_after_content_import' ) ) {
	/**
	 * Required settings after demo import.
	 */
	function inspiry_settings_after_content_import( $selected_import ) {

		$top_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $top_menu->term_id,
			)
		);

		// Set homepage as front page and blog page as posts page
		$home_page = get_page_by_title( 'Home' );
		$blog_page = get_page_by_title( 'News' );
		if ( $home_page || $blog_page ) {
			update_option( 'show_on_front', 'page' );
		}
		if ( $home_page ) {
			update_option( 'page_on_front', $home_page->ID );
		}
		if ( $blog_page ) {
			update_option( 'page_for_posts', $blog_page->ID );
			update_option( 'posts_per_page', 4 );
		}

	}

	add_action( 'pt-ocdi/after_import', 'inspiry_settings_after_content_import' );

}

// Disable branding notice at the end of import.
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );