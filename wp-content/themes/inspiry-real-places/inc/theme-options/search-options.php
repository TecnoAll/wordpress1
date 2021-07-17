<?php
/*
 * Search Options
 */
global $opt_name;
Redux::setSection(
	$opt_name,
	array(
		'title'  => esc_html__( 'Properties Search', 'inspiry' ),
		'id'     => 'search-section',
		'desc'   => esc_html__( 'This section contains options related to property search.', 'inspiry' ),
		'fields' => array(
			array(
				'id'       => 'inspiry_search_page',
				'type'     => 'select',
				'data'     => 'pages',
				'title'    => esc_html__( 'Properties Search Page', 'inspiry' ),
				'subtitle' => esc_html__( 'Select a page for properties search results.', 'inspiry' ),
				'desc'     => esc_html__( 'Make sure the selected page is using Property Search template.', 'inspiry' ),
			),
			array(
				'id'       => 'inspiry_search_properties_number',
				'type'     => 'text',
				'title'    => esc_html__( 'Number of Properties on Search Page', 'inspiry' ),
				'default'  => 6,
				'validate' => array( 'numeric', 'not_empty' ),
			),
			array(
				'id'      => 'inspiry_search_layout',
				'type'    => 'select',
				'title'   => esc_html__( 'Search Page Layout', 'inspiry' ),
				'options' => array(
					'list-sidebar' => esc_html__( 'List Layout - Sidebar', 'inspiry' ),
					'grid-sidebar' => esc_html__( 'Grid Layout - Sidebar', 'inspiry' ),
					'list'         => esc_html__( 'List Layout - Full Width', 'inspiry' ),
					'grid'         => esc_html__( 'Grid Layout - Full Width', 'inspiry' ),
					'half-left'    => esc_html__( 'Half Map - Left Side', 'inspiry' ),
					'half-right'   => esc_html__( 'Half Map - Right Side', 'inspiry' ),
				),
				'default' => 'list',
				'select2' => array( 'allowClear' => false ),
			),
			array(
				'id'      => 'inspiry_search_order',
				'type'    => 'select',
				'title'   => esc_html__( 'Default Order of Search Results', 'inspiry' ),
				'options' => array(
					'price-asc'  => esc_html__( 'Sort by Price Low to High', 'inspiry' ),
					'price-desc' => esc_html__( 'Sort by Price High to Low', 'inspiry' ),
					'date-asc'   => esc_html__( 'Sort by Date Old to New', 'inspiry' ),
					'date-desc'  => esc_html__( 'Sort by Date New to Old', 'inspiry' ),
				),
				'default' => 'date-desc',
				'select2' => array( 'allowClear' => false ),
			),

			array(
				'id'      => 'inspiry_search_form_two',
				'type'    => 'switch',
				'title'   => esc_html__( 'Search Form In Properties Pages', 'inspiry' ),
				'desc'    => esc_html__( 'Not applicable for Header Variation One.', 'inspiry' ),
				'default' => 0,
				'on'      => esc_html__( 'Show', 'inspiry' ),
				'off'     => esc_html__( 'Hide', 'inspiry' ),

			),
			array(
				'id'      => 'inspiry_search_module_below_header',
				'type'    => 'button_set',
				'title'   => esc_html__( 'What to Display Below Header on Property Search Page', 'inspiry' ),
				'options' => array(
					'banner'     => esc_html__( 'Image Banner', 'inspiry' ),
					'google-map' => esc_html__( 'Google Map', 'inspiry' ),
				),
				'default' => 'google-map',
			),
			array(
				'id'      => 'inspiry_search_taxonomy_order',
				'type'    => 'button_set',
				'title'   => esc_html__( 'How do you want to Sort All the Taxonomies?', 'inspiry' ),
				'desc'    => esc_html__( 'How would you like to sort the taxonomies (Locations, Property Status, Property Types etc. For example, by properties count (taxonomies with highest properties assigned) or by the alphabetic order.', 'inspiry' ),
				'options' => array(
					'name'  => esc_html__( 'Alphabetically', 'inspiry' ),
					'count' => esc_html__( 'Properties Count', 'inspiry' ),
				),
				'default' => 'name',
			),

		),
	)
);

/*
 * Layout Basic Section
 */
