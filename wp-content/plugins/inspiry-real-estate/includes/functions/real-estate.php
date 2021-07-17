<?php
/**
 * Output select options for terms in a given taxonomy
 * @param $taxonomy_name    string taxonomy name
 * @param $taxonomy_title   string taxonomy title
 */
function ire_generate_taxonomy_options( $taxonomy_name, $taxonomy_title ) {
	global $inspiry_options;
	$get_sort_order = $inspiry_options['inspiry_search_taxonomy_order'];

	$taxonomy_terms = get_terms( $taxonomy_name, array (
		'hide_empty' => false,
		'orderby' => $get_sort_order,
		'order' => ($get_sort_order === 'count' ? 'DESC' : 'ASC'),
		'parent' => 0,
	));

	$searched_term = '';

	if( $taxonomy_name == 'property-city' ){
		if( !empty( $_GET['location'] ) ){
			$searched_term = $_GET['location'];
		}
	}

	if( $taxonomy_name == 'property-type' ){
		if( !empty( $_GET['type'] ) ){
			$searched_term = $_GET['type'];
		}
	}

	if( $taxonomy_name == 'property-status' ){
		if( !empty( $_GET['status'] ) ){
			$searched_term = $_GET['status'];
		}
	}

	if ( $searched_term == 'any' || empty( $searched_term ) ) {
		echo '<option value="any" selected="selected">' . $taxonomy_title . ' ' . esc_html__( '(Any)', 'inspiry-real-estate') . '</option>';
	} else {
		echo '<option value="any">' . $taxonomy_title . ' ' . esc_html__( '(Any)', 'inspiry-real-estate') . '</option>';
	}

	if ( ! empty( $taxonomy_terms ) && ! is_wp_error( $taxonomy_terms ) ){
		inspiry_hierarchical_options( $taxonomy_name, $taxonomy_terms, $searched_term);
	}


}



/**
 * Output options for minimum price select box in property search form
 */
function ire_minimum_prices_options( $status = 'sale' ) {
	global $inspiry_options;
	$get_min_price_label = $inspiry_options['inspiry_search_property_min_price_label'];
	$default_label = !empty($get_min_price_label)? $get_min_price_label: esc_html__( 'Min Price (Any)', 'inspiry-real-estate');
	if ( $status == 'rent' ) {
		$min_prices = array( 500, 1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000 );
		$inspiry_min_prices = $inspiry_options[ 'inspiry_minimum_rent_prices' ];
	} else {
		$min_prices = array( 1000, 5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000 );
		$inspiry_min_prices = $inspiry_options[ 'inspiry_minimum_prices' ];
	}

	// Convert prices to an integer array
	if ( !empty( $inspiry_min_prices ) ) {
		$min_prices_str = explode(',',$inspiry_min_prices);
		if ( is_array( $min_prices_str ) && !empty( $min_prices_str ) ) {
			$new_min_prices = array();
			foreach ( $min_prices_str as $price_str ){
				$price_num = doubleval( $price_str );
				if ( $price_num > 1 ) {
					$new_min_prices[] = $price_num;
				}
			}
			if ( !empty( $new_min_prices ) ) {
				$min_prices = $new_min_prices;
			}
		}
	}

	$mini_price_parameter = '';
	if(isset($_GET['min-price'])){
		$mini_price_parameter = doubleval( $_GET['min-price'] );
	}

	if( $mini_price_parameter == 'any' || empty( $mini_price_parameter ) ) {
		echo '<option value="any" selected="selected">' . $default_label . '</option>';
	} else {
		echo '<option value="any">' . $default_label .'</option>';
	}

	if ( class_exists( 'Inspiry_Property' ) ) {
		if( !empty( $min_prices ) ) {
			foreach( $min_prices as $price ){
				if( $mini_price_parameter == $price ){
					echo '<option value="'.$price.'" selected="selected">' . Inspiry_Property::format_price( $price ) . '</option>';
				}else {
					echo '<option value="'.$price.'">' . Inspiry_Property::format_price( $price ) . '</option>';
				}
			}
		}
	}

}



/**
 * Output options for maximum price select box in property search form
 */
