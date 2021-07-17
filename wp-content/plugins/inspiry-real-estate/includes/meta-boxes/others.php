<?php
/**
 * Gallery Settings Meta-box
 *
 * @param $meta_boxes
 *
 * @return array
 */
function ire_register_gallery_meta_boxes( $meta_boxes ) {

	$meta_boxes[] = array(
		'id'       => 'gallery-settings-meta-box',
		'title'    => esc_html__( 'Gallery Settings', 'inspiry-real-estate' ),
		'pages'    => array( 'page' ),
		'context'  => 'normal',
		'priority' => 'high',
		'show'     => array(
			'template' => array(
				'page-templates/2-columns-gallery.php',
				'page-templates/3-columns-gallery.php',
				'page-templates/4-columns-gallery.php',
			),
		),
		'fields'   => array(
			array(
				'id'   => 'inspiry_gallery_posts_per_page',
				'name' => esc_html__( 'Number of Properties Per Page', 'inspiry-real-estate' ),
				'type' => 'number',
				'step' => '1',
				'min'  => 1,
				'std'  => 6,
			)
		)
	);

	return apply_filters( 'ire_gallery_meta_boxes', $meta_boxes );  // apply a filter before returning meta boxes
}
add_filter( 'rwmb_meta_boxes', 'ire_register_gallery_meta_boxes' );




/**
 * Meta box for agents list pages
 *
 * @param $meta_boxes
 *
 * @return array
 */
function ire_register_agents_meta_boxes( $meta_boxes ) {

	$meta_boxes[] = array(
		'id'       => 'agents-list-meta-box',
		'title'    => esc_html__( 'Agents Settings', 'inspiry-real-estate' ),
		'pages'    => array( 'page' ),
		'context'  => 'normal',
		'priority' => 'high',
		'show'     => array(
			'template' => array(
				'page-templates/agents-list-2-columns.php',
				'page-templates/agents-list-3-columns.php',
				'page-templates/agents-list-4-columns.php',
			),
		),
		'fields'   => array(
			array(
				'id'   => 'inspiry_agents_per_page',
				'name' => esc_html__( 'Number of Agents Per Page', 'inspiry-real-estate' ),
				'type' => 'number',
				'step' => '1',
				'min'  => 1,
				'std'  => 6,
			),
		)
	);

	return apply_filters( 'ire_agents_meta_boxes', $meta_boxes );  // apply a filter before returning meta boxes
}
add_filter( 'rwmb_meta_boxes', 'ire_register_agents_meta_boxes' );



/**
 * Sidebar Settings Meta-box
 *
 * @param $meta_boxes
 * @return array
 */
function ire_register_sidebar_meta_box( $meta_boxes ) {

	$prefix      = 'REAL_HOMES_';

	global $wp_registered_sidebars;
	$sidebars[''] = esc_html__( 'Choose a sidebar', 'inspiry-real-estate' );

	foreach ( $wp_registered_sidebars as $sidebar ) {
		$sidebars[ $sidebar['id'] ] = $sidebar['name'];
	}

	$meta_boxes[] = array(
		'id'       => 'entry-config-meta-box',
		'title'    => esc_html__( 'Sidebar Settings', 'inspiry-real-estate' ),
		'pages'    => array( 'post', 'page', 'agent' ),
		'context'  => 'side',
		'priority' => 'low',
		'hide'     => array(
			'template' => array(
				'page-templates/home.php',
				'page-templates/full-width.php',
				'page-templates/my-properties.php',
				'page-templates/properties-grid.php',
				'page-templates/properties-list.php',
				'page-templates/properties-list-half-map.php',
				'page-templates/agents-list-2-columns.php',
				'page-templates/agents-list-3-columns.php',
				'page-templates/agents-list-4-columns.php',
				'page-templates/2-columns-gallery.php',
				'page-templates/3-columns-gallery.php',
				'page-templates/4-columns-gallery.php',
			),
		),
		'fields'   => array(
			array(
				'name'    => esc_html__( 'Sidebar (optional)', 'inspiry-real-estate' ),
				'id'      => "{$prefix}entry_sidebar",
				'desc'    => esc_html__( 'Choose a custom sidebar for this entry. Otherwise, default entry\'s sidebar will be displayed.', 'inspiry-real-estate' ),
				'type'    => 'select',
				'options' => $sidebars,

			),
		)
	);

	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'ire_register_sidebar_meta_box' );