Redux::setSection(
	$opt_name,
	array(
		'title'      => esc_html__( 'Basic', 'inspiry' ),
		'id'         => 'search-Basic-section',
		'desc'       => esc_html__( 'This section contains Advance Search Basic options.', 'inspiry' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'inspiry_search_title_show',
				'type'    => 'switch',
				'title'   => esc_html__( 'Display Search Form Title', 'inspiry' ),
				'desc'    => esc_html__( 'Property title will be displayed above the search form.', 'inspiry' ),
				'default' => 1,
				'on'      => esc_html__( 'Show', 'inspiry' ),
				'off'     => esc_html__( 'Hide', 'inspiry' ),
			),
			array(
				'id'      => 'inspiry_home_search_form_title',
				'type'    => 'text',
				'title'   => esc_html__( 'Search Form Title', 'inspiry' ),
				'default' => esc_html__( 'Quick Search', 'inspiry' ),
				'required' => array( 'inspiry_search_title_show', '=', 1 ),
			),

			array(
				'id'      => 'inspiry_search_features',
				'type'    => 'switch',
				'title'   => esc_html__( 'Property Features in Search Form', 'inspiry' ),
				'desc'    => esc_html__( 'Property features will be displayed below other search form fields.', 'inspiry' ),
				'default' => 0,
				'on'      => esc_html__( 'Show', 'inspiry' ),
				'off'     => esc_html__( 'Hide', 'inspiry' ),
			),
			array(
				'id'      => 'inspiry_search_property_type_label',
				'type'    => 'text',
				'title'   => esc_html__( 'Title for search "Property Type"', 'inspiry' ),
				'default' => esc_html__( 'Property Type', 'inspiry' ),
			),

			array(
				'id'      => 'inspiry_search_property_status_label',
				'type'    => 'text',
				'title'   => esc_html__( 'Title for search "Property Status"', 'inspiry' ),
				'default' => esc_html__( 'Property Status', 'inspiry' ),
			),
			array(
				'id'      => 'inspiry_search_property_keyword_label',
				'type'    => 'text',
				'title'   => esc_html__( 'Title for search "Keyword"', 'inspiry' ),
				'default' => esc_html__( 'Keyword', 'inspiry' ),
			),

			array(
				'id'      => 'inspiry_search_property_id_label',
				'type'    => 'text',
				'title'   => esc_html__( 'Title for search "Property ID"', 'inspiry' ),
				'default' => esc_html__( 'Property ID', 'inspiry' ),
			),
		),
	)
);

/*
 * Layout Sub Section
 */
Redux::setSection(
	$opt_name,
	array(
		'title'      => esc_html__( 'Layout', 'inspiry' ),
		'id'         => 'search-layout-section',
		'desc'       => esc_html__( 'This section contains Advance Search layout related options.', 'inspiry' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'inspiry_search_fields',
				'type'    => 'sorter',
				'title'   => esc_html__( 'Search Form Fields Manager', 'inspiry' ),
				'options' => array(
					'enabled'  => array(
						'keyword'  => esc_html__( 'Keyword', 'inspiry' ),
						'location' => esc_html__( 'Location', 'inspiry' ),
						'status'   => esc_html__( 'Status', 'inspiry' ),
					),
					'disabled' => array(
						'type'          => esc_html__( 'Type', 'inspiry' ),
						'min-beds'      => esc_html__( 'Min Beds', 'inspiry' ),
						'min-baths'     => esc_html__( 'Min Baths', 'inspiry' ),
						'min-max-price' => esc_html__( 'Min Max Price', 'inspiry' ),
						'min-max-area'  => esc_html__( 'Min Max Area', 'inspiry' ),
						'property-id'   => esc_html__( 'Property ID', 'inspiry' ),
					),
				),
			),
		),
	)
);

/*
 * Locations Sub Section
 */
Redux::setSection(
	$opt_name,
	array(
		'title'      => esc_html__( 'Locations', 'inspiry' ),
		'id'         => 'search-locations-section',
		'desc'       => esc_html__( 'This section contains Advance Search Locations related options.', 'inspiry' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'inspiry_search_locations_number',
				'type'    => 'select',
				'title'   => esc_html__( 'Number of Location Select Boxes', 'inspiry' ),
				'options' => array(
					1 => '1',
					2 => '2',
					3 => '3',
					4 => '4',
				),
				'default' => 1,
				'select2' => array( 'allowClear' => false ),
			),
			array(
				'id'       => 'inspiry_search_location_title_1',
				'type'     => 'text',
				'title'    => esc_html__( 'Title for 1st Location Select Box', 'inspiry' ),
				'default'  => esc_html__( 'Country', 'inspiry' ),
				'required' => array( 'inspiry_search_locations_number', '=', array( '1', '2', '3', '4' ) ),
			),
			array(
				'id'       => 'inspiry_search_location_title_2',
				'type'     => 'text',
				'title'    => esc_html__( 'Title for 2nd Location Select Box', 'inspiry' ),
				'default'  => esc_html__( 'State', 'inspiry' ),
				'required' => array( 'inspiry_search_locations_number', '=', array( '2', '3', '4' ) ),
			),
			array(
				'id'       => 'inspiry_search_location_title_3',
				'type'     => 'text',
				'title'    => esc_html__( 'Title for 3rd Location Select Box', 'inspiry' ),
				'default'  => esc_html__( 'City', 'inspiry' ),
				'required' => array( 'inspiry_search_locations_number', '=', array( '3', '4' ) ),
			),
			array(
				'id'       => 'inspiry_search_location_title_4',
				'type'     => 'text',
				'title'    => esc_html__( 'Title for 4th Location Select Box', 'inspiry' ),
				'default'  => esc_html__( 'Area', 'inspiry' ),
				'required' => array( 'inspiry_search_locations_number', '=', array( '4' ) ),
			),
		),
	)
);

