<?php
/*
 * Header Options
 */
global $opt_name;

$fall_back_options = array();

if ( '1' == Redux::getOption( $opt_name, 'inspiry_property_description' ) ) {
	$fall_back_options['enabled']['content'] = esc_html__( 'Description', 'inspiry' );
} else {
	$fall_back_options['disabled']['content'] = esc_html__( 'Description', 'inspiry' );
}

if ( '1' == Redux::getOption( $opt_name, 'inspiry_property_details' ) ) {
	$fall_back_options['enabled']['additional-details'] = esc_html__( 'Additional Details', 'inspiry' );
} else {
	$fall_back_options['disabled']['additional-details'] = esc_html__( 'Additional Details', 'inspiry' );
}

if ( '1' == Redux::getOption( $opt_name, 'inspiry_property_features' ) ) {
	$fall_back_options['enabled']['features'] = esc_html__( 'Features', 'inspiry' );
} else {
	$fall_back_options['disabled']['features'] = esc_html__( 'Features', 'inspiry' );
}

if ( '1' == Redux::getOption( $opt_name, 'inspiry_property_floor_plans' ) ) {
	$fall_back_options['enabled']['floor-plans'] = esc_html__( 'Floor plans', 'inspiry' );
} else {
	$fall_back_options['disabled']['floor-plans'] = esc_html__( 'Floor plans', 'inspiry' );
}

if ( '1' == Redux::getOption( $opt_name, 'inspiry_property_video' ) ) {
	$fall_back_options['enabled']['video'] = esc_html__( 'Video', 'inspiry' );
} else {
	$fall_back_options['disabled']['video'] = esc_html__( 'Video', 'inspiry' );
}

if ( '1' == Redux::getOption( $opt_name, 'inspiry_property_virtual_tour' ) ) {
	$fall_back_options['enabled']['virtual-tour'] = esc_html__( 'Virtual Tour', 'inspiry' );
} else {
	$fall_back_options['disabled']['virtual-tour'] = esc_html__( 'Virtual Tour', 'inspiry' );
}

if ( '1' == Redux::getOption( $opt_name, 'inspiry_property_map' ) ) {
	$fall_back_options['enabled']['map'] = esc_html__( 'Map', 'inspiry' );
} else {
	$fall_back_options['disabled']['map'] = esc_html__( 'Map', 'inspiry' );
}

if ( '1' == Redux::getOption( $opt_name, 'inspiry_property_attachments' ) ) {
	$fall_back_options['enabled']['attachments'] = esc_html__( 'Attachments', 'inspiry' );
} else {
	$fall_back_options['disabled']['attachments'] = esc_html__( 'Attachments', 'inspiry' );
}

if ( '1' == Redux::getOption( $opt_name, 'inspiry_property_share' ) ) {
	$fall_back_options['enabled']['share'] = esc_html__( 'Share', 'inspiry' );
} else {
	$fall_back_options['disabled']['share'] = esc_html__( 'Share', 'inspiry' );
}

if ( '1' == Redux::getOption( $opt_name, 'inspiry_children_properties' ) ) {
	$fall_back_options['enabled']['children'] = esc_html__( 'Children', 'inspiry' );
} else {
	$fall_back_options['disabled']['children'] = esc_html__( 'Children', 'inspiry' );
}
$fall_back_options['disabled']['walkScore'] = esc_html__( 'WalkScore', 'inspiry' );


