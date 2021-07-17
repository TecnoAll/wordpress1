<?php
/**
 * Meta box configuration file.
 */

if ( ! function_exists( 'inspiry_register_meta_boxes' ) ) {
	/**
	 * Register meta boxes for this theme
	 *
	 * @param $meta_boxes
	 *
	 * @return array
	 * @since 1.0.0
	 */
	function inspiry_register_meta_boxes( $meta_boxes ) {

		$prefix      = 'REAL_HOMES_';

		/*
		 * Video embed code meta box for video post format
		 */
		$meta_boxes[] = array(
			'id'       => 'video-meta-box',
			'title'    => esc_html__( 'Video Embed Code', 'inspiry' ),
			'pages'    => array( 'post' ),
			'context'  => 'normal',
			'priority' => 'high',
			'show'     => array(
				'post_format' => array( 'video' ), // List of post formats. Array. Case insensitive. Optional.
			),
			'fields'   => array(
				array(
					'name' => esc_html__( 'Video Embed Code', 'inspiry' ),
					'desc' => esc_html__( 'If you are not using self hosted videos then please provide the video embed code and remove the width and height attributes.', 'inspiry' ),
					'id'   => "{$prefix}embed_code",
					'type' => 'textarea',
					'cols' => '20',
					'rows' => '3'
				)
			)
		);


		/*
		 * Gallery Meta Box
		 */
		$meta_boxes[] = array(
			'id'       => 'gallery-meta-box',
			'title'    => esc_html__( 'Gallery Images', 'inspiry' ),
			'pages'    => array( 'post' ),
			'context'  => 'normal',
			'priority' => 'high',
			'show'     => array(
				'post_format' => array( 'gallery' ), // List of post formats. Array. Case insensitive. Optional.
			),
			'fields'   => array(
				array(
					'name'             => esc_html__( 'Upload Gallery Images', 'inspiry' ),
					'id'               => "{$prefix}gallery",
					'desc'             => esc_html__( 'Images should have minimum width of 850px and minimum height of 567px, Bigger size images will be cropped automatically.', 'inspiry' ),
					'type'             => 'image_advanced',
					'max_file_uploads' => 48,
				)
			)
		);


		/*
		 * Banner meta box for home page templates
		 */
		$meta_boxes[] = array(
			'id'       => 'home-banner-meta-box',
			'title'    => esc_html__( 'Banner Settings', 'inspiry' ),
			'pages'    => array( 'page' ),
			'context'  => 'normal',
			'priority' => 'low',
			'show'     => array(
				'template' => array( 'page-templates/home.php' ),
			),
			'fields'   => array(
				array(
					'name'             => esc_html__( 'Banner Image', 'inspiry' ),
					'id'               => "inspiry_homepage_banner_image",
					'desc'             => esc_html__( 'Banner image should have minimum width of 2000px and minimum height of 320px.', 'inspiry' ),
					'type'             => 'image_advanced',
					'max_file_uploads' => 1
				)
			)
		);


		/*
		 * Banner meta box
		 */
		$meta_boxes[] = array(
			'id'       => 'banner-meta-box',
			'title'    => esc_html__( 'Banner Settings', 'inspiry' ),
			'pages'    => array( 'post', 'page', 'agent' ),
			'context'  => 'normal',
			'priority' => 'low',
			'hide'     => array(
				'template' => array(
					'page-templates/home.php',
				),
			),
			'fields'   => array(
				array(
					'name'             => esc_html__( 'Banner Image', 'inspiry' ),
					'id'               => "{$prefix}page_banner_image",
					'desc'             => esc_html__( 'Banner image should have minimum width of 2000px and minimum height of 320px.', 'inspiry' ),
					'type'             => 'image_advanced',
					'max_file_uploads' => 1
				),
				array(
					'name' => esc_html__( 'Revolution Slider Alias', 'inspiry' ),
					'id'   => "{$prefix}rev_slider_alias",
					'desc' => esc_html__( 'If you want to replace banner with revolution slider then provide its alias here.', 'inspiry' ),
					'type' => 'text'
				)
			)
		);


		// apply a filter before returning meta boxes
		$meta_boxes = apply_filters( 'inspiry_theme_meta', $meta_boxes );

		return $meta_boxes;

	}

	add_filter( 'rwmb_meta_boxes', 'inspiry_register_meta_boxes' );

}
