<?php
/*
Element Description: Property Listing
*/

// Element Class
class Inspiry_VC_Lead extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'inspiry_properties', array( $this, 'element_output' ) );
	}

	// Element Mapping
	public function element_mapping() {

		// Stop all if VC is not enabled
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			return;
		}

		// locations
		$property_cities_array = array();
		$property_cities       = get_terms( array( 'taxonomy' => 'property-city' ) );
		if ( ! empty( $property_cities ) && ! is_wp_error( $property_cities ) ) {
			foreach ( $property_cities as $property_city ) {
				$property_cities_array[ $property_city->name ] = $property_city->slug;
			}
		}

		// statuses
		$property_statuses_array = array();
		$property_statuses       = get_terms( array( 'taxonomy' => 'property-status' ) );
		if ( ! empty( $property_statuses ) && ! is_wp_error( $property_statuses ) ) {
			foreach ( $property_statuses as $property_status ) {
				$property_statuses_array[ $property_status->name ] = $property_status->slug;
			}
		}

		// types
		$property_types_array = array();
		$property_types       = get_terms( array( 'taxonomy' => 'property-type' ) );
		if ( ! empty( $property_types ) && ! is_wp_error( $property_types ) ) {
			foreach ( $property_types as $property_type ) {
				$property_types_array[ $property_type->name ] = $property_type->slug;
			}
		}

		// features
		$property_features_array = array();
		$property_features       = get_terms( array( 'taxonomy' => 'property-feature' ) );
		if ( ! empty( $property_features ) && ! is_wp_error( $property_features ) ) {
			foreach ( $property_features as $property_feature ) {
				$property_features_array[ $property_feature->name ] = $property_feature->slug;
			}
		}

		// Map the block with vc_map()
		vc_map(

			array(
				'name'        => esc_html__( 'Properties', 'inspiry-real-estate' ),
				'base'        => 'inspiry_properties',
				'description' => esc_html__( 'Display property listing.', 'inspiry-real-estate' ),
				'category'    => esc_html__( 'Real Places Theme', 'inspiry-real-estate' ),
				"params"      => array(
					array(
						"type"        => "dropdown",
						"heading"     => esc_html__( "Layout", 'inspiry-real-estate' ),
						"param_name"  => "layout",
						"value"       => array(
							'Grid'                  => 'grid',
							'List'                  => 'list',
							'List with Description' => 'list-desc'
						),
						'admin_label' => true,
					),
					array(
						"type"        => "dropdown",
						"heading"     => esc_html__( "Number of Properties", 'inspiry-real-estate' ),
						"param_name"  => "count",
						"value"       => array(
							esc_html__( 'All', 'inspiry-real-estate' ) => - 1,
							'1'                                        => 1,
							'2'                                        => 2,
							'3'                                        => 3,
							'4'                                        => 4,
							'5'                                        => 5,
							'6'                                        => 6,
							'7'                                        => 7,
							'8'                                        => 8,
							'9'                                        => 9,
							'10'                                       => 10,
							'11'                                       => 11,
							'12'                                       => 12,
							'13'                                       => 13,
							'14'                                       => 14,
							'15'                                       => 15,
							'16'                                       => 16,
						),
						'admin_label' => true,
					),
					array(
						"type"       => "dropdown",
						"heading"    => esc_html__( "Order By", 'inspiry-real-estate' ),
						"param_name" => "orderby",
						"value"      => array(
							esc_html__( 'Date', 'inspiry-real-estate' )  => 'date',
							esc_html__( 'Price', 'inspiry-real-estate' ) => 'price'
						),
					),
					array(
						"type"       => "dropdown",
						"heading"    => esc_html__( "Order", 'inspiry-real-estate' ),
						"param_name" => "order",
						"value"      => array(
							esc_html__( 'Descending', 'inspiry-real-estate' ) => 'DESC',
							esc_html__( 'Ascending', 'inspiry-real-estate' )  => 'ASC'
						),
					),
					array(
						"type"        => "checkbox",
						"heading"     => esc_html__( "Locations", 'inspiry-real-estate' ),
						"param_name"  => "locations",
						"value"       => $property_cities_array,
						'admin_label' => true,
					),
					array(
						"type"        => "checkbox",
						"heading"     => esc_html__( "Statuses", 'inspiry-real-estate' ),
						"param_name"  => "statuses",
						"value"       => $property_statuses_array,
						'admin_label' => true,
					),
					array(
						"type"        => "checkbox",
						"heading"     => esc_html__( "Types", 'inspiry-real-estate' ),
						"param_name"  => "types",
						"value"       => $property_types_array,
						'admin_label' => true,
					),
					array(
						"type"        => "dropdown",
						"heading"     => esc_html__( "Minimum Bedrooms", 'inspiry-real-estate' ),
						"param_name"  => "min_beds",
						"value"       => array(
							'Any' => null,
							'1'   => 1,
							'2'   => 2,
							'3'   => 3,
							'4'   => 4,
							'5'   => 5,
							'6'   => 6,
							'7'   => 7,
							'8'   => 8,
							'9'   => 9,
						),
						'admin_label' => true,
					),
					array(
						"type"        => "dropdown",
						"heading"     => esc_html__( "Maximum Bedrooms", 'inspiry-real-estate' ),
						"param_name"  => "max_beds",
						"value"       => array(
							'Any' => null,
							'1'   => 1,
							'2'   => 2,
							'3'   => 3,
							'4'   => 4,
							'5'   => 5,
							'6'   => 6,
							'7'   => 7,
							'8'   => 8,
							'9'   => 9,
							'10'  => 10,
							'11'  => 11,
							'12'  => 12,
						),
						'admin_label' => true,
					),
					array(
						"type"        => "dropdown",
						"heading"     => esc_html__( "Minimum Bathrooms", 'inspiry-real-estate' ),
						"param_name"  => "min_baths",
						"value"       => array(
							'Any' => null,
							'1'   => 1,
							'2'   => 2,
							'3'   => 3,
							'4'   => 4,
							'5'   => 5,
							'6'   => 6,
							'7'   => 7,
							'8'   => 8,
							'9'   => 9,
						),
						'admin_label' => true,
					),
					array(
						"type"        => "dropdown",
						"heading"     => esc_html__( "Maximum Bathrooms", 'inspiry-real-estate' ),
						"param_name"  => "max_baths",
						"value"       => array(
							'Any' => null,
							'1'   => 1,
							'2'   => 2,
							'3'   => 3,
							'4'   => 4,
							'5'   => 5,
							'6'   => 6,
							'7'   => 7,
							'8'   => 8,
							'9'   => 9,
							'10'  => 10,
							'11'  => 11,
							'12'  => 12,
						),
						'admin_label' => true,
					),
					array(
						"type"        => "textfield",
						"heading"     => esc_html__( "Minimum Price", 'inspiry-real-estate' ),
						"description" => esc_html__( "Only provide digits", 'inspiry-real-estate' ),
						"param_name"  => "min_price",
						"value"       => '',
						'admin_label' => true,
					),
					array(
						"type"        => "textfield",
						"heading"     => esc_html__( "Maximum Price", 'inspiry-real-estate' ),
						"description" => esc_html__( "Only provide digits", 'inspiry-real-estate' ),
						"param_name"  => "max_price",
						"value"       => '',
						'admin_label' => true,
					),
					array(
						"type"        => "textfield",
						"heading"     => esc_html__( "Minimum Area", 'inspiry-real-estate' ),
						"description" => esc_html__( "Only provide digits", 'inspiry-real-estate' ),
						"param_name"  => "min_area",
						"value"       => '',
						'admin_label' => true,
					),
					array(
						"type"        => "textfield",
						"heading"     => esc_html__( "Maximum Area", 'inspiry-real-estate' ),
						"description" => esc_html__( "Only provide digits", 'inspiry-real-estate' ),
						"param_name"  => "max_area",
						"value"       => '',
						'admin_label' => true,
					),
					array(
						"type"        => "dropdown",
						"heading"     => esc_html__( "Display Only Featured Properties", 'inspiry-real-estate' ),
						"param_name"  => "featured",
						"value"       => array(
							esc_html__( 'No', 'inspiry-real-estate' )  => 'no',
							esc_html__( 'Yes', 'inspiry-real-estate' ) => 'yes',
						),
						'admin_label' => true,
					),
					array(
						"type"        => "checkbox",
						"heading"     => esc_html__( "Features", 'inspiry-real-estate' ),
						"param_name"  => "features",
						"value"       => $property_features_array,
						'admin_label' => true,
					),
					array(
						"type"        => "dropdown",
						"heading"     => esc_html__( "Listing Container", 'inspiry-real-estate' ),
						"param_name"  => "container",
						"value"       => array(
							esc_html__( 'Full Width', 'inspiry-real-estate' ) => 'no',
							esc_html__( 'Boxed', 'inspiry-real-estate' )      => 'yes',
						),
						'admin_label' => true,
					),
				)
			)
		);
	}

	// Element HTML
	public function element_output( $attr ) {

		// Params extraction
		extract(
			shortcode_atts(
				array(
					'count'     => 3,
					'layout'    => 'grid',
					'orderby'   => 'date',
					'order'     => 'DESC',
					'locations' => null,
					'statuses'  => null,
					'types'     => null,
					'features'  => null,
					'relation'  => 'AND',
					'min_beds'  => null,
					'max_beds'  => null,
					'min_baths' => null,
					'max_baths' => null,
					'min_price' => null,
					'max_price' => null,
					'min_area'  => null,
					'max_area'  => null,
					'featured'  => 'no',
					'container' => 'no',
				),
				$attr
			)
		);

		ob_start();

		if ( ! function_exists( 'inspiry_theme_setup' ) ) {
			echo '<p class="alert alert-warning">' . esc_html__( 'Real Places theme must be activated to use Property Listing Visual Composer element!', 'inspiry-real-estate' ) . '</p>';
			return;
		}

		$properties_query_args = array(
			'post_type'      => 'property',
			'posts_per_page' => $count,
		);

		// Order By
		if ( $orderby == 'price' ) {
			$properties_query_args['orderby']  = 'meta_value_num';
			$properties_query_args['meta_key'] = 'REAL_HOMES_property_price';
		} else {
			$properties_query_args['orderby'] = 'date';
		}

		// Order
		if ( $order == 'ASC' || $order == 'asc' ) {
			$properties_query_args['order'] = 'ASC';
		} else {
			$properties_query_args['order'] = 'DESC';
		}

		// Properties Taxonomy Query
		$tax_query = array();

		// Properties types
		if ( $types ) {
			$types       = explode( ',', $types );
			$tax_query[] = array(
				'taxonomy' => 'property-type',
				'field'    => 'slug',
				'terms'    => $types
			);
		}

		// Properties statuses
		if ( $statuses ) {
			$statuses    = explode( ',', $statuses );
			$tax_query[] = array(
				'taxonomy' => 'property-status',
				'field'    => 'slug',
				'terms'    => $statuses
			);
		}

		// Properties locations
		if ( $locations ) {
			$locations   = explode( ',', $locations );
			$tax_query[] = array(
				'taxonomy' => 'property-city',
				'field'    => 'slug',
				'terms'    => $locations
			);
		}

		// Properties features
		if ( $features ) {
			$features    = explode( ',', $features );
			$tax_query[] = array(
				'taxonomy' => 'property-feature',
				'field'    => 'slug',
				'terms'    => $features
			);
		}

		// Taxonomy query relationship only if taxonomies are more than one
		$tax_count = count( $tax_query );
		if ( $tax_count > 1 ) {
			if ( $relation == 'OR' ) {
				$tax_query['relation'] = 'OR';
			} else {
				$tax_query['relation'] = 'AND';
			}
		}
		if ( $tax_count > 0 ) {
			$properties_query_args['tax_query'] = $tax_query;
		}


		// Properties Meta Query
		$meta_query = array();

		// Bedrooms
		if ( ! empty( $min_beds ) || ! empty( $max_beds ) ) {
			$min_beds = abs( intval( $min_beds ) );
			$max_beds = abs( intval( $max_beds ) );
			if ( $max_beds > 0 ) {
				// If max beds are greater than 0 then either min beds are 0 or greater than 0,
				// And in both cases same query will be enough
				$meta_query[] = array(
					'key'     => 'REAL_HOMES_property_bedrooms',
					'value'   => array( $min_beds, $max_beds ),
					'type'    => 'NUMERIC',
					'compare' => 'BETWEEN',
				);
			} else {
				// if max beds are 0 then only min beds matters
				$meta_query[] = array(
					'key'     => 'REAL_HOMES_property_bedrooms',
					'value'   => $min_beds,
					'type'    => 'NUMERIC',
					'compare' => '>=',
				);
			}
		}

		// Bathrooms
		if ( ! empty( $min_baths ) || ! empty( $max_baths ) ) {
			$min_baths = abs( intval( $min_baths ) );
			$max_baths = abs( intval( $max_baths ) );
			if ( $max_baths > 0 ) {
				// If max baths are greater than 0 then either min baths are 0 or greater than 0,
				// And in both cases same query will be enough
				$meta_query[] = array(
					'key'     => 'REAL_HOMES_property_bathrooms',
					'value'   => array( $min_baths, $max_baths ),
					'type'    => 'NUMERIC',
					'compare' => 'BETWEEN',
				);
			} else {
				// if max baths are 0 then only min baths matters
				$meta_query[] = array(
					'key'     => 'REAL_HOMES_property_bathrooms',
					'value'   => $min_baths,
					'type'    => 'NUMERIC',
					'compare' => '>=',
				);
			}
		}

		// Price
		if ( ! empty( $min_price ) || ! empty( $max_price ) ) {
			$min_price = doubleval( $min_price );
			$max_price = doubleval( $max_price );
			if ( $max_price > 0 ) {
				// If max price is greater than 0 then either min price is 0 or greater than 0,
				// And in both cases same query will be enough
				$meta_query[] = array(
					'key'     => 'REAL_HOMES_property_price',
					'value'   => array( $min_price, $max_price ),
					'type'    => 'NUMERIC',
					'compare' => 'BETWEEN',
				);
			} else {
				// if max price is 0 then only min price matters
				$meta_query[] = array(
					'key'     => 'REAL_HOMES_property_price',
					'value'   => $min_price,
					'type'    => 'NUMERIC',
					'compare' => '>=',
				);
			}
		}

		// Size
		if ( ! empty( $min_area ) || ! empty( $max_area ) ) {
			$min_area = intval( $min_area );
			$max_area = intval( $max_area );
			if ( $max_area > 0 ) {
				// If max area is greater than 0 then either min area is 0 or greater than 0,
				// And in both cases same query will be enough
				$meta_query[] = array(
					'key'     => 'REAL_HOMES_property_size',
					'value'   => array( $min_area, $max_area ),
					'type'    => 'NUMERIC',
					'compare' => 'BETWEEN',
				);
			} else {
				// if max area is 0 then only min area matters
				$meta_query[] = array(
					'key'     => 'REAL_HOMES_property_size',
					'value'   => $min_area,
					'type'    => 'NUMERIC',
					'compare' => '>=',
				);
			}
		}

		//Featured Properties
		$featured = ( $featured == 'yes' ) ? true : false;
		if ( $featured ) {
			$meta_query[] = array(
				'key'     => 'REAL_HOMES_featured',
				'value'   => 1,
				'compare' => '=',
				'type'    => 'NUMERIC'
			);
		}

		// if more than one meta query elements exist then specify the relation
		$meta_count = count( $meta_query );
		if ( $meta_count > 1 ) {
			if ( $relation == 'OR' ) {
				$meta_query['relation'] = 'OR';
			} else {
				$meta_query['relation'] = 'AND';
			}
		}
		if ( $meta_count > 0 ) {
			$properties_query_args['meta_query'] = $meta_query;
		}

		$properties_query = new WP_Query( apply_filters( 'inspiry_vc_properties', $properties_query_args ) );

		global $inspiry_options;

		echo '<div class="inspiry-vc-property-listing">';

		if ( 'yes' == $container ) {
			echo '<div class="container">';
		}

		if ( 'list' == $layout ) {

			// VC Properties Loop
			if ( $properties_query->have_posts() ) :
				?>
				<div class="row">
					<div class="col-md-12">
						<?php

							while ( $properties_query->have_posts() ) :
								$properties_query->the_post();
								$list_property = new Inspiry_Property( get_the_ID() );
								?>
								<article class="property-listing-simple property-listing-simple-2 hentry clearfix">
									<div class="property-thumbnail col-sm-5 zero-horizontal-padding">
										<div class="price-wrapper">
											<span class="price"><?php $list_property->price(); ?></span>
										</div>
										<?php
											/*
											 * Display image gallery or thumbnail
											 */
											if ( $inspiry_options['inspiry_property_card_gallery'] ) {
												inspiry_property_gallery( $list_property->get_post_ID(), intval( $inspiry_options['inspiry_property_card_gallery_limit'] ) );
											} else {
												inspiry_thumbnail();
											}
										?>
									</div>
									<!-- .property-thumbnail -->

									<div class="title-and-meta col-sm-7">

										<header class="entry-header">
											<h3 class="entry-title">
												<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
											</h3>
										</header>

										<?php
											/*
											 * Property meta
											 */
											inspiry_property_meta( $list_property, array(
												'meta' => array(
													'area',
													'beds',
													'baths',
													'garages',
													'type',
													'status'
												)
											) );
										?>

									</div>
									<!-- .title-and-meta -->

								</article><!-- .property-listing-simple-2 -->
								<?php

							endwhile;
						?>

					</div>
					<!-- .site-main-content -->
				</div><!-- .row -->
				<?php
			endif;

			wp_reset_postdata();

		} else if ( 'list-desc' == $layout ) {

			// VC Properties Loop
			if ( $properties_query->have_posts() ) :
				?>
				<div class="row">
					<div class="col-md-12">
						<?php

							$property_list_counter = 1;
							while ( $properties_query->have_posts() ) :
								$properties_query->the_post();

								$list_property = new Inspiry_Property( get_the_ID() );

								/*
								 * Even / Odd Class
								 */
								$even_odd_class = 'listing-post-odd';
								if ( $property_list_counter % 2 == 0 ) {
									$even_odd_class = 'listing-post-even';
								}

								/*
								 * Price title
								 */
								$price_title = esc_html__( 'Price', 'insiry-real-estate' );
								if ( ! empty( $inspiry_options['inspiry_property_card_price_title'] ) ) {
									$price_title = $inspiry_options['inspiry_property_card_price_title'];
								}

								/*
								 * Description title
								 */
								$desc_title = esc_html__( 'Description', 'insiry-real-estate' );
								if ( ! empty( $inspiry_options['inspiry_property_card_desc_title'] ) ) {
									$desc_title = $inspiry_options['inspiry_property_card_desc_title'];
								}

								/*
								 * Button Text
								 */
								$button_text = esc_html__( 'Show Details', 'insiry-real-estate' );
								if ( ! empty( $inspiry_options['inspiry_property_card_button_text'] ) ) {
									$button_text = $inspiry_options['inspiry_property_card_button_text'];
								}
								?>
								<article class="property-listing-simple property-listing-simple-1 hentry clearfix <?php echo esc_attr( $even_odd_class ); ?>">

									<div class="property-thumbnail col-sm-4 zero-horizontal-padding">
										<?php
											/*
											 * Display image gallery or thumbnail
											 */
											if ( $inspiry_options['inspiry_property_card_gallery'] ) {
												inspiry_property_gallery( $list_property->get_post_ID(), intval( $inspiry_options['inspiry_property_card_gallery_limit'] ) );
											} else {
												inspiry_thumbnail();
											}
										?>
									</div><!-- .property-thumbnail -->

									<div class="title-and-meta col-sm-8">

										<header class="entry-header">

											<h3 class="entry-title">
												<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
											</h3>

											<div class="price-wrapper hidden-lg">
												<span class="prefix-text"><?php echo esc_html( $price_title ); ?></span>
												<span class="price"><?php echo esc_html( $list_property->get_price_without_postfix() ); ?></span><?php
													$price_postfix = $list_property->get_price_postfix();
													if ( ! empty( $price_postfix ) ) {
														?>
														<span class="postfix-text"><?php echo ' ' . $price_postfix; ?></span><?php
													}
												?>
											</div>

											<?php
												/*
												 * Address
												 */
												$list_property_address = $list_property->get_address();
												if ( ! empty( $list_property_address ) ) {
													?><p class="property-address visible-lg">
													<i class="fas fa-map-marker-alt"></i><?php echo esc_html( $list_property_address ); ?>
													</p><?php
												}
											?>
										</header>

										<?php
											/*
											 * Property meta
											 */
											inspiry_property_meta( $list_property, array(
												'meta' => array(
													'area',
													'beds',
													'baths',
													'garages',
													'type',
													'status'
												)
											) );
										?>

										<a class="btn-default visible-md-inline-block" href="<?php the_permalink(); ?>"><?php echo esc_html( $button_text ); ?>
											<i class="fa fa-angle-right"></i></a>

									</div><!-- .title-and-meta -->

									<div class="property-description visible-lg">

										<?php
											/*
											 * Description
											 */
											$property_excerpt = ire_get_excerpt( 12 );
											if ( ! empty( $property_excerpt ) ) {
												?>
												<h4 class="title-heading"><?php echo esc_html( $desc_title ); ?></h4>
												<p><?php echo esc_html( $property_excerpt ); ?></p>
												<?php
											}
										?>

										<div class="price-wrapper">
											<span class="prefix-text"><?php echo esc_html( $price_title ); ?></span>
											<span class="price"><?php echo esc_html( $list_property->get_price_without_postfix() ); ?></span><?php
												$price_postfix = $list_property->get_price_postfix();
												if ( ! empty( $price_postfix ) ) {
													?>
													<span class="postfix-text"><?php echo ' ' . $price_postfix; ?></span><?php
												}
											?>
										</div>

										<a class="btn-default" href="<?php the_permalink(); ?>"><?php echo esc_html( $button_text ); ?>
											<i class="fa fa-angle-right"></i></a>

									</div><!-- .property-description -->

								</article><!-- .property-listing-simple -->
								<?php

								$property_list_counter ++;

							endwhile;

						?>

					</div>
					<!-- .site-main-content -->

				</div><!-- .row -->
				<?php
			endif;

			wp_reset_postdata();

		} else {

			// VC Properties Loop
			if ( $properties_query->have_posts() ) :
				?>
				<div class="row">
					<?php
						$properties_count = 1;
						$columns_count    = 3;

						while ( $properties_query->have_posts() ) :

							$properties_query->the_post();

							$vc_property = new Inspiry_Property( get_the_ID() );
							?>
							<div class="col-xs-6 custom-col-xs-12 col-sm-6 col-md-4 <?php echo inspiry_col_animation_class( $columns_count, $properties_count ) . ' ' . inspiry_animation_class(); ?>">

								<article class="hentry property-listing-three-post image-transition ">

									<div class="property-thumbnail">
										<?php inspiry_thumbnail(); ?>
										<?php
											$first_status_term = $vc_property->get_taxonomy_first_term( 'property-status', 'all' );
											if ( $first_status_term ) {
												?>
												<a href="<?php echo esc_url( get_term_link( $first_status_term ) ); ?>">
													<span class="property-status"><?php echo esc_html( $first_status_term->name ); ?></span>
												</a>
												<?php
											}
										?>
									</div>
									<!-- .property-thumbnail -->

									<div class="property-description">

										<header class="entry-header">
											<h4 class="entry-title">
												<a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo get_inspiry_custom_excerpt( get_the_title(), 9 ); ?></a>
											</h4>
											<div class="price-and-status">
												<span class="price"><?php echo esc_html( $vc_property->get_price() ); ?></span>
											</div>
										</header>

										<p><?php ire_excerpt( 10, "" ); ?></p>

										<div class="property-meta entry-meta clearfix">
											<?php
												/*
												 * Area
												 */
												$inspiry_property_area = $vc_property->get_area();
												if ( $inspiry_property_area ) {
													?>
													<div class="meta-wrapper">
														<span class="meta-value"><?php echo esc_html( $inspiry_property_area ); ?></span>
														<sub class="meta-unit"><?php echo esc_html( $vc_property->get_area_postfix() ); ?></sub>
													</div>
													<?php
												}

												/*
												 * Beds
												 */
												$inspiry_property_beds = $vc_property->get_beds();
												if ( $inspiry_property_beds ) {
													?>
													<div class="meta-wrapper">
														<span class="meta-value"><?php echo esc_html( $inspiry_property_beds ); ?></span>
														<span class="meta-label"><?php echo _n( 'Bed', 'Beds', $inspiry_property_beds, 'insiry-real-estate' ); ?></span>
													</div>
													<?php
												}

												/*
												* Beds
												*/
												$inspiry_property_baths = $vc_property->get_baths();
												if ( $inspiry_property_baths ) {
													?>
													<div class="meta-wrapper">
														<span class="meta-value"><?php echo esc_html( $inspiry_property_baths ); ?></span>
														<span class="meta-label"><?php echo _n( 'Bath', 'Baths', $inspiry_property_baths, 'insiry-real-estate' ); ?></span>
													</div>
													<?php
												}

												/*
												* Garages
												*/
												$inspiry_property_garages = $vc_property->get_garages();
												if ( $inspiry_property_garages ) {
													?>
													<div class="meta-wrapper">
														<span class="meta-value"><?php echo esc_html( $inspiry_property_garages ); ?></span>
														<span class="meta-label"><?php echo _n( 'Garage', 'Garages', $inspiry_property_garages, 'insiry-real-estate' ); ?></span>
													</div>
													<?php
												}
											?>

										</div>

									</div>
									<!-- .property-description -->

								</article>

							</div>
							<?php
							$properties_count ++;

						endwhile;
					?>
				</div><!-- .row -->
				<?php
			endif;

			wp_reset_postdata();
		}

		if ( 'yes' == $container ) {
			echo '</div>';
			// .container
		}

		echo '</div>';
		// .inspiry-vc-property-listing

		return ob_get_clean();
	}

} // End Element Class

// Element Class Init
new Inspiry_VC_Lead();