<?php
/*
 * Google Map with Properties Markers
 */
if ( ! class_exists( 'Inspiry_Real_Estate' ) ) {
	return;
}

global $inspiry_options;
$map_stuff              = array();
$properties_map_options = array();
$inspiry_map_option     = get_option( 'inspiry_map_option' );

// Image Banner should be displayed with header variation one to keep things in order
if ( $inspiry_options['inspiry_header_variation'] == '1' ) {
	get_template_part( 'partials/header/banner' );
}

$map_args = array(
	'post_type'      => 'property',
	'posts_per_page' => -1,
	'meta_query'     => array(
		array(
			'key'     => 'REAL_HOMES_property_address',
			'compare' => 'EXISTS',
		),
	),
);

if ( is_page_template( 'page-templates/properties-search.php' ) ) {

	// Apply Search Filter
	$map_args = apply_filters( 'inspiry_property_search', $map_args );

} elseif ( is_page_template( 'page-templates/home.php' ) ) {

	// Apply Homepage Properties Filter
	$map_args = apply_filters( 'inspiry_home_properties', $map_args );

} elseif ( is_page_template( 'page-templates/properties-list.php' )
			|| is_page_template( 'page-templates/properties-list-with-sidebar.php' )
			|| is_page_template( 'page-templates/properties-grid.php' )
			|| is_page_template( 'page-templates/properties-grid-with-sidebar.php' )
			|| is_page_template( 'page-templates/properties-list-half-map.php' )
) {


	global $paged;
	if ( is_front_page() ) {
		$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
	}

	$map_args = array(
		'post_type' => 'property',
		'paged'     => $paged,
	);

	// Apply Properties Filter
	$map_args = apply_filters( 'inspiry_properties_filter', $map_args );
	$map_args = apply_filters( 'inspiry_sort_properties', $map_args );

} elseif ( is_tax() ) {

	global $wp_query;
	/* Taxonomy Query */
	$map_args['tax_query'] = array(
		array(
			'taxonomy' => $wp_query->query_vars['taxonomy'],
			'field'    => 'slug',
			'terms'    => $wp_query->query_vars['term'],
		),
	);

}

$map_query = new WP_Query( $map_args );

$properties_data = array();

if ( $map_query->have_posts() ) {

	while ( $map_query->have_posts() ) :

		$map_query->the_post();

		$map_property = new Inspiry_Property( get_the_ID() );

		$current_prop_array = array();

		// Property Title
		$current_prop_array['title'] = get_the_title();

		// Property Price
		$current_prop_array['price'] = $map_property->get_price();

		// Property Location
		$property_location = $map_property->get_location();
		if ( ! empty( $property_location ) ) {
			$current_prop_array['lat'] = $map_property->get_latitude();
			$current_prop_array['lng'] = $map_property->get_longitude();
		}

		// Property Thumbnail
		if ( has_post_thumbnail() ) {
			$image_id         = get_post_thumbnail_id();
			$image_attributes = wp_get_attachment_image_src( $image_id, 'post-thumbnail' );
			if ( ! empty( $image_attributes[0] ) ) {
				$current_prop_array['thumb'] = $image_attributes[0];
			}
		}

		// Property Permalink
		$current_prop_array['url'] = get_permalink();


		// Property map icon based on Property Type
		$type_terms = get_the_terms( get_the_ID(), 'property-type' );
		if ( $type_terms && ! is_wp_error( $type_terms ) ) {
			foreach ( $type_terms as $type_term ) {
				$icon_id = get_term_meta( $type_term->term_id, 'inspiry_property_type_icon', true );
				if ( ! empty( $icon_id ) ) {
					$icon_url = wp_get_attachment_url( $icon_id );
					if ( $icon_url ) {
						$current_prop_array['icon'] = esc_url( $icon_url );

						// Retina icon
						$retina_icon_id = get_term_meta( $type_term->term_id, 'inspiry_property_type_icon_retina', true );
						if ( ! empty( $retina_icon_id ) ) {
							$retina_icon_url = wp_get_attachment_url( $retina_icon_id );
							if ( $retina_icon_url ) {
								$current_prop_array['retinaIcon'] = esc_url( $retina_icon_url );
							}
						}
						break;
					}
				}
			}
		}

		// Property Map Icon Based on Property Type
		$property_type_slug      = 'single-family-home'; // Default Icon Slug
		$temp_property_type_slug = $map_property->get_taxonomy_first_term( 'property-type', 'slug' );
		if ( ! empty( $temp_property_type_slug ) ) {
			$property_type_slug = $temp_property_type_slug;
		}

			// Set default icons if above code fails to sets any
		if ( ! isset( $current_prop_array['icon'] ) ) {

			if ( file_exists( get_template_directory() . '/images/map/' . $property_type_slug . '-map-icon.png' ) ) {
				$current_prop_array['icon'] = get_template_directory_uri() . '/images/map/' . $property_type_slug . '-map-icon.png';
				// retina icon
				if ( file_exists( get_template_directory() . '/images/map/' . $property_type_slug . '-map-icon@2x.png' ) ) {
					$current_prop_array['retinaIcon'] = get_template_directory_uri() . '/images/map/' . $property_type_slug . '-map-icon@2x.png';
				}
			} else {
				$current_prop_array['icon']       = get_template_directory_uri() . '/images/map/single-family-home-map-icon.png';   // default icon
				$current_prop_array['retinaIcon'] = get_template_directory_uri() . '/images/map/single-family-home-map-icon@2x.png';  // default retina icon
			}
		}

		$properties_data[] = $current_prop_array;
	endwhile;

	wp_reset_postdata();
}
$properties_map_data = array(
	'properties'  => $properties_data,
	'closeIcon'   => get_template_directory_uri() . '/images/map/close.png',
	'clusterIcon' => get_template_directory_uri() . '/images/map/cluster-icon.png',
);

	$styles_json = isset( $inspiry_map_option['inspiry_google_maps_styles'] ) ? $inspiry_map_option['inspiry_google_maps_styles'] : '';

if ( ! empty( $styles_json ) ) {
		$properties_map_options['styles'] = stripslashes( $styles_json );
}

	$properties_map_options['type'] = isset( $inspiry_map_option['inspiry_property_map_type'] ) ? $inspiry_map_option['inspiry_property_map_type'] : 'roadmap';

	$fallback_location = isset( $inspiry_map_option['property_submit_default_location'] ) ? $inspiry_map_option['property_submit_default_location'] : '27.664827,-81.515755';

if ( ! empty( $fallback_location ) ) {
	$lat_lng = explode( ',', $fallback_location );
	$properties_map_options['fallback_location']['lat'] = $lat_lng[0];
	$properties_map_options['fallback_location']['lng'] = $lat_lng[1];
}

if ( inspiry_has_google_maps_api_key() ) {
	wp_enqueue_script( 'properties-google-map' );
	wp_localize_script( 'properties-google-map', 'propertiesMapData', $properties_map_data );
	wp_localize_script( 'properties-google-map', 'propertiesMapOptions', $properties_map_options );
} else {
	wp_enqueue_script( 'properties-openstreet-map' );
	wp_localize_script( 'properties-openstreet-map', 'propertiesMapData', $properties_map_data );
	wp_localize_script( 'properties-openstreet-map', 'propertiesMapOptions', $properties_map_options );
}

$map_class = 'header-two';
if ( $inspiry_options['inspiry_header_variation'] == '1' ) {
	$map_class = 'header-one';
}
?>
<div id="map-head" class="<?php echo esc_attr( $map_class ); ?>">
	<div id="listing-map"></div>
</div>
