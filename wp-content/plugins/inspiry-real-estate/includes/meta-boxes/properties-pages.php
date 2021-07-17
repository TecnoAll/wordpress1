<?php
/**
 * Declares properties pages meta boxes.
 *
 * @param $meta_boxes
 *
 * @return array
 */
function ire_register_properties_pages_meta_boxes( $meta_boxes ) {

	$locations = array();
	ire_get_terms_array( 'property-city', $locations );

	$types = array();
	ire_get_terms_array( 'property-type', $types );

	$statuses = array();
	ire_get_terms_array( 'property-status', $statuses );

	$features = array();
	ire_get_terms_array( 'property-feature', $features );

	$meta_boxes[] = array(
		'id'       => 'properties-list-meta-box',
		'title'    => esc_html__( 'Properties Settings', 'inspiry-real-estate' ),
		'pages'    => array( 'page' ),
		'context'  => 'normal',
		'priority' => 'high',
		'show'     => array(
			'template' => array(
				'page-templates/properties-list.php',
				'page-templates/properties-list-with-sidebar.php',
				'page-templates/properties-grid.php',
				'page-templates/properties-grid-with-sidebar.php',
				'page-templates/properties-list-half-map.php',
			),
		),
		'fields'   => array(
			array(
				'id'   => 'inspiry_posts_per_page',
				'name' => esc_html__( 'Number of Properties Per Page', 'inspiry-real-estate' ),
				'type' => 'number',
				'step' => '1',
				'min'  => 1,
				'std'  => 6,
				'columns' => 6,
			),
			array(
				'id'       => "inspiry_properties_order",
				'name'     => esc_html__( 'Order Properties By', 'inspiry-real-estate' ),
				'type'     => 'select',
				'options'  => array(
					'date-desc'  => esc_html__( 'Date New to Old', 'inspiry-real-estate' ),
					'date-asc'   => esc_html__( 'Date Old to New', 'inspiry-real-estate' ),
					'price-asc'  => esc_html__( 'Price Low to High', 'inspiry-real-estate' ),
					'price-desc' => esc_html__( 'Price High to Low', 'inspiry-real-estate' ),
					'random'     => esc_html__( 'Random', 'inspiry-real-estate' ),
				),
				'multiple' => false,
				'std'      => 'date-desc',
				'columns' => 6,
			),
			array(
				'id'              => "inspiry_properties_locations",
				'name'            => esc_html__( 'Locations', 'inspiry-real-estate' ),
				'type'            => 'select',
				'options'         => $locations,
				'multiple'        => true,
				'select_all_none' => true,
				'columns' => 6,
			),
			array(
				'id'              => "inspiry_properties_statuses",
				'name'            => esc_html__( 'Statuses', 'inspiry-real-estate' ),
				'type'            => 'select',
				'options'         => $statuses,
				'multiple'        => true,
				'select_all_none' => true,
				'columns' => 6,
			),
			array(
				'id'              => "inspiry_properties_types",
				'name'            => esc_html__( 'Types', 'inspiry-real-estate' ),
				'type'            => 'select',
				'options'         => $types,
				'multiple'        => true,
				'select_all_none' => true,
				'columns' => 6,
			),
			array(
				'id'              => "inspiry_properties_features",
				'name'            => esc_html__( 'Features', 'inspiry-real-estate' ),
				'type'            => 'select',
				'options'         => $features,
				'multiple'        => true,
				'select_all_none' => true,
				'columns' => 6,
			),
			array(
				'id'   => 'inspiry_properties_min_beds',
				'name' => esc_html__( 'Minimum Beds', 'inspiry-real-estate' ),
				'type' => 'number',
				'step' => 'any',
				'min'  => 0,
				'std'  => 0,
				'columns' => 6,
			),
			array(
				'id'   => 'inspiry_properties_min_baths',
				'name' => esc_html__( 'Minimum Baths', 'inspiry-real-estate' ),
				'type' => 'number',
				'step' => 'any',
				'min'  => 0,
				'std'  => 0,
				'columns' => 6,
			),
			array(
				'id'   => 'inspiry_properties_min_price',
				'name' => esc_html__( 'Minimum Price', 'inspiry-real-estate' ),
				'type' => 'number',
				'step' => 'any',
				'min'  => 0,
				'std'  => 0,
				'columns' => 6,
			),
			array(
				'id'   => 'inspiry_properties_max_price',
				'name' => esc_html__( 'Maximum Price', 'inspiry-real-estate' ),
				'type' => 'number',
				'step' => 'any',
				'min'  => 0,
				'std'  => 0,
				'columns' => 6,
			),
			array(
				'id'   => 'inspiry_display_google_map',
				'name' => esc_html__( 'Google Map in Header', 'inspiry-real-estate' ),
				'type' => 'checkbox',
				'desc' => esc_html__( 'Display Google Map with Properties Markers', 'inspiry-real-estate' ),
				'columns' => 12,
			),
			array(
				'id'   => 'inspiry_display_google_half_map',
				'name' => esc_html__( 'Google Half Map Layout', 'inspiry-real-estate' ),
				'type' => 'radio',
				'std' => 'left',
				'inline' => false,
				'desc' => esc_html__( 'Select Google Half Map Layout', 'inspiry-real-estate' ),
				'columns' => 12,
				'options' => array(
					'left' =>  esc_html__('Left', 'inspiry-real-estate'),
					'right' =>  esc_html__('Right', 'inspiry-real-estate'),
				),
			),
		)
	);

	return apply_filters( 'ire_properties_pages_meta_boxes', $meta_boxes );  // apply a filter before returning meta boxes
}

add_filter( 'rwmb_meta_boxes', 'ire_register_properties_pages_meta_boxes' );