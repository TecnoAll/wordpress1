<?php
/*
 * Template Name: Compare Properties
 */

get_header();

get_template_part( 'partials/header/banner' );

if ( isset( $_COOKIE['inspiry_compare'] ) ) {
	$compare_list_items = unserialize( $_COOKIE['inspiry_compare'] );
}

$count = 0;

if ( ! empty( $compare_list_items ) ) {

	foreach ( $compare_list_items as $compare_list_item ) {

		if ( 4 > $count ) {

			$compare_property = get_post( $compare_list_item );

			if ( isset( $compare_property->ID ) ) {
				$thumbnail_id = get_post_thumbnail_id( $compare_property->ID );
				if ( isset( $thumbnail_id ) && ! empty( $thumbnail_id ) ) {
					$compare_property_img = wp_get_attachment_image_src(
						get_post_meta( $compare_property->ID, '_thumbnail_id', true ), 'inspiry-agent-thumbnail'
					);
				} else {
					$compare_property_img[0] = get_inspiry_image_placeholder_url( 'inspiry-agent-thumbnail' );
				}
				$compare_property_permalink = get_permalink( $compare_property->ID );
				$compare_properties[]       = array(
					'ID'        => $compare_property->ID,
					'title'     => $compare_property->post_title,
					'img'       => $compare_property_img,
					'permalink' => $compare_property_permalink,
				);
			}
		} else {
			break;
		}

		$count ++;

	}
}