$place_types_array = array(
	'accounting',
	'airport',
	'amusement_park',
	'aquarium',
	'art_gallery',
	'atm',
	'bakery',
	'bank',
	'bar',
	'beauty_salon',
	'bicycle_store',
	'book_store',
	'bowling_alley',
	'bus_station',
	'cafe',
	'campground',
	'car_dealer',
	'car_rental',
	'car_repair',
	'car_wash',
	'casino',
	'cemetery',
	'church',
	'city_hall',
	'clothing_store',
	'convenience_store',
	'courthouse',
	'dentist',
	'department_store',
	'doctor',
	'electrician',
	'electronics_store',
	'embassy',
	'establishment',
	'finance',
	'fire_station',
	'florist',
	'food',
	'funeral_home',
	'furniture_store',
	'gas_station',
	'general_contractor',
	'grocery_or_supermarket',
	'gym',
	'hair_care',
	'hardware_store',
	// 'health',
	'hindu_temple',
	'home_goods_store',
	'hospital',
	'insurance_agency',
	'jewelry_store',
	'laundry',
	'lawyer',
	'library',
	'liquor_store',
	'local_government_office',
	'locksmith',
	'lodging',
	'meal_delivery',
	'meal_takeaway',
	'mosque',
	'movie_rental',
	'movie_theater',
	'moving_company',
	'museum',
	'night_club',
	'painter',
	'park',
	'parking',
	'pet_store',
	'pharmacy',
	'physiotherapist',
	'place_of_worship',
	'plumber',
	'police',
	'post_office',
	'real_estate_agency',
	'restaurant',
	'roofing_contractor',
	'rv_park',
	'school',
	'shoe_store',
	'shopping_mall',
	'spa',
	'stadium',
	'storage',
	'store',
	'subway_station',
	'synagogue',
	'taxi_stand',
	'train_station',
	'travel_agency',
	'university',
	'veterinary_care',
	'zoo',
);

$place_types_array_format = array_map(
	function ( $str ) {
		return ucwords( str_replace( '_', ' ', $str ) );
	},
	$place_types_array
);

$final_place_types = array_combine( $place_types_array, $place_types_array_format );

Redux::setSection(
	$opt_name,
	array(
		'title'  => esc_html__( 'Property Detail', 'inspiry' ),
		'id'     => 'property-detail-section',
		'desc'   => esc_html__( 'This section contains options for property detail page.', 'inspiry' ),
		'fields' => array(
			array(
				'id'       => 'inspiry_property_single_fields',
				'type'     => 'sorter',
				'title'    => esc_html__( 'Section Manager', 'inspiry' ),
				'options'  => $fall_back_options,
				'compiler' => true,
			),
			array(
				'id'      => 'inspiry_property_header_variation',
				'type'    => 'radio',
				'title'   => esc_html__( 'Property Header Design Variation', 'inspiry' ),
				'options' => array(
					'1' => esc_html__( 'Variation One - Simple slider with basic information on right side of slider.', 'inspiry' ),
					'2' => esc_html__( 'Variation Two - Thumbnail slider with basic information below slider.', 'inspiry' ),
					'3' => esc_html__( 'Variation Three - Horizontally scrollable slider with basic information below slider.', 'inspiry' ),
				),
				'default' => '1',
			),
		),
	)
);
/*
 * Basic Sub Section
 */
