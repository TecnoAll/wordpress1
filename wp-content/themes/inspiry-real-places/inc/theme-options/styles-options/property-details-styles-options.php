<?php
/*
 * Header Styles Options
 */
global $opt_name;

Redux::setSection( $opt_name, array(
		'title'      => esc_html__( 'Property Details Page', 'inspiry' ),
		'id'         => 'property-details-styles',
		'desc'       => esc_html__( 'This section contains property details styles options.', 'inspiry' ),
		'subsection' => true,
		'fields'     => array(

			// css generation code reside in css/dynamic-css.php
			array(
				'id'          => 'inspiry_property_details_heading_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Headings Color', 'inspiry' ),
				'default'     => '#0dbae8',
				'transparent' => false,
			),
			array(
				'id'          => 'inspiry_property_details_price_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Price Color', 'inspiry' ),
				'default'     => '#0dbae8',
				'transparent' => false,
			),
			array(
				'id'          => 'inspiry_property_details_meta_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Meta Icons Color', 'inspiry' ),
				'default'     => '#0dbae8',
				'transparent' => false,
			),
			array(
				'id'          => 'inspiry_property_details_agent_background',
				'type'        => 'color',
				'title'       => esc_html__( 'Agent Section Background Color', 'inspiry' ),
				'default'     => '#0dbae8',
				'transparent' => false,
			),
			array(
				'id'          => 'inspiry_property_details_agent_meta_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Agent Meta Icons Color', 'inspiry' ),
				'default'     => '#0080BE',
				'transparent' => false,
			),
			array(
				'id'          => 'inspiry_property_details_agent_social_heading_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Agent Social Heading Color', 'inspiry' ),
				'default'     => '#fff',
				'transparent' => false,
			),
			array(
				'id'          => 'inspiry_property_details_agent_social_info_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Agent Social Information Color', 'inspiry' ),
				'default'     => '#ccf3ff',
				'transparent' => false,
			),
			array(
				'id'          => 'inspiry_property_details_agent_section_button_text_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Agent Section Buttons Color', 'inspiry' ),
				'default'     => '#fff',
				'transparent' => false,
			),
			array(
				'id'          => 'inspiry_property_details_agent_section_button_text_hover_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Agent Section Buttons Hover Color', 'inspiry' ),
				'default'     => '#fff',
				'transparent' => false,
			),
			array(
				'id'          => 'inspiry_property_details_agent_section_button_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Agent Section Buttons Color', 'inspiry' ),
				'default'     => '#069cd2',
				'transparent' => false,
			),
			array(
				'id'          => 'inspiry_property_details_agent_section_button_hover_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Agent Section Buttons Hover Color', 'inspiry' ),
				'default'     => '#0586b4',
				'transparent' => false,
			),

		)
	)
);