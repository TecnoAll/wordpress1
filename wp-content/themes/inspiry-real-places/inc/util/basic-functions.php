<?php
/*
 * This file contains basic utility functions used throughout the theme
 */

if ( ! function_exists( 'inspiry_generate_background' ) ) :
	/**
	 * Generate background styles
	 *
	 * @since 1.0.0
	 *
	 * @param null $color
	 * @param null $url
	 */
	function inspiry_generate_background( $url = null ) {
		if ( ! empty( $url ) ) {
			echo 'background-image: url(' . esc_url( $url ) . '); ';
		}
	}
endif;


if ( ! function_exists( 'inspiry_animation_class' ) ) :
	/**
	 * Return animation class to enable animation.
	 *
	 * @since 1.0.0
	 *
	 * @param   bool $generate
	 *
	 * @return  string
	 */
	function inspiry_animation_class( $generate = false ) {
		global $inspiry_options;
		if ( $generate || ( $inspiry_options['inspiry_animation'] == 1 ) ) {
			return 'animated';
		}

		return '';
	}

endif;


if ( ! function_exists( 'inspiry_standard_thumbnail' ) ) :
	/**
	 * Generate standard thumbnail for this theme
	 *
	 * @since 1.0.0
	 *
	 * @param   string $size
	 */
	function inspiry_standard_thumbnail( $size = 'post-thumbnail' ) {

		global $post;

		if ( has_post_thumbnail( $post->ID ) ) :

			if ( is_single() ) :
				$featured_image_id  = get_post_thumbnail_id();
				$original_image_url = wp_get_attachment_url( $featured_image_id );
				?>
				<figure class="entry-thumbnail">
					<a class="swipebox" href="<?php echo esc_url( $original_image_url ); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail( $size, array( 'class' => 'img-responsive' ) ); ?>
					</a>
				</figure>
				<?php
			else :
				?>
				<figure class="entry-thumbnail">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
						<?php the_post_thumbnail( $size, array( 'class' => 'img-responsive' ) ); ?>
					</a>
				</figure>
				<?php
			endif;

		endif;
	}

endif;


if ( ! function_exists( 'inspiry_standard_gallery' ) ) :
	/**
	 * Get list of gallery images
	 *
	 * @since 1.0.0
	 *
	 * @param string $size
	 */
	function inspiry_standard_gallery( $size = 'post-thumbnail' ) {

		global $post;

		$gallery_images = inspiry_get_post_meta(
			'REAL_HOMES_gallery',
			array(
				'type' => 'image_advanced',
				'size' => $size,
			),
			$post->ID
		);

		if ( ! empty( $gallery_images ) ) {

			echo '<div class="blog-gallery-slider gallery-slider flexslider">';
			echo '<ul class="slides list-unstyled">';

			foreach ( $gallery_images as $gallery_image ) {
				$caption = ( ! empty( $gallery_image['caption'] ) ) ? $gallery_image['caption'] : $gallery_image['alt'];
				echo '<li><a class="swipebox" data-rel="gallery-' . $post->ID . '" href="' . esc_url( $gallery_image['full_url'] ) . '" title="' . $caption . '" >';
				echo '<img src="' . esc_url( $gallery_image['url'] ) . '" alt="' . $gallery_image['title'] . '" />';
				echo '</a></li>';
			}

			echo '</ul>';
			echo '</div>';

		} elseif ( has_post_thumbnail( $post->ID ) ) {

			inspiry_standard_thumbnail( $size );

		}

	}

endif;