Redux::setSection(
	$opt_name,
	array(
		'title'      => esc_html__( 'Basic', 'inspiry' ),
		'id'         => 'property-basic-section',
		'desc'       => esc_html__( 'This section contains Basic Property Details related options.', 'inspiry' ),
		'subsection' => true,
		'fields'     => array(
			/*
			 * Breadcrumbs
			*/
			array(
				'id'      => 'inspiry_property_breadcrumbs',
				'type'    => 'switch',
				'title'   => esc_html__( 'Property Breadcrumbs', 'inspiry' ),
				'default' => 1,
				'on'      => esc_html__( 'Show', 'inspiry' ),
				'off'     => esc_html__( 'Hide', 'inspiry' ),
			),

			/*
			 * Description
			 */
			array(
				'id'      => 'inspiry_property_desc_title',
				'type'    => 'text',
				'title'   => esc_html__( 'Description Title', 'inspiry' ),
				'default' => esc_html__( 'Description', 'inspiry' ),
			),


			/*
			 * Additional Details
			 */
			array(
				'id'      => 'inspiry_property_details_title',
				'type'    => 'text',
				'title'   => esc_html__( 'Additional Details Title', 'inspiry' ),
				'default' => esc_html__( 'Additional Details', 'inspiry' ),
			),


			/*
			 * Features
			 */
			array(
				'id'      => 'inspiry_property_features_title',
				'type'    => 'text',
				'title'   => esc_html__( 'Features Title', 'inspiry' ),
				'default' => esc_html__( 'Features', 'inspiry' ),
			),

			/*
			 * Floor Plans
			 */
			array(
				'id'      => 'inspiry_property_floor_plans_title',
				'type'    => 'text',
				'title'   => esc_html__( 'Floor Plans Title', 'inspiry' ),
				'default' => esc_html__( 'Floor Plans', 'inspiry' ),
			),

			/*
			 * Video
			 */
			array(
				'id'      => 'inspiry_property_video_title',
				'type'    => 'text',
				'title'   => esc_html__( 'Video Title', 'inspiry' ),
				'default' => esc_html__( 'Property Video', 'inspiry' ),
			),

			/*
			 * Virtual Tour
			 */
			array(
				'id'      => 'inspiry_property_virtual_tour_title',
				'type'    => 'text',
				'title'   => esc_html__( 'Virtual Tour Title', 'inspiry' ),
				'default' => esc_html__( 'Virtual Tour', 'inspiry' ),
			),

			/*
			 * Attachments
			 */
			array(
				'id'      => 'inspiry_property_attachments_title',
				'type'    => 'text',
				'title'   => esc_html__( 'Attachments Title', 'inspiry' ),
				'default' => esc_html__( 'Attachments', 'inspiry' ),
			),


			/*
			 * Share
			 */
			array(
				'id'      => 'inspiry_property_share_title',
				'type'    => 'text',
				'title'   => esc_html__( 'Share This Property Title', 'inspiry' ),
				'default' => esc_html__( 'Share This Property', 'inspiry' ),
			),


			/*
			 * Children Properties
			 */
			array(
				'id'      => 'inspiry_property_children_title',
				'type'    => 'text',
				'title'   => esc_html__( 'Children Properties Title', 'inspiry' ),
				'default' => esc_html__( 'Sub Properties', 'inspiry' ),
			),


			/*
			 * Property Comments
			 */
			array(
				'id'      => 'inspiry_property_comments',
				'type'    => 'switch',
				'title'   => esc_html__( 'Property Comments', 'inspiry' ),
				'default' => 1,
				'on'      => esc_html__( 'Show', 'inspiry' ),
				'off'     => esc_html__( 'Hide', 'inspiry' ),
			),

		),
	)
);


/*
 * Agent Info Sub Section
 */
Redux::setSection(
	$opt_name,
	array(
		'title'      => esc_html__( 'Agent Information', 'inspiry' ),
		'id'         => 'property-agent-section',
		'desc'       => esc_html__( 'This section contains Agent Information related options.', 'inspiry' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'inspiry_property_agent',
				'type'    => 'switch',
				'title'   => esc_html__( 'Agent Information', 'inspiry' ),
				'default' => 1,
				'on'      => esc_html__( 'Show', 'inspiry' ),
				'off'     => esc_html__( 'Hide', 'inspiry' ),
			),
			array(
				'id'       => 'inspiry_agent_contact_form',
				'type'     => 'switch',
				'title'    => esc_html__( 'Agent Contact Form', 'inspiry' ),
				'default'  => 1,
				'on'       => esc_html__( 'Show', 'inspiry' ),
				'off'      => esc_html__( 'Hide', 'inspiry' ),
				'required' => array( 'inspiry_property_agent', '=', '1' ),
			),
			array(
				'id'       => 'inspiry_agent_contact_form_title',
				'type'     => 'text',
				'title'    => esc_html__( 'Agent Contact Form Title', 'inspiry' ),
				'default'  => esc_html__( 'Contact Agent', 'inspiry' ),
				'required' => array( 'inspiry_agent_contact_form', '=', '1' ),
			),
		),
	)
);

/*
 * Similar Properties Sub Section
 */