function ire_maximum_prices_options( $status = 'sale' ) {
	global $inspiry_options;
	$get_max_price_label = $inspiry_options['inspiry_search_property_max_price_label'];
	$default_label = !empty($get_max_price_label)? $get_max_price_label: esc_html__( 'Max Price (Any)', 'inspiry-real-estate');
	if ( $status == 'rent' ) {
		$max_prices = array( 1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000, 150000 );
		$inspiry_max_prices = $inspiry_options[ 'inspiry_maximum_rent_prices' ];
	} else {
		$max_prices = array( 5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000, 10000000 );
		$inspiry_max_prices = $inspiry_options[ 'inspiry_maximum_prices' ];
	}

	// Convert prices to an integer array
	if ( !empty( $inspiry_max_prices ) ) {
		$max_prices_strs = explode( ',', $inspiry_max_prices );
		if ( is_array( $max_prices_strs ) && !empty( $max_prices_strs ) ) {
			$new_max_prices = array();
			foreach ( $max_prices_strs as $price_str ) {
				$price_num = doubleval( $price_str );
				if ( $price_num > 1 ) {
					$new_max_prices[] = $price_num;
				}
			}
			if ( !empty( $new_max_prices ) ) {
				$max_prices = $new_max_prices;
			}
		}
	}

	$maximum_price = '';
	if ( isset( $_GET['max-price'] ) ) {
		$maximum_price = doubleval( $_GET['max-price'] );
	}

	if ( $maximum_price == 'any' || empty( $maximum_price ) ) {
		echo '<option value="any" selected="selected">' . $default_label . '</option>';
	} else {
		echo '<option value="any">' . $default_label . '</option>';
	}

	if ( !empty ( $max_prices ) ) {
		foreach( $max_prices as $price ) {
			if ( $maximum_price == $price ) {
				echo '<option value="' . $price . '" selected="selected">' . Inspiry_Property::format_price( $price ) . '</option>';
			} else {
				echo '<option value="' . $price . '">' . Inspiry_Property::format_price( $price ) . '</option>';
			}
		}
	}

}



/**
 * Get location titles
 *
 * @param int $location_select_count
 * @return array Location titles
 */
function ire_get_location_titles ( $location_select_count = 1 ) {

	// Default location select boxes titles
	$location_titles = array(
		esc_html__( 'City', 'inspiry-real-estate' ),
		esc_html__( 'Area', 'inspiry-real-estate' ),
	);

	if ( $location_select_count == 1 ) {
		$location_titles = array(
			esc_html__( 'City', 'inspiry-real-estate' ),
		);
	} elseif ( $location_select_count == 2 ) {
		$location_titles = array(
			esc_html__( 'City', 'inspiry-real-estate' ),
			esc_html__( 'Area', 'inspiry-real-estate' ),
		);
	} elseif ( $location_select_count == 3 ) {
		$location_titles = array(
			esc_html__( 'State', 'inspiry-real-estate' ),
			esc_html__( 'City', 'inspiry-real-estate' ),
			esc_html__( 'Area', 'inspiry-real-estate' ),
		);
	} elseif ( $location_select_count == 4 ) {
		$location_titles = array(
			esc_html__( 'Country', 'inspiry-real-estate' ),
			esc_html__( 'State', 'inspiry-real-estate' ),
			esc_html__( 'City', 'inspiry-real-estate' ),
			esc_html__( 'Area', 'inspiry-real-estate' ),
		);
	}

	return $location_titles;
}



/**
 * Return location select names
 * @return mixed|void
 */
function ire_get_location_select_names() {
	$location_select_names = array( 'location', 'child-location', 'grandchild-location', 'great-grandchild-location' );
	return apply_filters( 'inspiry_location_select_names', $location_select_names );
}



/**
 * Return number of location boxes required in search form
 *
 * @return int number of locations
 */
function ire_get_locations_number() {
	global $inspiry_options;
	$location_select_count = intval( $inspiry_options[ 'inspiry_search_locations_number' ] );
	if( ! ( $location_select_count > 0 && $location_select_count < 5) ){
		$location_select_count = 1;
	}
	return $location_select_count;
}



/**
 * Output select options for bedrooms and bathrooms
 * @param $options_for  string  Options are generated for ( bedrooms or bathrooms )
 * @param $any_title    string  Title for option with value any
 */
function ire_number_options( $options_for, $any_title  ) {

	global $inspiry_options;
	$get_beds_values = $inspiry_options['inspiry_search_property_min_beds'];
	$get_baths_values = $inspiry_options['inspiry_search_property_min_baths'];

	$numbers_array = array();
	if ( $options_for == 'bedrooms' ) {
		if ( ! empty( $get_beds_values ) ) {
			$numbers_array = explode( ',', $get_beds_values );
		} else {
			$numbers_array = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 );
		}
	}elseif ( $options_for == 'bathrooms' ) {
		if ( ! empty( $get_baths_values ) ) {
			$numbers_array = explode( ',', $get_baths_values );
		} else {
			$numbers_array = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 );
		}
	}

	$searched_value = '';

	if ( $options_for == 'bedrooms' ) {
		$numbers_array = apply_filters( 'inspiry_search_bedrooms', $numbers_array );
		if( isset( $_GET['bedrooms'] ) ) {
			$searched_value = $_GET['bedrooms'];
		}
	} elseif ( $options_for == 'bathrooms' ) {
		$numbers_array = apply_filters( 'inspiry_search_bathrooms', $numbers_array );
		if(isset($_GET['bathrooms'])) {
			$searched_value = $_GET['bathrooms'];
		}
	}

	if ( $searched_value == 'any' || empty( $searched_value ) ) {
		echo '<option value="any" selected="selected">'.$any_title.'</option>';
	} else {
		echo '<option value="any">'.$any_title.'</option>';
	}

	if ( !empty( $numbers_array ) ) {
		foreach ( $numbers_array as $number ) {
			if( $searched_value == $number ) {
				echo '<option value="'.$number.'" selected="selected">'.$number.'</option>';
			} else {
				echo '<option value="'.$number.'">'.$number.'</option>';
			}
		}
	}

}