if ( ! function_exists( 'inspiry_get_post_meta' ) ) :
	/**
	 * Get post meta
	 *
	 * @since 1.0.0
	 *
	 * @param string   $key Meta key. Required.
	 * @param int|null $post_id Post ID. null for current post. Optional
	 * @param array    $args Array of arguments. Optional.
	 *
	 * @return mixed
	 */
	function inspiry_get_post_meta( $key, $args = array(), $post_id = null ) {

		$post_id = empty( $post_id ) ? get_the_ID() : $post_id;
		$args    = wp_parse_args(
			$args,
			array(
				'type'     => 'text',
				'multiple' => false,
			)
		);

		// Always set 'multiple' true for following field types
		if ( in_array(
			$args['type'],
			array(
				'checkbox_list',
				'file',
				'file_advanced',
				'image',
				'image_advanced',
				'plupload_image',
				'thickbox_image',
			)
		) ) {
			$args['multiple'] = true;
		}

		$meta = get_post_meta( $post_id, $key, ! $args['multiple'] );

		// Get uploaded files info
		if ( in_array( $args['type'], array( 'file', 'file_advanced' ) ) ) {

			if ( is_array( $meta ) && ! empty( $meta ) ) {
				$files = array();
				foreach ( $meta as $id ) {
					// Get only info of existing attachments
					if ( get_attached_file( $id ) ) {
						$files[ $id ] = inspiry_get_file_info( $id );
					}
				}
				$meta = $files;
			}

			// Get uploaded images info
		} elseif ( in_array(
			$args['type'],
			array(
				'image',
				'plupload_image',
				'thickbox_image',
				'image_advanced',
			)
		) ) {

			if ( is_array( $meta ) && ! empty( $meta ) ) {
				$images = array();
				foreach ( $meta as $id ) {
					// Get only info of existing attachments
					if ( get_attached_file( $id ) ) {
						$images[ $id ] = inspiry_get_file_info( $id, $args );
					}
				}
				$meta = $images;
			}

			// Get terms
		} elseif ( 'taxonomy_advanced' == $args['type'] ) {

			if ( ! empty( $args['taxonomy'] ) ) {
				$term_ids = array_map( 'intval', array_filter( explode( ',', $meta . ',' ) ) );
				// Allow to pass more arguments to "get_terms"
				$func_args = wp_parse_args(
					array(
						'include'    => $term_ids,
						'hide_empty' => false,
					),
					$args
				);
				unset( $func_args['type'], $func_args['taxonomy'], $func_args['multiple'] );
				$meta = get_terms( $args['taxonomy'], $func_args );
			} else {
				$meta = array();
			}

			// Get post terms
		} elseif ( 'taxonomy' == $args['type'] ) {

			$meta = empty( $args['taxonomy'] ) ? array() : wp_get_post_terms( $post_id, $args['taxonomy'] );

		}

		return $meta;
	}

endif;


if ( ! function_exists( 'inspiry_get_file_info' ) ) :
	/**
	 * Get uploaded file information
	 *
	 * @since 1.0.0
	 *
	 * @param int   $file_id Attachment image ID (post ID). Required.
	 * @param array $args Array of arguments (for size).
	 *
	 * @return array|bool False if file not found. Array of image info on success
	 */
	function inspiry_get_file_info( $file_id, $args = array() ) {

		$args = wp_parse_args(
			$args,
			array(
				'size' => 'thumbnail',
			)
		);

		$img_src = wp_get_attachment_image_src( $file_id, $args['size'] );
		if ( ! $img_src ) {
			return false;
		}

		$attachment = get_post( $file_id );
		$path       = get_attached_file( $file_id );

		return array(
			'ID'          => $file_id,
			'name'        => basename( $path ),
			'path'        => $path,
			'url'         => $img_src[0],
			'width'       => $img_src[1],
			'height'      => $img_src[2],
			'full_url'    => wp_get_attachment_url( $file_id ),
			'title'       => $attachment->post_title,
			'caption'     => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'alt'         => get_post_meta( $file_id, '_wp_attachment_image_alt', true ),
		);
	}

endif;


if ( ! function_exists( 'inspiry_nothing_found' ) ) :
	/**
	 * Display nothing found message
	 *
	 * @param $message
	 */
	function inspiry_nothing_found() {
		?>
		<section class="no-results not-found">
			<h2><?php esc_html_e( 'Nothing Found', 'inspiry' ); ?></h2>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'inspiry' ); ?></p>
			<?php get_search_form(); ?>
		</section>
		<!-- .no-results -->
		<?php
	}

endif;