Redux::setSection(
	$opt_name,
	array(
		'title'      => esc_html__( 'Similar Properties', 'inspiry' ),
		'id'         => 'property-similar-section',
		'desc'       => esc_html__( 'This section contains Similar Properties related options.', 'inspiry' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'inspiry_similar_properties',
				'type'    => 'switch',
				'title'   => esc_html__( 'Similar Properties', 'inspiry' ),
				'default' => 1,
				'on'      => esc_html__( 'Show', 'inspiry' ),
				'off'     => esc_html__( 'Hide', 'inspiry' ),
			),
			array(
				'id'       => 'inspiry_similar_properties_title',
				'type'     => 'text',
				'title'    => esc_html__( 'Similar Properties Title', 'inspiry' ),
				'default'  => esc_html__( 'Similar Properties', 'inspiry' ),
				'required' => array( 'inspiry_similar_properties', '=', '1' ),
			),
			array(
				'id'       => 'inspiry_similar_properties_number',
				'type'     => 'select',
				'title'    => esc_html__( 'Maximum number of similar properties', 'inspiry' ),
				'options'  => array(
					1 => '1',
					2 => '2',
					3 => '3',
					4 => '4',
					5 => '5',
				),
				'default'  => 3,
				'select2'  => array( 'allowClear' => false ),
				'required' => array( 'inspiry_similar_properties', '=', '1' ),
			),
			array(
				'id'       => 'inspiry_similar_properties_filter',
				'type'     => 'checkbox',
				'title'    => esc_html__( 'Show similar properties based on', 'inspiry' ),
				'options'  => array(
					'property-city'    => esc_html__( 'Property Location', 'inspiry' ),
					'property-status'  => esc_html__( 'Property Status', 'inspiry' ),
					'property-type'    => esc_html__( 'Property Type', 'inspiry' ),
					'property-feature' => esc_html__( 'Property Feature', 'inspiry' ),

				),
				'default'  => array(
					'property-city'    => '1',
					'property-status'  => '0',
					'property-type'    => '1',
					'property-feature' => '0',
				),
				'required' => array( 'inspiry_similar_properties', '=', '1' ),
			),
			array(
				'id'       => 'inspiry_similar_properties_sorting',
				'type'     => 'radio',
				'title'    => esc_html__( 'Sort Similar Properties By', 'inspiry' ),
				'default'  => 'random',
				'options'  => array(
					'time'         => esc_html__( 'Time - Recent First', 'inspiry' ),
					'price-htl'    => esc_html__( 'Price - High to Low', 'inspiry' ),
					'property-lth' => esc_html__( 'Proce - Low to High', 'inspiry' ),
					'random'       => esc_html__( 'Random', 'inspiry' ),
				),
				'required' => array( 'inspiry_similar_properties', '=', '1' ),
			),
		),
	)
);


/*
 * Google Maps and Nearby Sub Section
 */
Redux::setSection(
	$opt_name,
	array(
		'title'      => esc_html__( 'Google Maps & Nearby', 'inspiry' ),
		'id'         => 'property-maps-section',
		'desc'       => esc_html__( 'This section contains Google Maps and Nearby related options.', 'inspiry' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'inspiry_property_map_title',
				'type'    => 'text',
				'title'   => esc_html__( 'Map Title', 'inspiry' ),
				'default' => esc_html__( 'Location', 'inspiry' ),
			),

			array(
				'id'      => 'inspiry_nearby_locations_show_hide',
				'type'    => 'switch',
				'title'   => esc_html__( 'Nearby Locations', 'inspiry' ),
				'default' => 1,
				'on'      => esc_html__( 'Show', 'inspiry' ),
				'off'     => esc_html__( 'Hide', 'inspiry' ),
			),
			array(
				'id'       => 'inspiry_nearby_locations_radius',
				'type'     => 'text',
				'title'    => esc_html__( 'Nearby Places Radius', 'inspiry' ),
				'desc'     => esc_html__( 'measurement unit is meter', 'inspiry' ),
				'default'  => '3000',
				'required' => array( 'inspiry_nearby_locations_show_hide', '=', '1' ),
				'validate' => array( 'numeric', 'not_empty' ),
			)

		),
	)
);

/*
 * WalkScore Sub Section
 */
Redux::setSection(
	$opt_name,
	array(
		'title'      => esc_html__( 'WalkScore', 'inspiry' ),
		'id'         => 'property-walkscore-section',
		'desc'       => esc_html__( 'This section contains WalkScore related options.', 'inspiry' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'inspiry_property_walkScore_title',
				'type'    => 'text',
				'title'   => esc_html__( 'WalkScore Title', 'inspiry' ),
				'default' => esc_html__( 'WalkScore', 'inspiry' ),
			),
			array(
				'id'      => 'inspiry_property_walkScore_api_key',
				'type'    => 'text',
				'title'   => esc_html__( 'WalkScore API Key', 'inspiry' ),
				'desc'    => wp_kses(
					__( 'Click here to get your <a target="_blank" href="https://www.walkscore.com/professional/api-sign-up.php">WalkScore API Key</a>', 'inspiry' ),
					array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					)
				),
				'default' => '',
			),
		),
	)
);
