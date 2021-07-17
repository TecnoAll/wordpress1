<?php
/*
 * Property Compare Options
 */
global $opt_name;
Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Properties Compare', 'inspiry' ),
	'id'    => 'compare-section',
	'data'     => 'pages',

	'desc'  => esc_html__( 'This section contains options related to properties compare.', 'inspiry' ),
	'fields'=> array(

		array(
			'id'       => 'inspiry_compare_display_options',
			'type'     => 'switch',
			'title'    => esc_html__( 'Properties Compare', 'inspiry' ),
			'default'  => 1,
			'on'       => esc_html__( 'Enable', 'inspiry' ),
			'off'      => esc_html__( 'Disable', 'inspiry' ),
		),

		array(
			'id'       => 'inspiry_compare_page',
			'type'     => 'select',
			'data'     => 'pages',
			'title'    => esc_html__( 'Properties Compare Page', 'inspiry' ),
			'subtitle' => esc_html__( 'Select a page for properties compare.', 'inspiry' ),
			'desc'     => esc_html__( 'Make sure the selected page is using Compare Properties template.', 'inspiry' ),
			'required' => array( 'inspiry_compare_display_options', '=', '1' ),

		),


	) ) );