if ( ! function_exists( 'inspiry_pagination' ) ) :
	/**
	 * Output pagination
	 *
	 * @param $query
	 */
	function inspiry_pagination( $query ) {

		if ( isset( $query->max_num_pages ) && ( $query->max_num_pages > 1 ) ) {

			$paged = ( is_front_page() ) ? get_query_var( 'page' ) : get_query_var( 'paged' );

			echo "<div class='pagination'>";

			$big = 999999999; // need an unlikely integer
			echo paginate_links(
				array(
					'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format'    => '?paged=%#%',
					'prev_text' => '<i class="fa fa-angle-left"></i>',
					'next_text' => '<i class="fa fa-angle-right"></i>',
					'current'   => max( 1, $paged ),
					'total'     => $query->max_num_pages,
				)
			);

			echo '</div>';

		}
	}

endif;


if ( ! function_exists( 'inspiry_excerpt' ) ) {
	/**
	 * Output excerpt for given number of words
	 *
	 * @param int    $len
	 * @param string $trim
	 */
	function inspiry_excerpt( $len = 15, $trim = '&hellip;' ) {
		echo get_inspiry_excerpt( $len, $trim );
	}
}


if ( ! function_exists( 'get_inspiry_excerpt' ) ) {
	/**
	 * Return excerpt for given number of words.
	 *
	 * @param int    $len
	 * @param string $trim
	 *
	 * @return string
	 */
	function get_inspiry_excerpt( $len = 15, $trim = '&hellip;' ) {
		return wp_trim_words( get_the_excerpt(), $len, $trim );
	}
}


if ( ! function_exists( 'get_inspiry_custom_excerpt' ) ) {
	/**
	 * Return excerpt for given number of words from custom contents
	 *
	 * @param string $contents
	 * @param int    $len
	 * @param string $trim
	 *
	 * @return array|string
	 */
	function get_inspiry_custom_excerpt( $contents, $len = 15, $trim = '&hellip;' ) {
		return wp_trim_words( $contents, $len, $trim );
	}
}


if ( ! function_exists( 'inspiry_col_animation_class' ) ) {
	/**
	 * Provide animation class based on columns and index
	 *
	 * @param int $number_of_cols number of columns
	 * @param int $col_index column's index
	 *
	 * @return string   animation class
	 */
	function inspiry_col_animation_class( $number_of_cols = 3, $col_index ) {

		// For 1 Column Layout
		if ( $number_of_cols == 1 ) {
			return 'fade-in-up';
		}

		// For 2 Columns Layout
		if ( $number_of_cols == 2 ) {
			if ( $col_index % 2 == 0 ) {
				return 'fade-in-right';
			} else {
				return 'fade-in-left';
			}
		}

		// For 3 Columns Layout
		if ( $number_of_cols == 3 ) {
			if ( $col_index % 3 == 0 ) {
				return 'fade-in-right';
			} elseif ( $col_index % 3 == 1 ) {
				return 'fade-in-left';
			} else {
				return 'fade-in-up';
			}
		}

		// For 4 Columns Layout
		if ( $number_of_cols == 4 ) {
			if ( $col_index % 4 == 0 ) {
				return 'fade-in-right';
			} elseif ( $col_index % 4 == 1 ) {
				return 'fade-in-left';
			} else {
				return 'fade-in-up';
			}
		}

		return 'fade-in-up';

	}
}