?>

	<!-- Content -->
	<div class="wrapper-template-compare-contents">

		<div class="container contents single">

			<div>

				<div class="span12 main-wrap">
					<!-- Main Content -->
					<div class="main">

						<div class="inner-wrapper scroll-fix">
							<?php
							if ( have_posts() ) :
								while ( have_posts() ) :
									the_post();
									?>
									<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

										<?php
										$content = get_the_content();
										if ( ! empty( $content ) ) {
											?>
											<div class="rh_content__compare">
												<?php the_content(); ?>
											</div>
											<?php
										}

										if ( ! empty( $compare_list_items ) ) :
											?>
											<div class=" compare-template">

												<div class="span2 compare-feature-column">

													<div class="property-thumbnail"></div>
													<div class="wrapper-cells">

														<p><?php esc_html_e( 'City', 'inspiry' ); ?></p>

														<p><?php esc_html_e( 'Area', 'inspiry' ); ?></p>

														<p><?php esc_html_e( 'Size', 'inspiry' ); ?></p>

														<p><?php esc_html_e( 'Bedrooms', 'inspiry' ); ?></p>

														<p><?php esc_html_e( 'Bathrooms', 'inspiry' ); ?></p>

														<?php
														$compare_features = get_terms( array(
															'taxonomy'   => 'property-feature',
															'hide_empty' => false,
														) );

														if ( ! empty( $compare_features ) ) {
															foreach ( $compare_features as $compare_feature ) : ?>
																<p><?php echo esc_html( $compare_feature->name ); ?></p>
																<?php
															endforeach;
														}
														?>
													</div>
												</div>
												<!-- /.span2 -->

												<?php if ( ! empty( $compare_properties ) ) : ?>

													<?php foreach ( $compare_properties as $compare_property ) : ?>

														<div class="span2 compare-properties-column">

															<div class="property-thumbnail">

																<?php if ( ! empty( $compare_property['img'] ) ) : ?>
																	<a class="compare-remove"
																	   data-property-id="<?php echo esc_attr( $compare_property['ID'] ); ?>"
																	   href="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>"><i
																			class="fas fa-times"></i></a>
																	<a href="<?php echo esc_attr( $compare_property['permalink'] ); ?>">
																		<img
																			src="<?php echo esc_attr( $compare_property['img'][0] ); ?>"
																			width="<?php echo esc_attr( $compare_property['img'][1] ); ?>"
																			height="<?php echo esc_attr( $compare_property['img'][2] ); ?>"
																		>
																	</a>
																<?php endif; ?>
																<!-- Property Thumbnail -->

																<h5 class="property-title">
																	<a href="<?php echo esc_attr( $compare_property['permalink'] ); ?>">
																		<?php echo esc_html( $compare_property['title'] ); ?>
																	</a>
																</h5>
																<!-- Property Title -->
																<?php
																$grid_property       = new Inspiry_Property( $compare_property['ID'] );
																$comp_property_price = $grid_property->get_price();
																?>

																<p class="property-price">
																	<?php
																	if ( ! empty( $comp_property_price ) ) {
																		echo esc_html( $comp_property_price );
																	}
																	?>
																</p>
																<!-- Property Price -->

																<p class="property-type">
																	<?php
																	$compare_property_types = strip_tags( get_the_term_list(
																		$compare_property['ID'], 'property-type', '', ',', ''
																	) );
																	if ( ! empty( $compare_property_types ) ) {
																		echo esc_html( $compare_property_types );
																	} else {
																		echo '<i class="fas fa-times"></i>';
																	}
																	?>
																</p>
																<!-- Property Type -->

															</div>
															<!-- /.property-thumbnail -->
															<div class="wrapper-cells">
																<p>
																	<?php
																	$compare_property_cities = wp_get_object_terms(
																		$compare_property['ID'], 'property-city'
																	);
																	if ( empty( $compare_property_cities ) ) {
																		echo '<i class="fas fa-times"></i>';
																	} else {
																		$compare_property_cities = array_reverse(
																			$compare_property_cities
																		);
																		foreach ( $compare_property_cities as $compare_property_city ) {
																			// Check if the location is city or not.
																			if ( 0 == $compare_property_city->parent ) {
																				$city = $compare_property_city->name;
																				echo esc_html( $city );
																			}
																		}
																	}
																	?>
																</p>
																<!-- Property City -->

																<p>
																	<?php
																	$compare_property_locations = wp_get_object_terms(
																		$compare_property['ID'], 'property-city'
																	);

																	if ( $compare_property_locations && ! is_wp_error( $compare_property_locations ) ) {
																		// To get the city of property, reverse the array.
																		$compare_property_locations = array_reverse(
																			$compare_property_locations
																		);
																		// Areas are equal to total terms minus the city term.
																		$area_count            = count( $compare_property_locations ) - 1;
																		$loop_count            = 1;
																		$compare_locations_str = '';

																		foreach ( $compare_property_locations as $compare_property_location ) {
																			// Check to see if the location is not a city.
																			if ( 0 < $compare_property_location->parent ) {
																				$area = get_term_by(
																					'id', $compare_property_location->term_id, 'property-city'
																				);
																				$compare_locations_str .= $area->name;
																				if ( $loop_count < $area_count && $area_count > 1 ) {
																					$compare_locations_str .= ', ';
																				}
																				$loop_count ++;
																			}
																		}

																		if ( $compare_locations_str ) {
																			echo esc_html( $compare_locations_str );
																		} else {
																			echo '<i class="fas fa-times"></i>';
																		}
																	} else {
																		echo '<i class="fas fa-times"></i>';
																	}
																	?>
																</p>
																<!-- Property Area -->

																<p>
																	<?php
																	$post_meta_data = get_post_custom( $compare_property['ID'] );
																	if ( ! empty( $post_meta_data['REAL_HOMES_property_size'][0] ) ) {
																		$prop_size = $post_meta_data['REAL_HOMES_property_size'][0];
																		if ( ! empty( $post_meta_data['REAL_HOMES_property_size_postfix'][0] ) ) {
																			$prop_size_postfix = $post_meta_data['REAL_HOMES_property_size_postfix'][0];
																			echo esc_html( $prop_size . ' ' . $prop_size_postfix );
																		}
																	} else {
																		echo '<i class="fas fa-times"></i>';
																	}
																	?>
																</p>
																<!-- Property Size -->

																<p>
																	<?php
																	if ( ! empty( $post_meta_data['REAL_HOMES_property_bedrooms'][0] ) ) {
																		$prop_bedrooms = floatval( $post_meta_data['REAL_HOMES_property_bedrooms'][0] );
																		echo esc_html( $prop_bedrooms );
																	} else {
																		echo '<i class="fas fa-times"></i>';
																	}
																	?>
																</p>
																<!-- Bedrooms -->

																<p>
																	<?php
																	if ( ! empty( $post_meta_data['REAL_HOMES_property_bathrooms'][0] ) ) {
																		$prop_bathrooms = floatval( $post_meta_data['REAL_HOMES_property_bathrooms'][0] );
																		echo esc_html( $prop_bathrooms );
																	} else {
																		echo '<i class="fas fa-times"></i>';
																	}
																	?>
																</p>
																<!-- Bathrooms -->

																<?php
																$property_feature_terms = get_the_terms(
																	$compare_property['ID'], 'property-feature'
																);

																$property_features = array();
																if ( is_array( $property_feature_terms ) && ! is_wp_error( $property_feature_terms ) ) {
																	foreach ( $property_feature_terms as $property_feature_term ) {
																		$property_features[] = $property_feature_term->name;
																	}
																}

																$feature_names           = array();
																$property_feature_values = get_terms( array(
																	'taxonomy'   => 'property-feature',
																	'hide_empty' => false,
																) );
																if ( ! empty( $property_feature_values ) ) {
																	foreach ( $property_feature_values as $property_feature_value ) {
																		$feature_names[] = $property_feature_value->name;
																	}
																}

																$features_count = count( $feature_names );

																for ( $index = 0; $index < $features_count; $index ++ ) {

																	if ( isset( $property_features[ $index ] ) && isset( $feature_names[ $index ] ) ) {

																		if ( $property_features[ $index ] == $feature_names [ $index ] ) {

																			echo '<p><i class="fas fa-check"></i></p>';

																		} else {

																			/**
																			 * If feature doesn't match then add a 0 at that
																			 * index of property_features array.
																			 */
																			array_splice( $property_features, $index, 0, array( 0 ) );
																			echo '<p><i class="fas fa-times"></i></p>';

																		}
																	} else {
																		echo '<p><i class="fas fa-times"></i></p>';
																	}
																}
																?>
															</div>
														</div>



													<?php endforeach; ?>

												<?php endif; ?>

											</div>

										<?php else : ?>

											<p class="nothing-found"><?php esc_html_e( 'No Properties Found to compare!', 'inspiry' ); ?></p>

										<?php endif; ?>
									</article>
									<?php
								endwhile;
							endif;
							?>
						</div>

					</div><!-- End Main Content -->

				</div> <!-- End span9 -->

			</div><!-- End contents row -->

		</div><!-- End Content -->
		<div class="container compare-empty-message hide">
			<p class="nothing-found"><?php esc_html_e( 'No Properties Found to compare!', 'inspiry' ); ?></p>
		</div>


	</div>


<?php get_footer(); ?>