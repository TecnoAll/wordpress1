<section class="property-location-section clearfix">
	<?php
	global $inspiry_options;
	if ( ! empty( $inspiry_options['inspiry_property_map_title'] ) ) {
		?>
		<h4 class="fancy-title"><?php echo esc_html( $inspiry_options['inspiry_property_map_title'] ); ?></h4>
										   <?php
	}
	global $inspiry_single_property;

	$property_marker          = array();
	$property_marker['title'] = get_the_title();

	// Property thumbnail.
	if ( has_post_thumbnail() ) {
		$image_id         = get_post_thumbnail_id();
		$image_attributes = wp_get_attachment_image_src( $image_id, 'post-thumbnail' );

		if ( ! empty( $image_attributes[0] ) ) {
			$property_marker['thumb'] = $image_attributes[0];
		}
	}

	$property_marker['price'] = $inspiry_single_property->get_price();
	$property_marker['lat']   = $inspiry_single_property->get_latitude();
	$property_marker['lang']  = $inspiry_single_property->get_longitude();

	$marker_slug        = 'single-family-home'; // Default Icon Slug.
	$marker_slug_retina = 'single-family-home'; // Default Retina Icon Slug.
	$base_icon_path     = get_template_directory() . '/images/map/';
	$base_icon_uri      = get_template_directory_uri() . '/images/map/';

	// Property Map Icon Based on Property Type.
	$property_type_slugs = wp_get_post_terms( $inspiry_single_property->get_post_ID(), 'property-type' );
	foreach ( $property_type_slugs as $type_slug ) {
		$type_slugs_array[] = $type_slug->slug;
	}

	if ( ! empty( $type_slugs_array ) ) {
		foreach ( $type_slugs_array as $type_slug ) {
			if ( file_exists( $base_icon_path . $type_slug . '-map-icon.png' ) ) {
				$marker_slug = $type_slug; // icon slug.
				if ( file_exists( $base_icon_path . $type_slug . '-map-icon@2x.png' ) ) {
					$marker_slug_retina = $type_slug;   // retina icon slug.
				}
				break;
			}
		}
	}

	$property_marker['icon']          = $base_icon_uri . $marker_slug . '-map-icon.png';
	$property_marker['retinaIcon']    = $base_icon_uri . $marker_slug_retina . '-map-icon@2x.png';
	$property_marker['base_icon_uri'] = $base_icon_uri;
	$property_marker['closeIcon']     = get_template_directory_uri() . '/images/map/close.png';
	$property_marker['clusterIcon']   = get_template_directory_uri() . '/images/map/cluster-icon.png';

	if ( inspiry_has_google_maps_api_key() ) {

		$inspiry_map_option         = get_option( 'inspiry_map_option' );
		$nearby_locations_show_hide = isset( $inspiry_options['inspiry_nearby_locations_show_hide'] ) ? $inspiry_options['inspiry_nearby_locations_show_hide'] : false;
		$styles_json                = isset( $inspiry_map_option['inspiry_google_maps_styles'] ) ? $inspiry_map_option['inspiry_google_maps_styles'] : '';

		if ( $nearby_locations_show_hide ) {

			$property_marker['radius'] = isset( $inspiry_options['inspiry_nearby_locations_radius'] ) ? $inspiry_options['inspiry_nearby_locations_radius'] : 2000;
		}


		if ( ! empty( $styles_json ) ) {
			$property_marker['styles'] = stripslashes( $styles_json );
		}

		$property_marker['type'] = isset( $inspiry_map_option['inspiry_property_map_type'] ) ? $inspiry_map_option['inspiry_property_map_type'] : 'roadmap';
		wp_enqueue_script( 'map-fontawesome-icons' );
		wp_enqueue_script( 'property-google-map' );
		wp_localize_script( 'property-google-map', 'propertyMapData', $property_marker );
		if ( $nearby_locations_show_hide ) {
			?>
			<div id="property_nearby_locations" class="clearfix">
				<ul class="property-features-list clearfix">
					<?php
						$inspiry_map_nearby_locations = array(
							'bus_station'            => array(
								'name'  => esc_html__( 'Bus', 'inspiry' ),
								'color' => '#000',
								'background' => '#0dbae8',
							),
							'subway_station'         => array(
								'name'  => esc_html__( 'Subway', 'inspiry' ),
								'color' => '#2295C4',
								'background' => '#2295C4',
							),
							'grocery_or_supermarket' => array(
								'name'  => esc_html__( 'Grocery', 'inspiry' ),
								'color' => '#455391',
								'background' => '#A7C462',
							),
							'restaurant'             => array(
								'name'  => esc_html__( 'Restaurant', 'inspiry' ),
								'color' => '#34628C',
								'background' => '#6ebe3b',
							),
							'school'                 => array(
								'name'  => esc_html__( 'School', 'inspiry' ),
								'color' => '#5A605C',
								'background' => '#00017C',
							),
							'hospital'               => array(
								'name'  => esc_html__( 'Hospital', 'inspiry' ),
								'color' => '#9D001C',
								'background' => '#f15b5a',
							),
							'cafe'                   => array(
								'name'  => esc_html__( 'Cafe', 'inspiry' ),
								'color' => '#455391',
								'background' => '#6D4C35',
							),
							'gym'                    => array(
								'name'  => esc_html__( 'Gym', 'inspiry' ),
								'color' => '#489959',
								'background' => '#41A6F9',
							),
						);
						// $inspiry_map_nearby_locations = isset( $inspiry_options['inspiry_map_nearby_locations'] ) ? $inspiry_options['inspiry_map_nearby_locations'] : array();
						if ( is_array( $inspiry_map_nearby_locations ) && ! empty( $inspiry_map_nearby_locations ) ) {

							foreach ( $inspiry_map_nearby_locations as $key => $nearby_location ) {
								echo '<li><a background="' . esc_attr( $nearby_location['background'] ) . '" color="' . esc_attr( $nearby_location['color'] ) . '" id="' . esc_attr( $key ) . '" href="#">' . esc_html( $nearby_location['name'] ) . '</a></li>';
							}

						}
						?>
				</ul>
			</div>
			<?php
		}
	} else {
		wp_enqueue_script( 'property-openstreet-map' );
		wp_localize_script( 'property-openstreet-map', 'propertyMapData', $property_marker );
	}
	?>
	<div id="property-map"></div>
</section>
