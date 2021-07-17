<main id="main" class="site-main">

	<?php
//	get_template_part( 'partials/property/templates/compare', 'view' );
	global $paged;
	if ( is_front_page() ) {
		$paged = ( get_query_var('page') ) ? get_query_var( 'page' ) : 1;
	}

	$properties_list_arg = array(
		'post_type'         => 'property',
		'paged'             => $paged,
	);

	// Apply properties filter
	$properties_list_arg = apply_filters( 'inspiry_properties_filter', $properties_list_arg );

	// Apply sorting filter
	$properties_list_arg = apply_filters( 'inspiry_sort_properties', $properties_list_arg );

	$properties_list_query = new WP_Query( $properties_list_arg );

	/*
	 * Found properties heading and sorting controls
	 */
	global $found_properties;
	$found_properties = $properties_list_query->found_posts;
	get_template_part( 'partials/property/templates/listing-control' );

	/**
	 * Page Content
	 */
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			$content = get_the_content();
			if ( ! empty( $content ) ) {
				get_template_part( 'partials/page/content' );
			}
		}
	}

	/*
	 * Properties List
	 */
	if ( $properties_list_query->have_posts() ) :

		while ( $properties_list_query->have_posts() ) :

			$properties_list_query->the_post();

			// display property in list layout
			get_template_part( 'partials/property/half-map/property-for-half-map-list' );

		endwhile;

		inspiry_pagination( $properties_list_query );

		wp_reset_postdata();

	endif;
	?>

</main>