/*
 * Layout Beds & Baths Section
 */
Redux::setSection(
	$opt_name,
	array(
		'title'      => esc_html__( 'Beds and Baths', 'inspiry' ),
		'id'         => 'search-beds-baths-section',
		'desc'       => esc_html__( 'This section contains Advance Search Beds and Baths related options.', 'inspiry' ),
		'subsection' => true,
		'fields'     => array(

			array(
				'id'      => 'inspiry_search_property_min_bed_label',
				'type'    => 'text',
				'title'   => esc_html__( 'Title for search "Min Beds"', 'inspiry' ),
				'default' => esc_html__( 'Min Beds (Any)', 'inspiry' ),
			),
			array(
				'id'       => 'inspiry_search_property_min_beds',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Values for Min Beds Field', 'inspiry' ),
				'desc'     => esc_html__( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces or currency signs.', 'inspiry' ),
				'validate' => 'no_html',
				'default'  => '1,2,3,4,5,6,7,8,9,10',
			),

			array(
				'id'      => 'inspiry_search_property_min_bath_label',
				'type'    => 'text',
				'title'   => esc_html__( 'Title for search "Min Bath"', 'inspiry' ),
				'default' => esc_html__( 'Min Baths (Any)', 'inspiry' ),
			),


			array(
				'id'       => 'inspiry_search_property_min_baths',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Values for Min Baths Field', 'inspiry' ),
				'desc'     => esc_html__( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces or currency signs.', 'inspiry' ),
				'validate' => 'no_html',
				'default'  => '1,2,3,4,5,6,7,8,9,10',
			),
		),
	)
);

/*
 * Layout Prices Section
 */
Redux::setSection(
	$opt_name,
	array(
		'title'      => esc_html__( 'Prices', 'inspiry' ),
		'id'         => 'search-prices-section',
		'desc'       => esc_html__( 'This section contains Advance Search Prices related options.', 'inspiry' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'inspiry_search_property_min_price_label',
				'type'    => 'text',
				'title'   => esc_html__( 'Title for search "Min Price"', 'inspiry' ),
				'default' => esc_html__( 'Min Price (Any)', 'inspiry' ),
			),

			array(
				'id'       => 'inspiry_minimum_prices',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Values for Minimum Prices Field', 'inspiry' ),
				'desc'     => esc_html__( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces or currency signs.', 'inspiry' ),
				'validate' => 'no_html',
				'default'  => '1000, 5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000',
			),

			array(
				'id'      => 'inspiry_search_property_max_price_label',
				'type'    => 'text',
				'title'   => esc_html__( 'Title for search "Max Price"', 'inspiry' ),
				'default' => esc_html__( 'Max Price (Any)', 'inspiry' ),
			),

			array(
				'id'       => 'inspiry_maximum_prices',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Values for Maximum Prices Field', 'inspiry' ),
				'desc'     => esc_html__( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces or currency signs.', 'inspiry' ),
				'validate' => 'no_html',
				'default'  => '5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000, 10000000',
			),
			array(
				'id'    => 'inspiry_status_for_rent',
				'type'  => 'radio',
				'title' => esc_html__( 'Status That Represents Rent', 'inspiry' ),
				'desc'  => esc_html__( 'Visitor expects smaller values for rent prices. So provide the list of minimum and maximum rent prices below. The rent prices will be displayed based on rent status selected above.', 'inspiry' ),
				'data'  => 'terms',
				'args'  => array(
					'taxonomies' => array( 'property-status' ),
				),
			),
			array(
				'id'       => 'inspiry_minimum_rent_prices',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Values for Minimum Rent Prices Field', 'inspiry' ),
				'desc'     => esc_html__( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces or currency signs.', 'inspiry' ),
				'validate' => 'no_html',
				'default'  => '500, 1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000',
			),
			array(
				'id'       => 'inspiry_maximum_rent_prices',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Values for Maximum Rent Prices Field', 'inspiry' ),
				'desc'     => esc_html__( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces or currency signs.', 'inspiry' ),
				'validate' => 'no_html',
				'default'  => '1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000, 150000',
			),

		),
	)
);
/*
 * Layout Area Section
 */
Redux::setSection(
	$opt_name,
	array(
		'title'      => esc_html__( 'Area', 'inspiry' ),
		'id'         => 'search-area-section',
		'desc'       => esc_html__( 'This section contains Advance Search area related options.', 'inspiry' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'inspiry_search_property_min_area_label',
				'type'    => 'text',
				'title'   => esc_html__( 'Title for search "Min Area"', 'inspiry' ),
				'default' => esc_html__( 'Min Area (sq ft)', 'inspiry' ),
			),

			array(
				'id'      => 'inspiry_search_property_max_area_label',
				'type'    => 'text',
				'title'   => esc_html__( 'Title for search "Max Area"', 'inspiry' ),
				'default' => esc_html__( 'Max Area (sq ft)', 'inspiry' ),
			),
		),
	)
);