/*
-----------------------------------------------------------------------------------*/
// Featured image place holder
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'get_inspiry_image_placeholder' ) ) {
	/**
	 * Return place holder image
	 *
	 * @param $image_size string    image size
	 * @param $image_class string   image class
	 *
	 * @return string   image tag
	 */
	function get_inspiry_image_placeholder( $image_size, $image_class = 'img-responsive' ) {

		global $_wp_additional_image_sizes;

		$holder_width  = 0;
		$holder_height = 0;
		$holder_text   = get_bloginfo( 'name' );

		if ( in_array( $image_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

			$holder_width  = get_option( $image_size . '_size_w' );
			$holder_height = get_option( $image_size . '_size_h' );

		} elseif ( isset( $_wp_additional_image_sizes[ $image_size ] ) ) {

			$holder_width  = $_wp_additional_image_sizes[ $image_size ]['width'];
			$holder_height = $_wp_additional_image_sizes[ $image_size ]['height'];

		}

		if ( intval( $holder_width ) > 0 && intval( $holder_height ) > 0 ) {
			$place_holder_final_url = esc_url(
				add_query_arg(
					array(
						'text' => urlencode( $holder_text ),
					),
					sprintf(
						'//via.placeholder.com/%dx%d',
						$holder_width,
						$holder_height
					)
				)
			);

			return sprintf( '<img class="%s" src="%s" />', $image_class, $place_holder_final_url );
		}

		return '';
	}
}

if ( ! function_exists( 'get_inspiry_image_placeholder_url' ) ) {

	/**
	 * Returns the URL of placeholder image.
	 *
	 * @param string $image_size - Image size.
	 * @return string|boolean - URL of the placeholder OR `false` on failure.
	 * @since 3.1.0
	 */
	function get_inspiry_image_placeholder_url( $image_size ) {

		global $_wp_additional_image_sizes;

		$holder_width  = 0;
		$holder_height = 0;
		$holder_text   = get_bloginfo( 'name' );

		$protocol = 'http';
		$protocol = ( is_ssl() ) ? 'https' : $protocol;

		if ( in_array( $image_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

			$holder_width  = get_option( $image_size . '_size_w' );
			$holder_height = get_option( $image_size . '_size_h' );

		} elseif ( isset( $_wp_additional_image_sizes[ $image_size ] ) ) {

			$holder_width  = $_wp_additional_image_sizes[ $image_size ]['width'];
			$holder_height = $_wp_additional_image_sizes[ $image_size ]['height'];

		}

		if ( intval( $holder_width ) > 0 && intval( $holder_height ) > 0 ) {
			return $protocol . '://placehold.it/' . $holder_width . 'x' . $holder_height . '&text=' . urlencode( $holder_text );
		}

		return false;

	}
}


if ( ! function_exists( 'inspiry_image_placeholder' ) ) {
	/*
	 * Display place holder image.
	 */
	function inspiry_image_placeholder( $image_size, $image_class = 'img-responsive' ) {
		echo get_inspiry_image_placeholder( $image_size, $image_class );
	}
}


if ( ! function_exists( 'inspiry_thumbnail' ) ) :
	/**
	 * Display thumbnail
	 *
	 * @param string $size
	 */
	function inspiry_thumbnail( $size = 'inspiry-grid-thumbnail' ) {
		?>
		<a href="<?php the_permalink(); ?>">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( $size, array( 'class' => 'img-responsive' ) );
			} else {
				inspiry_image_placeholder( $size, 'img-responsive' );
			}
			?>
		</a>
		<?php
	}
endif;


if ( ! function_exists( 'inspiry_highlighted_message' ) ) :
	/**
	 * Output given message for visitor with highlighted background
	 *
	 * @param string $heading
	 * @param string $message
	 */
	function inspiry_highlighted_message( $heading = '', $message = '' ) {

		echo '<div class="inspiry-highlighted-message">';
		if ( ! empty( $heading ) ) {
			echo '<h4>' . $heading . '</h4>';
		}
		if ( ! empty( $message ) ) {
			echo '<p>' . $message . '</p>';
		}
		echo '<i class="fa fa-times close-message"></i>';
		echo '</div>';

	}
endif;


if ( ! function_exists( 'inspiry_log' ) ) {
	/**
	 * Log a given message to wp-content/debug.log file, if debug is enabled from wp-config.php file
	 *
	 * @param $message
	 */
	function inspiry_log( $message ) {
		if ( WP_DEBUG === true ) {
			if ( is_array( $message ) || is_object( $message ) ) {
				error_log( print_r( $message, true ) );
			} else {
				error_log( $message );
			}
		}
	}
}


if ( ! function_exists( 'inspiry_theme_comment' ) ) {
	/**
	 * Theme Custom Comment Template
	 */
	function inspiry_theme_comment( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback':
			case 'trackback':
				?>
				<li class="pingback">
					<p><?php esc_html_e( 'Pingback:', 'inspiry' ); ?><?php comment_author_link(); ?><?php edit_comment_link( esc_html__( '(Edit)', 'inspiry' ), ' ' ); ?></p>
				</li>
				<?php
				break;

			default:
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment-body">

					<div class="author-photo">
						<a class="avatar" href="<?php comment_author_url(); ?>">
							<?php echo get_avatar( $comment, 68, '', '', array( 'class' => 'img-circle' ) ); ?>
						</a>
					</div>

					<div class="comment-wrapper">
						<div class="comment-meta">
							<div class="comment-author vcard">
								<h5 class="fn"><?php echo get_comment_author_link(); ?></h5>
							</div>
							<div class="comment-metadata">
								<time
									datetime="<?php comment_time( 'c' ); ?>"><?php printf( esc_html__( '%1$s', 'inspiry' ), get_comment_date() ); ?></time>
							</div>
						</div>

						<div class="comment-content">
							<?php comment_text(); ?>
						</div>

						<div class="reply">
							<?php
							comment_reply_link(
								array_merge(
									array( 'before' => '' ),
									array(
										'depth'     => $depth,
										'max_depth' => $args['max_depth'],
									)
								)
							);
							?>
						</div>
					</div>

				</article>
				<!-- end of comment -->
				<?php
				break;

		endswitch;
	}
}


if ( ! function_exists( 'real_places_gallery_desc' ) ) :
	/**
	 * Filter for gallery images meta box description
	 *
	 * @return string|void
	 */
	function real_places_gallery_desc() {
		return esc_html__( 'Images should have minimum size of 850px by 600px. Bigger size images will be cropped automatically.', 'inspiry' );
	}

	add_filter( 'inspiry_gallery_description', 'real_places_gallery_desc' );
endif;


if ( ! function_exists( 'real_places_slider_desc' ) ) :
	/**
	 * Filter for slider image meta box description
	 *
	 * @return string|void
	 */
	function real_places_slider_desc() {
		return esc_html__( 'The recommended image size is 2000px by 1000px. You can use a bigger or smaller size but keep the same height to width ratio and use exactly same size images for all slider entries.', 'inspiry' );
	}

	add_filter( 'inspiry_slider_description', 'real_places_slider_desc' );
endif;


if ( ! function_exists( 'real_places_video_desc' ) ) :
	/**
	 * Filter for video image meta box description
	 *
	 * @return string|void
	 */
	function real_places_video_desc() {
		return esc_html__( 'Provided image will be used as a video place holder and when user will click on it the video will be opened in a lightbox. Minimum required image size is 850px by 600px.', 'inspiry' );
	}

	add_filter( 'inspiry_video_description', 'real_places_video_desc' );
endif;


if ( ! function_exists( 'inspiry_home_body_classes' ) ) :
	/**
	 * Filter to add header and slider variation classes to body
	 */
	function inspiry_home_body_classes( $classes ) {

		global $inspiry_options;

		// class for sticky header
		if ( $inspiry_options['inspiry_sticky_header'] == '1' ) {
			$classes[] = 'inspiry-sticky-header';
		}

		if ( is_page_template( 'page-templates/home.php' ) ) {

			// For Demo Purposes
			if ( isset( $_GET['module_below_header'] ) ) {
				$inspiry_options['inspiry_home_module_below_header'] = $_GET['module_below_header'];
				if ( isset( $_GET['module_below_header'] ) ) {
					$inspiry_options['inspiry_slider_type'] = $_GET['slider_type'];
				}
			}

			// class for header variation
			if ( $inspiry_options['inspiry_header_variation'] == '1' ) {
				$classes[] = 'inspiry-header-variation-one';
			} elseif ( $inspiry_options['inspiry_header_variation'] == '2' ) {
				$classes[] = 'inspiry-header-variation-two';
			} else {
				$classes[] = 'inspiry-header-variation-three';
			}

			// class for module below header
			if ( $inspiry_options['inspiry_home_module_below_header'] == 'slider' ) {
				$classes[] = 'inspiry-slider-header';

				// class for slider type
				if ( $inspiry_options['inspiry_slider_type'] == 'revolution-slider' ) {
					$classes[] = 'inspiry-revolution-slider';
				} elseif ( $inspiry_options['inspiry_slider_type'] == 'properties-slider-two' ) {
					$classes[] = 'inspiry-slider-two';
				} elseif ( $inspiry_options['inspiry_slider_type'] == 'properties-slider-three' ) {
					$classes[] = 'inspiry-slider-three';
				} else {
					$classes[] = 'inspiry-slider-one';
				}
			} elseif ( $inspiry_options['inspiry_home_module_below_header'] == 'google-map' ) {
				$classes[] = 'inspiry-google-map-header';
			} else {
				$classes[] = 'inspiry-banner-header';
			}
		} elseif ( is_page_template( 'page-templates/properties-search.php' ) ) {

			if ( $inspiry_options['inspiry_header_variation'] == '1' ) {
				if ( $inspiry_options['inspiry_search_module_below_header'] == 'google-map' ) {
					$classes[] = 'inspiry-google-map-header';
				} else {
					$classes = inspiry_revolution_slider_class( $classes );
				}
			}
		} elseif ( is_page_template( 'page-templates/properties-list.php' )
				   || is_page_template( 'page-templates/properties-list-with-sidebar.php' )
				   || is_page_template( 'page-templates/properties-grid.php' )
				   || is_page_template( 'page-templates/properties-grid-with-sidebar.php' )
				   || is_page_template( 'page-templates/properties-list-half-map.php' )
		) {

			if ( $inspiry_options['inspiry_header_variation'] == '1' ) {
				$display_google_map = get_post_meta( get_the_ID(), 'inspiry_display_google_map', true );
				if ( $display_google_map ) {
					$classes[] = 'inspiry-google-map-header';
				} else {
					$classes = inspiry_revolution_slider_class( $classes );
				}
			}
		} elseif ( is_page() || is_singular( 'agent' ) ) {

			if ( $inspiry_options['inspiry_header_variation'] == '1' ) {
				$classes = inspiry_revolution_slider_class( $classes );
			}
		}

		return $classes;
	}

	add_filter( 'body_class', 'inspiry_home_body_classes' );

endif;


if ( ! function_exists( 'inspiry_revolution_slider_class' ) ) :
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function inspiry_revolution_slider_class( $classes ) {
		$revolution_slider_alias = get_post_meta( get_the_ID(), 'REAL_HOMES_rev_slider_alias', true );
		if ( function_exists( 'putRevSlider' ) && ( ! empty( $revolution_slider_alias ) ) ) {
			$classes[] = 'inspiry-revolution-slider';
		}

		return $classes;
	}
endif;


if ( ! function_exists( 'inspiry_update_taxonomy_pagination' ) ) {
	/**
	 * Update Taxonomy Pagination Based on Number of Properties Provided in Theme Options
	 *
	 * @param $query
	 */
	function inspiry_update_taxonomy_pagination( $query ) {
		if ( is_tax( 'property-type' )
			 || is_tax( 'property-status' )
			 || is_tax( 'property-city' )
			 || is_tax( 'property-feature' )
		) {
			global $inspiry_options;
			if ( $query->is_main_query() ) {
				$number_of_properties = intval( $inspiry_options['inspiry_archive_properties_number'] );
				if ( ! $number_of_properties ) {
					$number_of_properties = 6;
				}
				$query->set( 'posts_per_page', $number_of_properties );
			}
		}
	}

	add_action( 'pre_get_posts', 'inspiry_update_taxonomy_pagination' );

}

if ( ! function_exists( 'inspiry_property_archive_pagination' ) ) {
	/**
	 * Property archive pagination based on Number of Properties Provided in settings
	 *
	 * @param $query
	 */
	function inspiry_property_archive_pagination( $query ) {
		global $inspiry_options;
		if ( ! is_admin() && is_post_type_archive( 'property' ) ) {
			if ( $query->is_main_query() ) {
				$number_of_properties = intval( $inspiry_options['inspiry_archive_properties_number'] );
				if ( ! $number_of_properties ) {
					$number_of_properties = 6;
				}
				$query->set( 'posts_per_page', $number_of_properties );
			}
		}
	}

	add_action( 'pre_get_posts', 'inspiry_property_archive_pagination' );
}


if ( ! function_exists( 'inspiry_pagination_fix' ) ) :
	/**
	 * Pagination fix for agent page
	 *
	 * @param $redirect_url
	 *
	 * @return bool
	 */
	function inspiry_pagination_fix( $redirect_url ) {
		if ( is_singular( 'agent' ) || is_front_page() ) {
			$redirect_url = false;
		}

		return $redirect_url;
	}

	add_filter( 'redirect_canonical', 'inspiry_pagination_fix' );
endif;


if ( ! function_exists( 'inspiry_backend_safe_string' ) ) {
	/**
	 * Create a lower case version of a string without spaces so we can use that string for database settings
	 *
	 * @param string $string to convert
	 *
	 * @return string the converted string
	 */
	function inspiry_backend_safe_string( $string, $replace = '_', $check_spaces = false ) {
		$string = strtolower( $string );

		$trans = array(
			'&\#\d+?;'       => '',
			'&\S+?;'         => '',
			'\s+'            => $replace,
			'ä'              => 'ae',
			'ö'              => 'oe',
			'ü'              => 'ue',
			'Ä'              => 'Ae',
			'Ö'              => 'Oe',
			'Ü'              => 'Ue',
			'ß'              => 'ss',
			'[^a-z0-9\-\._]' => '',
			$replace . '+'   => $replace,
			$replace . '$'   => $replace,
			'^' . $replace   => $replace,
			'\.+$'           => '',
		);

		$trans = apply_filters( 'inspiry_safe_string_trans', $trans, $string, $replace );

		$string = strip_tags( $string );

		foreach ( $trans as $key => $val ) {
			$string = preg_replace( '#' . $key . '#i', $val, $string );
		}

		if ( $check_spaces ) {
			if ( str_replace( '_', '', $string ) == '' ) {
				return;
			}
		}

		return stripslashes( $string );
	}
}

if ( ! function_exists( 'inspiry_dynamic_sidebar' ) ) {
	/**
	 * Check if custom sidebars set to display otherwise
	 * display default entry's sidebar
	 *
	 * @param $sidebar // index of the sidebar
	 */
	function inspiry_dynamic_sidebar( $sidebar ) {

		global $wp_registered_sidebars;

		if ( is_home() ) {
			$the_id = get_option( 'page_for_posts' );
		} else {
			$the_id = get_the_ID();
		}

		$custom_sidebar = get_post_meta( $the_id, 'REAL_HOMES_entry_sidebar', true );

		if ( ! empty( $custom_sidebar ) && array_key_exists( inspiry_backend_safe_string( $custom_sidebar, '-' ), $wp_registered_sidebars ) ) {
			if ( is_active_sidebar( $custom_sidebar ) ) {
				dynamic_sidebar( $custom_sidebar );
			}
		} else {
			if ( is_active_sidebar( $sidebar ) ) {
				dynamic_sidebar( $sidebar );
			}
		}

	}
}

if ( ! function_exists( 'inspiry_is_active_custom_sidebar' ) ) {
	/**
	 * Check if custom sidebars set to display otherwise
	 * display default sidebar
	 *
	 * @param $default
	 *
	 * @return bool
	 */
	function inspiry_is_active_custom_sidebar( $default = '' ) {

		global $wp_registered_sidebars;

		if ( is_home() ) {
			$the_id = get_option( 'page_for_posts' );
		} else {
			$the_id = get_the_ID();
		}

		$custom_sidebar = get_post_meta( $the_id, 'REAL_HOMES_entry_sidebar', true );

		if ( ! empty( $custom_sidebar ) && array_key_exists( inspiry_backend_safe_string( $custom_sidebar, '-' ), $wp_registered_sidebars ) ) {
			return is_active_sidebar( $custom_sidebar );
		}

		return is_active_sidebar( $default );
	}
}


if ( ! function_exists( 'inspiry_post_nav' ) ) {

	/**
	 * Return link to previous and next entry.
	 *
	 * @param bool $same_category - True if from same category.
	 */
	function inspiry_post_nav( $same_category = false ) {
		global $inspiry_options;

		if ( ( '1' == $inspiry_options['inspiry_single_property_nav'] && is_singular( 'property' ) )
			 || ( '1' == $inspiry_options['inspiry_single_posts_nav'] && is_singular( 'post' ) )
		) {

			$entries['prev'] = get_previous_post( $same_category );
			$entries['next'] = get_next_post( $same_category );

			$output = '';

			foreach ( $entries as $key => $entry ) {
				if ( empty( $entry ) ) {
					continue;
				}

				$the_title = get_the_title( $entry->ID );
				$link      = get_permalink( $entry->ID );
				$image     = has_post_thumbnail( $entry );

				$entry_title = $entry_img = '';
				$class       = ( $image ) ? 'with-image' : 'without-image';
				$icon        = ( 'prev' == $key ) ? 'angle-left' : 'angle-right';

				?>
				<a class='inspiry-post-nav inspiry-post-<?php echo esc_attr( $key ) . ' ' . esc_attr( $class ); ?>'
				   href='<?php echo esc_url( $link ); ?>'>
					<span class='label'><i class="fa fa-<?php echo esc_attr( $icon ); ?>"></i></span>
						<span class='entry-info-wrap'>
							<span class='entry-info'>
								<?php if ( 'prev' == $key ) : ?>
									<span class='entry-title'><?php echo esc_html( $the_title ); ?></span>
									<?php if ( $image ) : ?>
										<span class='entry-image'>
											<?php echo get_the_post_thumbnail( $entry, 'thumbnail' ); ?>
										</span>
									<?php else : ?>
										<span class="entry-image">
											<?php inspiry_image_placeholder( 'thumbnail' ); ?>
										</span>
									<?php endif; ?>
								<?php else : ?>
									<?php if ( $image ) : ?>
										<span class='entry-image'>
											<?php echo get_the_post_thumbnail( $entry, 'thumbnail' ); ?>
										</span>
									<?php else : ?>
										<span class="entry-image">
											<?php inspiry_image_placeholder( 'thumbnail' ); ?>
										</span>
									<?php endif; ?>
									<span class='entry-title'><?php echo esc_html( $the_title ); ?></span>
								<?php endif; ?>
							</span>
						</span>
				</a>
				<?php
			}
		}
	}

	add_action( 'wp_footer', 'inspiry_post_nav' );

}

if ( ! function_exists( 'inspiry_filter_protocol' ) ) {

	/**
	 * Return filtered URL on the basis of protocol.
	 *
	 * @param string $url
	 */
	function inspiry_filter_protocol( $url ) {
		$filtered_url = is_ssl() ? str_replace( 'http://', 'https://', $url ) : $url;
		return $filtered_url;
	}
}
if ( ! function_exists( 'inspiry_walkscore' ) ) {
	/**
	 * Displays the property WalkScore.
	 *
	 * @since 1.9.0
	 */
	function inspiry_walkscore() {
		global $inspiry_options;
		global $inspiry_single_property;
		$api_key          = $inspiry_options['inspiry_property_walkScore_api_key'];
		$property_address = $inspiry_single_property->get_address();

		if ( empty( $property_address ) ) {
			return;
		}

		echo '<div id="ws-walkscore-tile"></div>';
		$data = "var ws_wsid    = '" . esc_html( $api_key ) . "';
                 var ws_address = '" . esc_html( $property_address ) . "';
                 var ws_format  = 'wide';
                 var ws_width   = '550';
                 var ws_width   = '100%';
                 var ws_height  = '350';";
		wp_enqueue_script( 'inspiry-walkscore', 'https://www.walkscore.com/tile/show-walkscore-tile.php', array(), null, true );
		wp_add_inline_script( 'inspiry-walkscore', $data, 'before' );
	}
}
if ( ! function_exists( 'inspiry_google_maps_api_key_lib' ) ) {

	/**
	 * Add the Google Maps libraries.
	 *
	 * @since 1.9.0
	 */
	function inspiry_google_maps_api_key_lib( $google_map_arguments ) {

		if ( inspiry_has_google_maps_api_key() ) {
			$google_map_arguments['libraries'] = 'places,geometry';
		}

		return $google_map_arguments;
	}

	add_filter( 'inspiry_google_map_arguments', 'inspiry_google_maps_api_key_lib', 20 );
}
