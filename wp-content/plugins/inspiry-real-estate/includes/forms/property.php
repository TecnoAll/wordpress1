<?php
/**
 * Process property meta data.
 *
 * @param int $property_id
 * @param string $input
 * @param string $property_meta
 */
function ire_process_property_meta($property_id, $input, $property_meta) {
	if ( isset( $input ) && ! empty( $input ) ) {
		update_post_meta( $property_id, $property_meta, $input );
	} else {
		delete_post_meta( $property_id, $property_meta );
	}
}


/**
 * Return filtered title for Property Edit page.
 *
 * @param array $title
 * @return string $title
 */
function ire_filter_submit_edit_title( $title ) {
	$title['title'] = ( isset( $_GET['edit_property'] ) && !empty( $_GET['edit_property'] ) ) ? esc_html__( 'Edit Property', 'inspiry-real-estate' ) : $title['title'];
	return $title;
}
add_filter( 'document_title_parts', 'ire_filter_submit_edit_title', 10, 2 );


/**
 * @param $inspiry_options
 * @param $submitted_successfully
 * @param $updated_successfully
 * @param $invalid_nonce
 */
function ire_property_submit_edit_handler( &$inspiry_options, &$submitted_successfully, &$updated_successfully, &$invalid_nonce ) {
	// Check if action field is set and user is logged in
	if ( isset( $_POST[ 'action' ] ) && is_user_logged_in() ) {

		/* the nonce */
		if ( wp_verify_nonce( $_POST[ 'property_nonce' ], 'submit_property' ) ) {

			// Start with basic array
			$new_property = array(
				'post_type' => 'property'
			);

			// Title
			if ( isset ( $_POST[ 'inspiry_property_title' ] ) && ! empty ( $_POST[ 'inspiry_property_title' ] ) ) {
				$new_property[ 'post_title' ] = sanitize_text_field( $_POST[ 'inspiry_property_title' ] );
			}

			// Description
			if ( isset ( $_POST[ 'description' ] ) && ! empty ( $_POST[ 'description' ] ) ) {

				/*
				 * Allow iframe to pass so that people can embed things like virtual tour
				 */
				$allowed_tags             = wp_kses_allowed_html( 'post' );
				$allowed_tags[ 'iframe' ] = array(
					'src'             => array(),
					'height'          => array(),
					'width'           => array(),
					'frameborder'     => array(),
					'allowfullscreen' => array(),
				);

				$new_property[ 'post_content' ] = wp_kses( $_POST[ 'description' ], $allowed_tags );
			} else {
				$new_property[ 'post_content' ] = '';
			}

			// Parent Property ID
			if ( isset( $_POST[ 'property_parent_id' ] ) && ! empty( $_POST[ 'property_parent_id' ] ) ) {
				$new_property[ 'post_parent' ] = $_POST[ 'property_parent_id' ];
			} else {
				$new_property[ 'post_parent' ] = 0;
			}

			// Author
			$current_user                  = wp_get_current_user();
			$new_property[ 'post_author' ] = $current_user->ID;


			/* check the type of action */
			$action      = $_POST[ 'action' ];
			$property_id = 0;

			if ( $action == "add_property" ) {

				$default_submit_status = $inspiry_options[ 'inspiry_default_submit_status' ];
				if ( ! empty( $default_submit_status ) ) {
					$new_property[ 'post_status' ] = $default_submit_status;
				} else {
					$new_property[ 'post_status' ] = 'pending';
				}
				$property_id = wp_insert_post( $new_property ); // Insert Property and get Property ID
				if ( $property_id > 0 ) {
					$submitted_successfully = true;
				}
			} elseif ( $action == "update_property" ) {
				$new_property[ 'ID' ] = intval( $_POST[ 'property_id' ] );
				$property_id          = wp_update_post( $new_property ); // Update Property and get Property ID
				if ( $property_id > 0 ) {
					$updated_successfully = true;
				}
			}

			/*
			 * Added / Updates ( In any case there should be a valid property id )
			 */
			if ( $property_id > 0 ) {

				// Attach Property Type with Newly Created Property
				if ( isset( $_POST[ 'type' ] ) && ( $_POST[ 'type' ] != "-1" ) ) {
					wp_set_object_terms( $property_id, intval( $_POST[ 'type' ] ), 'property-type' );
				}

				// Attach Property City with Newly Created Property
				if ( isset( $_POST[ 'city' ] ) && ( $_POST[ 'city' ] != "-1" ) ) {
					wp_set_object_terms( $property_id, intval( $_POST[ 'city' ] ), 'property-city' );
				}

				// Attach Property Status with Newly Created Property
				if ( isset( $_POST[ 'status' ] ) && ( $_POST[ 'status' ] != "-1" ) ) {
					wp_set_object_terms( $property_id, intval( $_POST[ 'status' ] ), 'property-status' );
				}

				// Attach Property Features with Newly Created Property
				if ( isset( $_POST[ 'features' ] ) ) {
					if ( ! empty( $_POST[ 'features' ] ) && is_array( $_POST[ 'features' ] ) ) {
						$property_features = array();
						foreach ( $_POST[ 'features' ] as $property_feature_id ) {
							$property_features[] = intval( $property_feature_id );
						}
						wp_set_object_terms( $property_id, $property_features, 'property-feature' );
					}
				}

				// Attach Price Post Meta
				$price = sanitize_text_field( $_POST[ 'price' ] );
				ire_process_property_meta( $property_id, $price, 'REAL_HOMES_property_price' );

				// Attach Price Postfix Post Meta
				$price_postfix = sanitize_text_field( $_POST[ 'price-postfix' ] );
				ire_process_property_meta( $property_id, $price_postfix, 'REAL_HOMES_property_price_postfix' );

				// Attach Area Post Meta
				$size = sanitize_text_field( $_POST[ 'size' ] );
				ire_process_property_meta( $property_id, $size, 'REAL_HOMES_property_size' );

				// Attach Area Postfix Post Meta
				$area_postfix = sanitize_text_field( $_POST[ 'area-postfix' ] );
				ire_process_property_meta( $property_id, $area_postfix, 'REAL_HOMES_property_size_postfix' );

				// Attach Bedrooms Post Meta
				$bedrooms = sanitize_text_field( $_POST[ 'bedrooms' ] );
				ire_process_property_meta( $property_id, $bedrooms, 'REAL_HOMES_property_bedrooms' );

				// Attach Bathrooms Post Meta
				$bathrooms = sanitize_text_field( $_POST[ 'bathrooms' ] );
				ire_process_property_meta( $property_id, $bathrooms, 'REAL_HOMES_property_bathrooms' );

				// Attach Garages Post Meta
				$garages = sanitize_text_field( $_POST[ 'garages' ] );
				ire_process_property_meta( $property_id, $garages, 'REAL_HOMES_property_garage' );

				// Attach Address Post Meta
				$address = sanitize_text_field( $_POST[ 'address' ] );
				ire_process_property_meta( $property_id, $address, 'REAL_HOMES_property_address' );

				// Attach Location Post Meta
				$location = $_POST[ 'location' ];
				ire_process_property_meta( $property_id, $location, 'REAL_HOMES_property_location' );

				// Agent Display Option
				if ( isset ( $_POST[ 'agent_display_option' ] ) && ! empty ( $_POST[ 'agent_display_option' ] ) ) {
					update_post_meta( $property_id, 'REAL_HOMES_agent_display_option', $_POST[ 'agent_display_option' ] );
					if ( ( $_POST[ 'agent_display_option' ] == "agent_info" ) && isset( $_POST[ 'agent_id' ] ) ) {
						delete_post_meta( $property_id, 'REAL_HOMES_agents' );
						foreach ( $_POST[ 'agent_id' ] as $agent_id ) {
							add_post_meta( $property_id, 'REAL_HOMES_agents', $agent_id );
						}
					} else if ( $_POST[ 'agent_display_option' ] == "agent_info" ) {
						delete_post_meta( $property_id, 'REAL_HOMES_agents' );
					}
				}

				// Attach Property ID Post Meta
				if ( isset ( $_POST[ 'property-id' ] ) && ! empty ( $_POST[ 'property-id' ] ) ) {
					update_post_meta( $property_id, 'REAL_HOMES_property_id', sanitize_text_field( $_POST[ 'property-id' ] ) );
				} else {
					$auto_property_id    = $inspiry_options[ 'inspiry_auto_generate_property_id' ];
					$property_id_pattern = $inspiry_options[ 'inspiry_auto_generate_id_pattern' ];
					if ( $auto_property_id == '1' && ! empty( $property_id_pattern ) ) {
						$property_id_value = preg_replace( '/{ID}/', $property_id, $property_id_pattern );
						update_post_meta( $property_id, 'REAL_HOMES_property_id', sanitize_text_field( $property_id_value ) );
					}
				}

				// Attach Virtual Tour Video URL Post Meta
				$video_url = esc_url_raw( $_POST[ 'video-url' ] );
				ire_process_property_meta( $property_id, $video_url, 'REAL_HOMES_tour_video_url' );

				// Year Built
				$year_built = sanitize_text_field( $_POST[ 'year-built' ] );
				ire_process_property_meta( $property_id, $year_built, 'REAL_HOMES_property_year_built' );

				// Attach Virtual Tour Embed Code
				$allow_iframe_in_kses = array(
					'iframe' => array(
						'style'           => array(),
						'src'             => array(),
						'width'           => array(),
						'height'          => array(),
						'allowvr'         => array(),
						'allowfullscreen' => array(),
						'gesture'         => array(),
						'frameborder'     => array(),
					)
				);

				if ( isset ( $_POST[ 'vt-embed' ] ) && ! empty ( $_POST[ 'vt-embed' ] ) ) {
					update_post_meta( $property_id, 'REAL_HOMES_360_virtual_tour', wp_kses( $_POST[ 'vt-embed' ], $allow_iframe_in_kses ) );
				}

				// Attach additional details with property
				if ( isset( $_POST[ 'detail-titles' ] ) && isset( $_POST[ 'detail-values' ] ) ) {

					$additional_details_titles = $_POST[ 'detail-titles' ];
					$additional_details_values = $_POST[ 'detail-values' ];

					$titles_count = count( $additional_details_titles );
					$values_count = count( $additional_details_values );

					// to skip empty values on submission
					if ( $titles_count == 1 && $values_count == 1 && empty ( $additional_details_titles[ 0 ] ) && empty ( $additional_details_values[ 0 ] ) ) {
						// do nothing and let it go
					} else {

						if ( ! empty( $additional_details_titles ) && ! empty( $additional_details_values ) ) {
							$additional_details = array_combine( $additional_details_titles, $additional_details_values );
							update_post_meta( $property_id, 'REAL_HOMES_additional_details', $additional_details );
						}

					}
				} else {
                    delete_post_meta( $property_id, 'REAL_HOMES_additional_details' );
                }

				// Attach Property as Featured Post Meta
				$featured = ( isset( $_POST[ 'featured' ] ) ) ? 1 : 0;
				ire_process_property_meta( $property_id, $featured, 'REAL_HOMES_featured' );

				// Tour video image - in case of update
				$tour_video_image    = "";
				$tour_video_image_id = 0;
				if ( $action == "update_property" ) {
					$tour_video_image_id = get_post_meta( $property_id, 'REAL_HOMES_tour_video_image', true );
					if ( ! empty ( $tour_video_image_id ) ) {
						$tour_video_image_src = wp_get_attachment_image_src( $tour_video_image_id, 'property-detail-video-image' );
						$tour_video_image     = $tour_video_image_src[ 0 ];
					}
				}

				// if property is being updated, clean up the old meta information related to images
				if ( $action == "update_property" ) {
					delete_post_meta( $property_id, 'REAL_HOMES_property_images' );
					delete_post_meta( $property_id, '_thumbnail_id' );
				}

				// Attach gallery images with newly created property
				if ( isset( $_POST[ 'gallery_image_ids' ] ) ) {
					if ( ! empty ( $_POST[ 'gallery_image_ids' ] ) && is_array( $_POST[ 'gallery_image_ids' ] ) ) {
						$gallery_image_ids = array();
						foreach ( $_POST[ 'gallery_image_ids' ] as $gallery_image_id ) {
							$gallery_image_ids[] = intval( $gallery_image_id );
							add_post_meta( $property_id, 'REAL_HOMES_property_images', $gallery_image_id );
						}
						if ( isset( $_POST[ 'featured_image_id' ] ) ) {
							$featured_image_id = intval( $_POST[ 'featured_image_id' ] );
							if ( in_array( $featured_image_id, $gallery_image_ids ) ) {     // validate featured image id
								update_post_meta( $property_id, '_thumbnail_id', $featured_image_id );

								/* if video url is provided but there is no video image then use featured image as video image */
								if ( empty( $tour_video_image ) && ! empty( $_POST[ 'video-url' ] ) ) {
									update_post_meta( $property_id, 'REAL_HOMES_tour_video_image', $featured_image_id );
								}
							}
						} elseif ( ! empty ( $gallery_image_ids ) ) {
							update_post_meta( $property_id, '_thumbnail_id', $gallery_image_ids[ 0 ] );
						}
					}
				}


				if ( "add_property" == $_POST[ 'action' ] ) {

					/*
					 * ire_submit_notice function is hooked here
					 */
					do_action( 'inspiry_after_property_submit', $property_id );

				} elseif ( "update_property" == $_POST[ 'action' ] ) {

					/*
					 * no default theme function is hooked here for now
					 */
					do_action( 'inspiry_after_property_update', $property_id );

				}

				// redirect to my properties page
				if ( ! empty( $inspiry_options[ 'inspiry_my_properties_page' ] ) ) {
					$my_properties_url = get_permalink( $inspiry_options[ 'inspiry_my_properties_page' ] );
					if ( ! empty( $my_properties_url ) ) {
						$separator = ( parse_url( $my_properties_url, PHP_URL_QUERY ) == null ) ? '?' : '&';
						$parameter = ( $updated_successfully ) ? 'property-updated=true' : 'property-added=true';
						wp_redirect( $my_properties_url . $separator . $parameter );
					}
				}

			}

		} else {
			$invalid_nonce = true;
		}
	}
}