/**
 * Output hierarchical select options with selection based on term id
 * @param $taxonomy_name
 * @param $taxonomy_terms
 * @param $target_term_id
 * @param string $prefix
 */
function ire_hierarchical_id_options($taxonomy_name, $taxonomy_terms, $target_term_id, $prefix = " " ){

	if ( ! empty( $taxonomy_terms ) && ! is_wp_error( $taxonomy_terms ) ){

		foreach ( $taxonomy_terms as $term ) {
			if ( $target_term_id == $term->term_id ) {
				echo '<option value="' . $term->term_id . '" selected="selected">' . $prefix . $term->name . '</option>';
			} else {
				echo '<option value="' . $term->term_id . '">' . $prefix . $term->name . '</option>';
			}
			$child_terms = get_terms( $taxonomy_name, array(
				'orderby' => 'name',
				'order' => 'ASC',
				'hide_empty' => false,
				'parent' => $term->term_id
			) );

			if ( ! empty( $child_terms ) && !is_wp_error( $child_terms ) ){
				/* Recursive Call */
				ire_hierarchical_id_options( $taxonomy_name, $child_terms, $target_term_id, "- " . $prefix );
			}
		}

	}

}


/**
 * Inspiry generate options based on given query arguments or CPT name
 *
 * @param $post_args
 * @param int $selected
 */
function ire_generate_cpt_options( $post_args, $selected = 0 ) {

	$defaults = array( 'posts_per_page' => -1 );

	if ( is_array( $post_args ) ) {
		$post_args = wp_parse_args( $post_args, $defaults );
	} else {
		$post_args = wp_parse_args( array( 'post_type' => $post_args ), $defaults );
	}

	$posts = get_posts( $post_args );
	foreach ( $posts as $post ) :

		$item_selected = '';
		if ( isset( $selected ) && ( ( is_array( $selected ) && in_array( $post->ID, $selected ) ) || ( $selected == $post->ID ) ) ) {
			$item_selected = "selected";
		}

		?><option value="<?php echo esc_attr( $post->ID ); ?>" <?php echo esc_attr( $item_selected ); ?>><?php echo esc_html( $post->post_title ); ?></option><?php
	endforeach;
}


/**
 * Property edit form hierarchical taxonomy options
 *
 * @param $property_id
 * @param $taxonomy_name
 */
function ire_hierarchical_edit_options( $property_id, $taxonomy_name ){

	$existing_term_id = 0;
	$tax_terms = get_the_terms( $property_id, $taxonomy_name );
	if ( !empty( $tax_terms ) && !is_wp_error( $tax_terms ) ) {
		foreach( $tax_terms as $tax_term ) {
			$existing_term_id = $tax_term->term_id;
			break;
		}
	}

	$existing_term_id = intval( $existing_term_id );
	if ( $existing_term_id == 0 || empty( $existing_term_id ) ) {
		echo '<option value="-1" selected="selected">' . esc_html__( 'None', 'inspiry-real-estate' ) . '</option>';
	} else {
		echo '<option value="-1">' . esc_html__( 'None', 'inspiry-real-estate' ) . '</option>';
	}

	$top_level_terms = get_terms(
		array(
			$taxonomy_name
		),
		array(
			'orderby' => 'name',
			'order' => 'ASC',
			'hide_empty' => false,
			'parent' => 0,
		)
	);

	ire_hierarchical_id_options( $taxonomy_name, $top_level_terms, $existing_term_id );

}


/**
 * Returns translated page id if exists otherwise default page id
 *
 * @param $default_page_id
 * @return int
 */
function ire_wpml_translated_page_id( $default_page_id ) {

	/* WPML filter to get translated page id if translation exists otherwise default id */
	return apply_filters( 'wpml_object_id', $default_page_id, 'page', true  );

}


/**
 * Returns terms array for a given taxonomy containing key(slug) value(name) pair
 *
 * @param $tax_name
 * @param $terms_array
 */
function ire_get_terms_array( $tax_name, &$terms_array ) {
	$tax_terms = get_terms( $tax_name, array (
		'hide_empty' => false,
	) );
	ire_add_term_children( 0, $tax_terms, $terms_array );
}


/**
 * A recursive function to add children terms to given array
 *
 * @param $parent_id
 * @param $tax_terms
 * @param $terms_array
 * @param string $prefix
 */
function ire_add_term_children( $parent_id, $tax_terms, &$terms_array, $prefix = '' ) {
	if ( !empty( $tax_terms ) && !is_wp_error( $tax_terms ) ) {
		foreach ( $tax_terms as $term ) {
			if ( $term->parent ==  $parent_id ) {
				$terms_array[ $term->slug ] = $prefix . $term->name;
				ire_add_term_children( $term->term_id, $tax_terms, $terms_array, $prefix . '- ' );
			}
		}
	}
}