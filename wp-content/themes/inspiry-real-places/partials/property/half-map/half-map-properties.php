<main id="main" class="site-main">
	<?php
	global $inspiry_options;

	// Number of properties to display
	$number_of_properties = intval( $inspiry_options['inspiry_search_properties_number'] );
	if ( ! $number_of_properties ) {
		$number_of_properties = 6;
	}

	// Current Page
	global $paged;
	if ( is_front_page() ) {
		$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
	}

	// Basic query arguments
	$properties_search_arg = array(
		'post_type'      => 'property',
		'posts_per_page' => $number_of_properties,
		'paged'          => $paged,
	);

	// Apply search filter
	$properties_search_arg = apply_filters( 'inspiry_property_search', $properties_search_arg );

	// Apply sorting filter
	$properties_search_arg = apply_filters( 'inspiry_sort_properties', $properties_search_arg );

	// Create custom query
	$properties_search_query = new WP_Query( $properties_search_arg );

	$search_layout = $inspiry_options['inspiry_search_layout'];

	if ( 'list-sidebar' == $search_layout || 'grid-sidebar' == $search_layout ) {
		echo '<div class="row"><div class="col-md-9">';
	}

	/*
	 * Found properties heading and sorting controls
	 */
	global $found_properties;
	$found_properties = $properties_search_query->found_posts;
	get_template_part( 'partials/property/templates/listing-control-search' );

	/*
	 * Properties
	 */
	if ( $properties_search_query->have_posts() ) :

		global $property_list_counter;
		$property_list_counter = 1;

		if ( $search_layout == 'grid' || $search_layout == 'grid-sidebar' ) {
			echo '<div class="row">';
		}

		while ( $properties_search_query->have_posts() ) :

			$properties_search_query->the_post();

			get_template_part( 'partials/property/half-map/property-for-half-map-list' );


			$property_list_counter ++;

		endwhile;

		if ( $search_layout == 'grid' || $search_layout == 'grid-sidebar' ) {
			echo '</div>';
		}

		inspiry_pagination( $properties_search_query );

		wp_reset_postdata();

	endif;

	if ( ( 'list-sidebar' == $search_layout || 'grid-sidebar' == $search_layout ) && is_active_sidebar( 'properties-list' ) ) {
		echo '</div><div class="col-md-3 site-sidebar-content">';
		get_sidebar( 'properties-list' );
		echo '</div></div>'; // .site-sidebar-content & .row
	}

	?>

</main>