/**
 * Generates property submit form
 *
 * @param $inspiry_options
 */
function ire_property_submit_form( $inspiry_options ) {

	?>
	<form id="submit-property-form" class="submit-form" enctype="multipart/form-data" method="post">

		<div class="row">
			<div class="col-md-6">
				<div class="form-option">
					<label for="inspiry_property_title"><?php esc_html_e( 'Property Title', 'inspiry-real-estate' ); ?></label>
					<input id="inspiry_property_title" name="inspiry_property_title" type="text" class="required" title="<?php esc_html_e( '* Please provide property title!', 'inspiry-real-estate' ); ?>" autofocus required/>
				</div>
				<?php
				if ( ire_is_displayable( 'inspiry_property_desc_field' ) ) {
					?>
					<div class="form-option">
						<label for="description"><?php esc_html_e( 'Property Description', 'inspiry-real-estate' ); ?></label>
						<textarea name="description" id="description" cols="30" rows="5"></textarea>
					</div>
					<?php
				}
				?>
			</div>

			<?php
			if ( ire_is_displayable( 'inspiry_property_address_field' ) ) {
				 $inspiry_map_option = get_option( 'inspiry_map_option' );
				$cordinates          = isset( $inspiry_map_option['property_submit_default_location'] ) ? $inspiry_map_option['property_submit_default_location'] : '25.7308309,-80.44414899999998';
				$default_address     = isset( $inspiry_map_option['property_submit_default_address'] ) ? $inspiry_map_option['property_submit_default_address'] : '15421 Southwest 39th Terrace, Miami, FL 33185, USA';
				?>
				<div class="col-md-6">
					<div class="form-option">
					<div class="address-map-fields-wrapper">
						<div id="map-address-field-wrapper" class="address-wrapper">
						<label for="address"><?php esc_html_e( 'Address', 'inspiry-real-estate' ); ?></label>
						<input type="text" class="required" name="address" id="address" value="<?php echo esc_attr( $default_address ); ?>" title="<?php esc_html_e( '* Please provide a property address!', 'inspiry-real-estate' ); ?>" required/>
						</div>
						<div class="map-wrapper">
							<button class="btn-default goto-address-button" type="button" value="address"><?php esc_html_e( 'Find Address', 'inspiry-real-estate' ); ?></button>
							<div class="map-canvas"></div>
							<input type="hidden" name="location" class="map-coordinate" value="<?php echo esc_attr( $cordinates ); ?>"/>
						</div>
					</div>
					</div>
				</div>
				<?php
			}
			?>

		</div>
		<div class="row">
			<?php
			if ( ire_is_displayable( 'inspiry_property_type_field' ) ) {
				?>
				<div class="col-md-4">
					<div class="form-option">
						<label for="type"><?php esc_html_e( 'Type', 'inspiry-real-estate' ); ?></label>
						<select name="type" id="type" class="search-select">
							<option selected="selected" value="-1"><?php esc_html_e( 'None', 'inspiry-real-estate' ); ?></option>
							<?php
							// Property type terms
							$type_terms = get_terms( 'property-type', array(
									'orderby'    => 'name',
									'order'      => 'ASC',
									'hide_empty' => false,
									'parent'     => 0,
								)
							);
							ire_hierarchical_id_options( 'property-type', $type_terms, - 1 );
							?>
						</select>
					</div>
				</div>
				<?php
			}

			if ( ire_is_displayable( 'inspiry_property_location_field' ) ) {
				?>
				<div class="col-md-4">
					<div class="form-option">
						<label for="city"><?php esc_html_e( 'Location', 'inspiry-real-estate' ); ?></label>
						<select name="city" id="city" class="search-select">
							<option selected="selected" value="-1"><?php esc_html_e( 'None', 'inspiry-real-estate' ); ?></option>
							<?php
							// Property location terms
							$location_terms = get_terms( 'property-city', array(
									'orderby'    => 'name',
									'order'      => 'ASC',
									'hide_empty' => false,
									'parent'     => 0,
								)
							);
							ire_hierarchical_id_options( 'property-city', $location_terms, - 1 );
							?>
						</select>
					</div>
				</div>
				<?php
			}

			if ( ire_is_displayable( 'inspiry_property_status_field' ) ) {
				?>
				<div class="col-md-4">
					<div class="form-option">
						<label for="status"><?php esc_html_e( 'Status', 'inspiry-real-estate' ); ?></label>
						<select name="status" id="status" class="search-select">
							<option selected="selected" value="-1"><?php esc_html_e( 'None', 'inspiry-real-estate' ); ?></option>
							<?php
							// Property status terms
							$status_terms = get_terms( 'property-status', array(
									'orderby'    => 'name',
									'order'      => 'ASC',
									'hide_empty' => false,
									'parent'     => 0,
								)
							);
							ire_hierarchical_id_options( 'property-status', $status_terms, - 1 );
							?>
						</select>
					</div>
				</div>
				<?php
			}

			if ( ire_is_displayable( 'inspiry_property_bedrooms_field' ) ) {
				?>
				<div class="col-md-4">
					<div class="form-option">
						<label for="bedrooms"><?php esc_html_e( 'Bedrooms', 'inspiry-real-estate' ); ?></label>
						<input id="bedrooms" name="bedrooms" type="text" title="<?php esc_html_e( '* Only numbers allowed!', 'inspiry-real-estate' ); ?>"/>
					</div>
				</div>
				<?php
			}

			if ( ire_is_displayable( 'inspiry_property_bathrooms_field' ) ) {
				?>
				<div class="col-md-4">
					<div class="form-option">
						<label for="bathrooms"><?php esc_html_e( 'Bathrooms', 'inspiry-real-estate' ); ?></label>
						<input id="bathrooms" name="bathrooms" type="text" title="<?php esc_html_e( '* Only numbers allowed!', 'inspiry-real-estate' ); ?>"/>
					</div>
				</div>
				<?php
			}

			if ( ire_is_displayable( 'inspiry_property_garages_field' ) ) {
				?>
				<div class="col-md-4">
					<div class="form-option">
						<label for="garages"><?php esc_html_e( 'Garages', 'inspiry-real-estate' ); ?></label>
						<input id="garages" name="garages" type="text" title="<?php esc_html_e( '* Only numbers allowed!', 'inspiry-real-estate' ); ?>"/>
					</div>
				</div>
				<?php
			}

			if ( ire_is_displayable( 'inspiry_property_sale_or_rent_field' ) ) {
				?>
				<div class="col-md-4">
					<div class="form-option">
						<label for="price"><?php esc_html_e( 'Sale OR Rent Price', 'inspiry-real-estate' ); ?></label>
						<input id="price" name="price" type="text" title="<?php esc_html_e( '* Only numbers allowed!', 'inspiry-real-estate' ); ?>"/>
					</div>
				</div>

				<?php
			}

			if ( ire_is_displayable( 'inspiry_property_price_postfix_field' ) ) {
				?>
				<div class="col-md-4">
					<div class="form-option">
						<label for="price-postfix"><?php esc_html_e( 'Price Postfix Text', 'inspiry-real-estate' ); ?></label>
						<input id="price-postfix" name="price-postfix" type="text"/>
					</div>
				</div>
				<?php
			}

			if ( ire_is_displayable( 'inspiry_property_area_field' ) ) {
				?>
				<div class="col-md-4">
					<div class="form-option">
						<label for="size"><?php esc_html_e( 'Area', 'inspiry-real-estate' ); ?></label>
						<input id="size" name="size" type="text" title="<?php esc_html_e( '* Only numbers allowed!', 'inspiry-real-estate' ); ?>"/>
					</div>
				</div>
				<?php
			}

			if ( ire_is_displayable( 'inspiry_property_post_prefix_field' ) ) {
				?>
				<div class="col-md-4">
					<div class="form-option">
						<label for="area-postfix"><?php esc_html_e( 'Area Postfix Text', 'inspiry-real-estate' ); ?></label>
						<input id="area-postfix" name="area-postfix" type="text" value="<?php esc_html_e( 'SqFt', 'inspiry-real-estate' ); ?>"/>
					</div>
				</div>
				<?php
			}

			if ( ire_is_displayable( 'inspiry_property_id_field' ) ) {
				?>
				<div class="col-md-4">
					<div class="form-option">
						<label for="property-id"><?php esc_html_e( 'Property ID', 'inspiry-real-estate' ); ?></label>
						<?php
						if ( isset( $inspiry_options[ 'inspiry_auto_generate_property_id' ] ) && ( 1 == $inspiry_options[ 'inspiry_auto_generate_property_id' ] ) ) {
							?>
							<input disabled="disabled" value="<?php echo esc_attr( $inspiry_options[ 'inspiry_auto_generate_id_pattern' ] ); ?>" id="property-id" name="property-id" type="text" title="<?php esc_attr_e( 'Property ID Pattern', 'inspiry-real-estate' ); ?>"/>
							<?php
						} else {
							?>
							<input id="property-id" name="property-id" type="text" title="<?php esc_attr_e( 'Property ID', 'inspiry-real-estate' ); ?>"/>
							<?php
						}
						?>
					</div>
				</div>
				<?php
			}

			if ( ire_is_displayable( 'inspiry_property_virtual_tour_url_field' ) ) {
				?>
				<div class="col-md-4">
					<div class="form-option">
						<label for="video-url"><?php esc_html_e( 'Property Video URL', 'inspiry-real-estate' ); ?></label>
						<input id="video-url" name="video-url" type="text"/>
					</div>
				</div>
				<?php
			}

			if ( ire_is_displayable( 'inspiry_property_year_built_field' ) ) {
				?>
				<div class="col-md-4">
					<div class="form-option">
						<label for="year-built"><?php esc_html_e( 'Year Built', 'inspiry-real-estate' ); ?></label>
						<input id="year-built" name="year-built" type="text"/>
					</div>
				</div>
				<?php
			}

			if ( ire_is_displayable( 'inspiry_property_parent_field' ) ) {
				$property_object = get_post_type_object( 'property' );
				if ( $property_object->hierarchical ) {
					$parent_prop_args = array(
						'post_type'        => 'property',
						'name'             => 'property_parent_id',
						'show_option_none' => esc_html__( 'None', 'inspiry-real-estate' ),
						'sort_column'      => 'menu_order, post_title',
						'number'           => 100,
						'echo'             => 1,
					);
					?>
					<div class="col-md-4">
						<div class="form-option">
							<label for="property_parent_id"><?php esc_html_e( 'Parent Property', 'inspiry-real-estate' ); ?></label>
							<?php wp_dropdown_pages( $parent_prop_args ) ?>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>

		<?php
		if ( ire_is_displayable( 'inspiry_property_virtual_tour_url_360_field' ) ) {
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="form-option">
						<label for="vt-embed"><?php esc_html_e( 'Virtual Tour Embed Code', 'inspiry-real-estate' ); ?></label>
						<textarea class="vt-embed-code" id="vt-embed" name="vt-embed" cols="30" rows="5"></textarea>
					</div>
				</div>
			</div>
			<?php
		}
		?>

		<div class="row container-row">
			<?php
			if ( ire_is_displayable( 'inspiry_property_drag_image_box_field' ) ) {
				?>
				<div class="col-lg-6">
					<div class="form-option">
						<div id="gallery-thumbs-container" class="clearfix"></div>
						<div id="drag-and-drop">
							<div class="drag-drop-msg text-center">
								<i class="fas fa-cloud-upload-alt"></i>&nbsp;&nbsp;<?php esc_html_e( 'Drag and drop images here', 'inspiry-real-estate' ); ?>
								<br/>
								<span class="drag-or"><?php esc_html_e( 'OR', 'inspiry-real-estate' ); ?></span>
								<br/>
								<a id="select-images" class="drag-btn btn-default btn-orange" href="javascript:;"><?php esc_html_e( 'Select Images', 'inspiry-real-estate' ); ?></a>
							</div>
						</div>
						<ul class="field-description list-unstyled">
							<li><span>*</span><?php esc_html_e( 'An image should have minimum width of 850px and minimum height of 600px.', 'inspiry-real-estate' ); ?></li>
							<li><span>*</span><?php esc_html_e( 'You can mark an image as featured by clicking the star icon, Otherwise first image will be considered featured image.', 'inspiry-real-estate' ); ?></li>
						</ul>
						<div id="plupload-container"></div>
						<div id="errors-log"></div>
					</div>
				</div>
				<?php
			}
			?>

			<div class="col-lg-6">
				<?php
				if ( ire_is_displayable( 'inspiry_property_agent_information_option_field' ) ) {
					?>
					<div class="form-option">
						<label class="fancy-title"><?php esc_html_e( 'What to display in agent information box ?', 'inspiry-real-estate' ); ?></label>
						<ul class="agent-options list-unstyled">
							<li>
								<span class="radio-field">
									<input id="agent_option_none" type="radio" name="agent_display_option" value="none" checked/>
									<label for="agent_option_none"><?php esc_html_e( 'None', 'inspiry-real-estate' ); ?></label>
								</span>
								<small><?php esc_html_e( '( No information will be displayed )', 'inspiry-real-estate' ); ?></small>
							</li>

							<li>
								<span class="radio-field">
									<input id="agent_option_profile" type="radio" name="agent_display_option" value="my_profile_info"/>
									<label for="agent_option_profile"><?php esc_html_e( 'My Profile Information', 'inspiry-real-estate' ); ?></label>
								</span>
								<?php
								if ( ! empty( $inspiry_options[ 'inspiry_edit_profile_page' ] ) ) {
									$edit_profile_url = get_permalink( $inspiry_options[ 'inspiry_edit_profile_page' ] );
									if ( ! empty( $edit_profile_url ) ) {
										?><small><a href="<?php echo esc_url( $edit_profile_url ); ?>" target="_blank"><?php esc_html_e( '( Edit Profile Information )', 'inspiry-real-estate' ); ?></a></small><?php
									}
								}
								?>
							</li>

							<li>
								<span class="radio-field">
									<input id="agent_option_agent" type="radio" name="agent_display_option" value="agent_info"/>
									<label for="agent_option_agent"><?php esc_html_e( 'Display Agent Information', 'inspiry-real-estate' ); ?></label>
								</span>
								<select name="agent_id[]" id="agent-selectbox" multiple="multiple">
									<?php ire_generate_cpt_options( 'agent' ); ?>
								</select>
							</li>
						</ul>
					</div>
					<?php
				}

				if ( ire_is_displayable( 'inspiry_property_mark_as_feature_checkbox' ) ) {
					?>
					<div class="form-option checkbox-option clearfix">
						<input id="featured" name="featured" type="checkbox"/>
						<label for="featured"><?php esc_html_e( 'Mark this property as featured property', 'inspiry-real-estate' ); ?></label>
					</div>
					<?php
				}
				?>
			</div>

		</div>

		<div class="row container-row">
			<?php
			if ( ire_is_displayable( 'inspiry_property_features_field' ) ) {
				?>
				<div class="col-lg-6">
					<div class="form-option">
						<label class="fancy-title"><?php esc_html_e( 'Features', 'inspiry-real-estate' ); ?></label>
						<ul class="features-checkboxes-wrapper list-unstyled clearfix">
							<?php
							// Property features
							$features_terms = get_terms( 'property-feature', array(
									'orderby'    => 'name',
									'order'      => 'ASC',
									'hide_empty' => false,
								)
							);

							if ( ! empty( $features_terms ) && ! is_wp_error( $features_terms ) ) {
								foreach ( $features_terms as $feature ) {
									echo '<li><span class="option-set">';
									echo '<input type="checkbox" name="features[]" id="feature-' . $feature->term_id . '" value="' . $feature->term_id . '" />';
									echo '<label for="feature-' . $feature->term_id . '">' . $feature->name . '</label>';
									echo '</li>';
								}
							}
							?>
						</ul>
					</div>
				</div>
				<?php
			}

			if ( ire_is_displayable( 'inspiry_property_additional_details_field' ) ) {
				?>
				<div class="col-lg-6">
					<div class="form-option">
						<div class="inspiry-details-wrapper">

							<label><?php esc_html_e( 'Additional Details', 'inspiry-real-estate' ); ?></label>
							<div class="inspiry-detail labels clearfix">
								<div class="inspiry-detail-control">&nbsp;</div>
								<div class="inspiry-detail-title">
									<label><?php esc_html_e( 'Title', 'inspiry-real-estate' ) ?></label></div>
								<div class="inspiry-detail-value">
									<label><?php esc_html_e( 'Value', 'inspiry-real-estate' ); ?></label></div>
								<div class="inspiry-detail-control">&nbsp;</div>
							</div>

							<!-- additional details container -->
							<div id="inspiry-additional-details-container">
								<div class="inspiry-detail inputs clearfix">
									<div class="inspiry-detail-control">
										<i class="sort-detail fa fa-bars"></i>
									</div>
									<div class="inspiry-detail-title">
										<input type="text" name="detail-titles[]" value=""/>
									</div>
									<div class="inspiry-detail-value">
										<input type="text" name="detail-values[]" value=""/>
									</div>
									<div class="inspiry-detail-control">
										<a class="remove-detail" href="#"><i class="fa fa-times"></i></a>
									</div>
								</div>
							</div>

							<div class="inspiry-detail clearfix">
								<div class="inspiry-detail-control">&nbsp;</div>
								<div class="inspiry-detail-control">
									<a class="add-detail" href="#"><i class="fa fa-plus"></i></a>
								</div>
							</div>

						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>

		<div class="row container-row">
			<div class="col-xs-12">
				<?php
				$submit_notice_email  = is_email( $inspiry_options[ 'inspiry_submit_notice_email' ] );
				$message_for_reviewer = $inspiry_options[ 'inspiry_submit_message_to_reviewer' ];
				if ( ! empty( $submit_notice_email ) && $message_for_reviewer ) {
					?>
					<div class="form-option">
						<label for="message_to_reviewer"><?php esc_html_e( 'Message to the Reviewer', 'inspiry-real-estate' ); ?></label>
						<textarea name="message_to_reviewer" id="message_to_reviewer" cols="30" rows="3"></textarea>
					</div>
					<?php
				}
				?>
				<div class="form-option">
					<?php wp_nonce_field( 'submit_property', 'property_nonce' ); ?>
					<input type="hidden" name="action" value="add_property"/>
					<input type="submit" value="<?php esc_html_e( 'Submit Property', 'inspiry-real-estate' ); ?>" class="btn-small btn-orange"/>
				</div>
				<div id="message-container"></div>
			</div>
		</div>

	</form>
	<?php

}


/**
 * Generates property edit form.
 *
 * @param $inspiry_options
 */
function ire_property_edit_form( $inspiry_options ) {

	$edit_property_id = intval( trim( $_GET['edit_property'] ) );
	$target_property  = get_post( $edit_property_id );

	// check if passed id is a proper property post */
	if ( ! empty( $target_property ) && ( $target_property->post_type == 'property' ) ) {

		// Check Author
		$current_user = wp_get_current_user();

		// check if current user is the author of property
		if ( $target_property->post_author == $current_user->ID ) {

			$property_meta = get_post_custom( $target_property->ID );
			?>
			<form id="submit-property-form" class="submit-form" enctype="multipart/form-data" method="post">
				<div class="row">
					<div class="col-md-6">
						<div class="form-option">
							<label for="inspiry_property_title"><?php esc_html_e( 'Property Title', 'inspiry-real-estate' ); ?></label>
							<input id="inspiry_property_title" name="inspiry_property_title" type="text" class="required"
								   value="<?php echo esc_attr( $target_property->post_title ); ?>"
								   title="<?php esc_html_e( '* Please provide property title!', 'inspiry-real-estate' ); ?>" autofocus
								   required/>
						</div>

						<?php
						if ( ire_is_displayable( 'inspiry_property_desc_field' ) ) {
							?>
							<div class="form-option">
								<label for="description"><?php esc_html_e( 'Property Description', 'inspiry-real-estate' ); ?></label>
								<textarea name="description" id="description" cols="30"
										  rows="5"><?php echo esc_textarea( $target_property->post_content ); ?></textarea>
							</div>
							<?php
						}
						?>
					</div>

					<?php
					if ( ire_is_displayable( 'inspiry_property_address_field' ) ) {
						?>
						<div class="col-md-6">
							<div class="form-option">
								<?php
								$property_address = "";
								if ( isset( $property_meta[ 'REAL_HOMES_property_address' ] ) && ! empty ( $property_meta[ 'REAL_HOMES_property_address' ][ 0 ] ) ) {
									$property_address = $property_meta[ 'REAL_HOMES_property_address' ][ 0 ];
								} else {
									$property_address = $inspiry_options[ 'inspiry_submit_address' ];
								}

								$property_location = "";
								if ( isset( $property_meta[ 'REAL_HOMES_property_location' ] ) && ! empty ( $property_meta[ 'REAL_HOMES_property_location' ][ 0 ] ) ) {
									$property_location = $property_meta[ 'REAL_HOMES_property_location' ][ 0 ];
								} else {
									$property_location = $inspiry_options[ 'inspiry_submit_location_coordinates' ];
								}
								?>
								<label for="address"><?php esc_html_e( 'Address', 'inspiry-real-estate' ); ?></label>
								<input type="text" class="required" name="address" id="address"
									   value="<?php echo esc_attr( $property_address ); ?>"
									   title="<?php esc_html_e( '* Please provide a property address!', 'inspiry-real-estate' ); ?>" required/>
								<div class="map-wrapper">
									<button class="btn-default goto-address-button" type="button"
											value="address"><?php esc_html_e( 'Find Address', 'inspiry-real-estate' ); ?></button>
									<div class="map-canvas"></div>
									<input type="hidden" name="location" class="map-coordinate"
										   value="<?php echo esc_attr( $property_location ); ?>"/>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>

				<div class="row">
					<?php
					if ( ire_is_displayable( 'inspiry_property_type_field' ) ) {
						?>
						<div class="col-md-4">
							<div class="form-option">
								<label for="type"><?php esc_html_e( 'Type', 'inspiry-real-estate' ); ?></label>
								<select name="type" id="type" class="search-select">
									<?php ire_hierarchical_edit_options( $target_property->ID, 'property-type' ); ?>
								</select>
							</div>
						</div>
						<?php
					}

					if ( ire_is_displayable( 'inspiry_property_location_field' ) ) {
						?>
						<div class="col-md-4">
							<div class="form-option">
								<label for="city"><?php esc_html_e( 'Location', 'inspiry-real-estate' ); ?></label>
								<select name="city" id="city" class="search-select">
									<?php ire_hierarchical_edit_options( $target_property->ID, 'property-city' ); ?>
								</select>
							</div>
						</div>
						<?php
					}

					if ( ire_is_displayable( 'inspiry_property_status_field' ) ) {
						?>
						<div class="col-md-4">
							<div class="form-option">
								<label for="status"><?php esc_html_e( 'Status', 'inspiry-real-estate' ); ?></label>
								<select name="status" id="status" class="search-select">
									<?php ire_hierarchical_edit_options( $target_property->ID, 'property-status' ); ?>
								</select>
							</div>
						</div>
						<?php
					}

					if ( ire_is_displayable( 'inspiry_property_bedrooms_field' ) ) {
						?>
						<div class="col-md-4">
							<div class="form-option">
								<label for="bedrooms"><?php esc_html_e( 'Bedrooms', 'inspiry-real-estate' ); ?></label>
								<input id="bedrooms" name="bedrooms" type="text"
									   value="<?php if ( isset( $property_meta[ 'REAL_HOMES_property_bedrooms' ] ) ) {
									       echo esc_attr( $property_meta[ 'REAL_HOMES_property_bedrooms' ][ 0 ] );
								       } ?>" title="<?php esc_html_e( '* Only numbers allowed!', 'inspiry-real-estate' ); ?>"/>
							</div>
						</div>
						<?php
					}

					if ( ire_is_displayable( 'inspiry_property_bathrooms_field' ) ) {
						?>
						<div class="col-md-4">
							<div class="form-option">
								<label for="bathrooms"><?php esc_html_e( 'Bathrooms', 'inspiry-real-estate' ); ?></label>
								<input id="bathrooms" name="bathrooms" type="text"
									   value="<?php if ( isset( $property_meta[ 'REAL_HOMES_property_bathrooms' ] ) ) {
									       echo esc_attr( $property_meta[ 'REAL_HOMES_property_bathrooms' ][ 0 ] );
								       } ?>" title="<?php esc_html_e( '* Only numbers allowed!', 'inspiry-real-estate' ); ?>"/>
							</div>
						</div>
						<?php
					}

					if ( ire_is_displayable( 'inspiry_property_garages_field' ) ) {
						?>
						<div class="col-md-4">
							<div class="form-option">
								<label for="garages"><?php esc_html_e( 'Garages', 'inspiry-real-estate' ); ?></label>
								<input id="garages" name="garages" type="text"
									   value="<?php if ( isset( $property_meta[ 'REAL_HOMES_property_garage' ] ) ) {
									       echo esc_attr( $property_meta[ 'REAL_HOMES_property_garage' ][ 0 ] );
								       } ?>" title="<?php esc_html_e( '* Only numbers allowed!', 'inspiry-real-estate' ); ?>"/>
							</div>
						</div>

						<?php
					}

					if ( ire_is_displayable( 'inspiry_property_sale_or_rent_field' ) ) {
						?>
						<div class="col-md-4">
							<div class="form-option">
								<label for="price"><?php esc_html_e( 'Sale OR Rent Price', 'inspiry-real-estate' ); ?></label>
								<input id="price" name="price" type="text"
									   value="<?php if ( isset( $property_meta[ 'REAL_HOMES_property_price' ] ) ) {
									       echo esc_attr( $property_meta[ 'REAL_HOMES_property_price' ][ 0 ] );
								       } ?>" title="<?php esc_html_e( '* Only numbers allowed!', 'inspiry-real-estate' ); ?>"/>
							</div>
						</div>
						<?php
					}

					if ( ire_is_displayable( 'inspiry_property_price_postfix_field' ) ) {
						?>
						<div class="col-md-4">
							<div class="form-option">
								<label for="price-postfix"><?php esc_html_e( 'Price Postfix Text', 'inspiry-real-estate' ); ?></label>
								<input id="price-postfix" name="price-postfix" type="text"
									   value="<?php if ( isset( $property_meta[ 'REAL_HOMES_property_price_postfix' ] ) ) {
									       echo esc_attr( $property_meta[ 'REAL_HOMES_property_price_postfix' ][ 0 ] );
								       } ?>"/>
							</div>
						</div>
						<?php
					}

					if ( ire_is_displayable( 'inspiry_property_area_field' ) ) {
						?>
						<div class="col-md-4">
							<div class="form-option">
								<label for="size"><?php esc_html_e( 'Area', 'inspiry-real-estate' ); ?></label>
								<input id="size" name="size" type="text"
									   value="<?php if ( isset( $property_meta[ 'REAL_HOMES_property_size' ] ) ) {
									       echo esc_attr( $property_meta[ 'REAL_HOMES_property_size' ][ 0 ] );
								       } ?>" title="<?php esc_html_e( '* Only numbers allowed!', 'inspiry-real-estate' ); ?>"/>
							</div>
						</div>
						<?php
					}

					if ( ire_is_displayable( 'inspiry_property_post_prefix_field' ) ) {
						?>
						<div class="col-md-4">
							<div class="form-option">
								<label for="area-postfix"><?php esc_html_e( 'Area Postfix Text', 'inspiry-real-estate' ); ?></label>
								<input id="area-postfix" name="area-postfix" type="text"
									   value="<?php if ( isset( $property_meta[ 'REAL_HOMES_property_size_postfix' ] ) ) {
									       echo esc_attr( $property_meta[ 'REAL_HOMES_property_size_postfix' ][ 0 ] );
								       } ?>"/>
							</div>
						</div>
						<?php
					}

					if ( ire_is_displayable( 'inspiry_property_id_field' ) ) {
						?>
						<div class="col-md-4">
							<div class="form-option">
								<label for="property-id"><?php esc_html_e( 'Property ID', 'inspiry-real-estate' ); ?></label>
								<input id="property-id" name="property-id" type="text"
									   value="<?php if ( isset( $property_meta[ 'REAL_HOMES_property_id' ] ) ) {
									       echo esc_attr( $property_meta[ 'REAL_HOMES_property_id' ][ 0 ] );
								       } ?>" title="<?php esc_attr_e( 'Property ID', 'inspiry-real-estate' ); ?>"
									<?php
									if ( isset( $inspiry_options[ 'inspiry_auto_generate_property_id' ] ) && ( 1 == $inspiry_options[ 'inspiry_auto_generate_property_id' ] ) ) {
										echo 'disabled="disabled"';
									}
									?>
								/>
							</div>
						</div>
						<?php
					}

					if ( ire_is_displayable( 'inspiry_property_virtual_tour_url_field' ) ) {
						?>
						<div class="col-md-4">
							<div class="form-option">
								<label for="video-url"><?php esc_html_e( 'Property Video URL', 'inspiry-real-estate' ); ?></label>
								<input id="video-url" name="video-url" type="text"
									   value="<?php if ( isset( $property_meta[ 'REAL_HOMES_tour_video_url' ] ) ) {
									       echo esc_attr( $property_meta[ 'REAL_HOMES_tour_video_url' ][ 0 ] );
								       } ?>"/>
							</div>
						</div>
						<?php
					}

					if ( ire_is_displayable( 'inspiry_property_year_built_field' ) ) {
						?>

						<div class="col-md-4">
							<div class="form-option">
								<label for="year-built"><?php esc_html_e( 'Year Built', 'inspiry-real-estate' ); ?></label>
								<input id="year-built" name="year-built" type="text"
									   value="<?php if ( isset( $property_meta[ 'REAL_HOMES_property_year_built' ] ) ) {
									       echo esc_attr( $property_meta[ 'REAL_HOMES_property_year_built' ][ 0 ] );
								       } ?>"/>

							</div>
						</div>
						<?php
					}

					if ( ire_is_displayable( 'inspiry_property_parent_field' ) ) {
						$property_object = get_post_type_object( 'property' );
						if ( $property_object->hierarchical ) {
							$parent_prop_args = array(
								'post_type'        => 'property',
								'name'             => 'property_parent_id',
								'show_option_none' => esc_html__( 'None', 'inspiry-real-estate' ),
								'sort_column'      => 'menu_order, post_title',
								'number'           => 100,
								'echo'             => 1,
							);
							$parent_prop_args[ 'exclude_tree' ] = $edit_property_id;
							$parent_prop_args[ 'selected' ]     = $target_property->post_parent;
							?>
							<div class="col-md-4">
								<div class="form-option">
									<label for="property_parent_id"><?php esc_html_e( 'Parent Property', 'inspiry-real-estate' ); ?></label>
									<?php wp_dropdown_pages( $parent_prop_args ) ?>
								</div>
							</div>
							<?php
						}
					}
					?>
				</div>
				<?php
				if ( ire_is_displayable( 'inspiry_property_virtual_tour_url_360_field' ) ) {
					?>
					<div class="row">
						<div class="col-md-12">
							<div class="form-option">
								<label for="vt-embed"><?php esc_html_e( 'Virtual Tour Embed Code', 'inspiry-real-estate' ); ?></label>
								<textarea class="vt-embed-code" id="vt-embed"
										  name="vt-embed"><?php if ( isset( $property_meta[ 'REAL_HOMES_360_virtual_tour' ] ) ) {
										echo esc_html( $property_meta[ 'REAL_HOMES_360_virtual_tour' ][ 0 ] );
									} ?></textarea>
							</div>
						</div>
					</div>
					<?php
				}
				?>
				<div class="row container-row">
					<?php
					if ( ire_is_displayable( 'inspiry_property_drag_image_box_field' ) ) {
						?>
						<div class="col-lg-6">

							<div class="form-option">
								<div id="gallery-thumbs-container" class="clearfix">
									<?php
									$thumbnail_size    = 'thumbnail';
									$properties_images = rwmb_meta( 'REAL_HOMES_property_images', 'type=plupload_image&size=' . $thumbnail_size, $target_property->ID );
									$featured_image_id = get_post_thumbnail_id( $target_property->ID );
									if ( ! empty( $properties_images ) ) {
										foreach ( $properties_images as $prop_image_id => $prop_image_meta ) {
											$is_featured_image = ( $featured_image_id == $prop_image_id );
											$featured_icon     = ( $is_featured_image ) ? 'fas fa-star' : 'far fa-star';
											echo '<div class="gallery-thumb">';
											echo '<img src="' . $prop_image_meta[ 'url' ] . '" alt="' . $prop_image_meta[ 'title' ] . '" />';
											echo '<a class="remove-image" data-property-id="' . $target_property->ID . '" data-attachment-id="' . $prop_image_id . '" href="#remove-image" ><i class="fas fa-trash-alt"></i></a>';
											echo '<a class="mark-featured" data-property-id="' . $target_property->ID . '" data-attachment-id="' . $prop_image_id . '" href="#mark-featured" ><i class="far ' . $featured_icon . '"></i></a>';
											echo '<span class="loader"><i class="fa fa-spinner fa-spin"></i></span>';
											echo '<input type="hidden" class="gallery-image-id" name="gallery_image_ids[]" value="' . $prop_image_id . '"/>';
											if ( $is_featured_image ) {
												echo '<input type="hidden" class="featured-img-id" name="featured_image_id" value="' . $prop_image_id . '"/>';
											}
											echo '</div>';
										}
									}
									?>
								</div>
								<div id="drag-and-drop">
									<div class="drag-drop-msg text-center">
										<i class="fas fa-cloud-upload-alt"></i>&nbsp;&nbsp;<?php esc_html_e( 'Drag and drop images here', 'inspiry-real-estate' ); ?>
										<br/>
										<span class="drag-or"><?php esc_html_e( 'OR', 'inspiry-real-estate' ); ?></span>
										<br/>
										<a id="select-images" class="drag-btn btn-default btn-orange" href="javascript:;"><?php esc_html_e( 'Select Images', 'inspiry-real-estate' ); ?></a>
									</div>
								</div>
								<ul class="field-description list-unstyled">
									<li><span>*</span><?php esc_html_e( 'An image should have minimum width of 850px and minimum height of 600px.', 'inspiry-real-estate' ); ?></li>
									<li><span>*</span><?php esc_html_e( 'You can mark an image as featured by clicking the star icon, Otherwise first image will be considered featured image.', 'inspiry-real-estate' ); ?></li>
								</ul>
								<div id="plupload-container"></div>
								<div id="errors-log"></div>
							</div>
						</div>
						<?php
					}
					?>

					<div class="col-lg-6">
						<?php
						if ( ire_is_displayable( 'inspiry_property_agent_information_option_field' ) ) {
							?>
							<div class="form-option">
								<label class="fancy-title"><?php esc_html_e( 'What to display in agent information box ?', 'inspiry-real-estate' ); ?></label>
								<ul class="agent-options list-unstyled">
									<li>
										<span class="radio-field">
											<input id="agent_option_none" type="radio" name="agent_display_option"
												   value="none" <?php if ( isset( $property_meta[ 'REAL_HOMES_agent_display_option' ] ) && ( $property_meta[ 'REAL_HOMES_agent_display_option' ][ 0 ] == "none" ) ) {
												echo "checked";
											} ?> />
											<label for="agent_option_none"><?php esc_html_e( 'None', 'inspiry-real-estate' ); ?></label>
										</span>
										<small><?php esc_html_e( '( Agent information box will not be displayed )', 'inspiry-real-estate' ); ?></small>
									</li>

									<li>
										<span class="radio-field">
											<input id="agent_option_profile" type="radio" name="agent_display_option"
												   value="my_profile_info" <?php if ( isset( $property_meta[ 'REAL_HOMES_agent_display_option' ] ) && ( $property_meta[ 'REAL_HOMES_agent_display_option' ][ 0 ] == "my_profile_info" ) ) {
												echo "checked";
											} ?> />
											<label for="agent_option_profile"><?php esc_html_e( 'My Profile Information', 'inspiry-real-estate' ); ?></label>
										</span>
										<?php
										if ( ! empty( $inspiry_options[ 'inspiry_edit_profile_page' ] ) ) {
											$edit_profile_url = get_permalink( $inspiry_options[ 'inspiry_edit_profile_page' ] );
											if ( ! empty( $edit_profile_url ) ) {
												?>
												<small><a href="<?php echo esc_url( $edit_profile_url ); ?>" target="_blank"><?php esc_html_e( '( Edit Profile Information )', 'inspiry-real-estate' ); ?></a></small>
												<?php
											}
										}
										?>
									</li>

									<li>
										<span class="radio-field">
											<input id="agent_option_agent" type="radio" name="agent_display_option"
												   value="agent_info" <?php if ( isset( $property_meta[ 'REAL_HOMES_agent_display_option' ] ) && ( $property_meta[ 'REAL_HOMES_agent_display_option' ][ 0 ] == "agent_info" ) ) {
												echo "checked";
											} ?> />
											<label for="agent_option_agent"><?php esc_html_e( 'Display Agent Information', 'inspiry-real-estate' ); ?></label>
										</span>
										<select name="agent_id[]" id="agent-selectbox" multiple="multiple">
											<?php
											$agents_ids = get_post_meta( $target_property->ID, 'REAL_HOMES_agents' );
											if ( isset( $agents_ids ) ) {
												ire_generate_cpt_options( 'agent', $agents_ids );
											} else {
												ire_generate_cpt_options( 'agent' );
											}
											?>
										</select>
									</li>
								</ul>
							</div>
							<?php
						}

						if ( ire_is_displayable( 'inspiry_property_mark_as_feature_checkbox' ) ) {
							?>
							<div class="form-option checkbox-option clearfix">
								<input id="featured" name="featured" type="checkbox" <?php if ( isset( $property_meta[ 'REAL_HOMES_featured' ] ) && ( $property_meta[ 'REAL_HOMES_featured' ][ 0 ] == 1 ) ) {
									echo 'checked';
								} ?> />
								<label for="featured"><?php esc_html_e( 'Mark this property as featured property', 'inspiry-real-estate' ); ?></label>
							</div>
							<?php
						}
						?>
					</div>

				</div>

				<div class="row container-row">
					<?php
					if ( ire_is_displayable( 'inspiry_property_features_field' ) ) {
						?>
						<div class="col-lg-6">
							<div class="form-option">
								<label class="fancy-title"><?php esc_html_e( 'Features', 'inspiry-real-estate' ); ?></label>
								<ul class="features-checkboxes-wrapper list-unstyled clearfix">
									<?php
									// Property Features
									$property_features     = get_the_terms( $target_property->ID, "property-feature" );
									$property_features_ids = array();
									if ( ! empty( $property_features ) && ! is_wp_error( $property_features ) ) {
										foreach ( $property_features as $feature ) {
											$property_features_ids[] = $feature->term_id;
										}
									}

									// All Features
									$all_features = get_terms(
										array(
											"property-feature"
										),
										array(
											'orderby'    => 'name',
											'order'      => 'ASC',
											'hide_empty' => false,
										)
									);

									if ( ! empty( $all_features ) && ! is_wp_error( $all_features ) ) {
										foreach ( $all_features as $feature ) {
											echo '<li><span class="option-set">';
											if ( in_array( $feature->term_id, $property_features_ids ) ) {
												echo '<input type="checkbox" name="features[]" id="feature-' . $feature->term_id . '" value="' . $feature->term_id . '" checked />';
											} else {
												echo '<input type="checkbox" name="features[]" id="feature-' . $feature->term_id . '" value="' . $feature->term_id . '" />';
											}
											echo '<label for="feature-' . $feature->term_id . '">' . $feature->name . '</label>';
											echo '</li>';
										}
									}
									?>
								</ul>
							</div>
						</div>
						<?php
					}

					if ( ire_is_displayable( 'inspiry_property_additional_details_field' ) ) {
						?>
						<div class="col-lg-6">
							<div class="form-option">
								<div class="inspiry-details-wrapper">
									<label><?php esc_html_e( 'Additional Details', 'inspiry-real-estate' ); ?></label>
									<div class="inspiry-detail labels clearfix">
										<div class="inspiry-detail-control">&nbsp;</div>
										<div class="inspiry-detail-title">
											<label><?php esc_html_e( 'Title', 'inspiry-real-estate' ) ?></label>
										</div>
										<div class="inspiry-detail-value">
											<label><?php esc_html_e( 'Value', 'inspiry-real-estate' ); ?></label>
										</div>
										<div class="inspiry-detail-control">&nbsp;</div>
									</div>

									<!-- additional details container -->
									<div id="inspiry-additional-details-container">
										<?php
										// output existing details
										$additional_details = get_post_meta( $target_property->ID, 'REAL_HOMES_additional_details', true );
										if ( ! empty ( $additional_details ) ) {
											foreach ( $additional_details as $title => $value ) {
												?>
												<div class="inspiry-detail inputs clearfix">
													<div class="inspiry-detail-control">
														<i class="sort-detail fa fa-bars"></i>
													</div>
													<div class="inspiry-detail-title">
														<input type="text" name="detail-titles[]" value="<?php echo esc_attr( $title ); ?>"/>
													</div>
													<div class="inspiry-detail-value">
														<input type="text" name="detail-values[]" value="<?php echo esc_attr( $value ); ?>"/>
													</div>
													<div class="inspiry-detail-control">
														<a class="remove-detail" href="#"><i class="fa fa-times"></i></a>
													</div>
												</div>
												<?php
											}

										} else {
											?>
											<div class="inspiry-detail inputs clearfix">
												<div class="inspiry-detail-control">
													<i class="sort-detail fa fa-bars"></i>
												</div>
												<div class="inspiry-detail-title">
													<input type="text" name="detail-titles[]" value=""/>
												</div>
												<div class="inspiry-detail-value">
													<input type="text" name="detail-values[]" value=""/>
												</div>
												<div class="inspiry-detail-control">
													<a class="remove-detail" href="#"><i class="fa fa-times"></i></a>
												</div>
											</div>
											<?php
										}
										?>
									</div>

									<div class="inspiry-detail clearfix">
										<div class="inspiry-detail-control">&nbsp;</div>
										<div class="inspiry-detail-control">
											<a class="add-detail" href="#"><i class="fa fa-plus"></i></a>
										</div>
									</div>

								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>

				<div class="row container-row">
					<div class="col-xs-12">
						<div class="form-option">
							<?php wp_nonce_field( 'submit_property', 'property_nonce' ); ?>
							<input type="hidden" name="action" value="update_property"/>
							<input type="hidden" name="property_id" value="<?php echo esc_attr( $target_property->ID ); ?>"/>
							<input type="submit" value="<?php esc_html_e( 'Update Property', 'inspiry-real-estate' ); ?>" class="btn-small btn-orange"/>
						</div>
						<div id="message-container"></div>
					</div>
				</div>

			</form>
			<?php

		} else {
			ire_message( esc_html__( 'Oops', 'inspiry-real-estate' ), esc_html__( 'It appears that, Provided property does not belong to you!', 'inspiry-real-estate' ) );
		}

	} else {
		ire_message( esc_html__( 'Oops', 'inspiry-real-estate' ), esc_html__( 'It appears that, Provided property id is invalid!', 'inspiry-real-estate' ) );
	}
}