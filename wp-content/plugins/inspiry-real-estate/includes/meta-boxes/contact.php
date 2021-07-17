<?php
/**
 * Declares contact meta boxes.
 *
 * @param $meta_boxes
 *
 * @return array
 */
function ire_register_contact_meta_boxes( $meta_boxes ) {

	$admin_email        = get_option( 'admin_email' );
	$inspiry_map_option = get_option( 'inspiry_map_option' );
	$meta_boxes[]       = array(
		'id'        => 'contact-meta-box',
		'title'     => esc_html__( 'Contact Page Information', 'inspiry-real-estate' ),
		'pages'     => array( 'page' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'tabs'      => array(
			'google-map'      => array(
				'label' => esc_html__( 'Google Map', 'inspiry-real-estate' ),
				'icon'  => 'dashicons-location',
			),
			'contact-details' => array(
				'label' => esc_html__( 'Contact Details', 'inspiry-real-estate' ),
				'icon'  => 'dashicons-phone',
			),
			'contact-form'    => array(
				'label' => esc_html__( 'Contact Form', 'inspiry-real-estate' ),
				'icon'  => 'dashicons-email',
			),
		),
		'tab_style' => 'left',
		'show'      => array(
			'template' => array( 'page-templates/contact.php' ),
		),
		'fields'    => array(
			array(
				'id'   => 'inspiry_map_address',
				'name' => esc_html__( 'Office Address', 'inspiry-real-estate' ),
				'desc' => esc_html__( 'Leaving it empty will hide the google map.', 'inspiry-real-estate' ),
				'type' => 'text',
				'std'  => '121 King St, Melbourne VIC 3000, Australia',
				'tab'  => 'google-map',
				'size' => 50,
			),
			array(
				'id'            => 'inspiry_map_location',
				'name'          => esc_html__( 'Office Location', 'inspiry-real-estate' ),
				'desc'          => esc_html__( 'Drag the marker to point your office location. You can also use the address field above to search for your address.', 'inspiry-real-estate' ),
				'type'          => ( inspiry_has_google_maps_api_key() ? 'map' : 'osm' ),
				'api_key'       => ( inspiry_has_google_maps_api_key() ? $inspiry_map_option['inspiry_google_map_api_key'] : '' ),
				'std'           => '-37.817314,144.955431',
				// 'latitude,longitude[,zoom]' (zoom is optional)
				'style'         => 'width: 95%; height: 400px',
				'address_field' => 'inspiry_map_address',
				'tab'           => 'google-map',
			),
			array(
				'id'         => 'inspiry_map_zoom',
				'type'       => 'slider',
				'name'       => esc_html__( 'Map Zoom Level', 'inspiry-real-estate' ),
				'desc'       => esc_html__( 'Zoom level for resulted map on contact page.', 'inspiry-real-estate' ),
				// jQuery UI slider options. See here http://api.jqueryui.com/slider/
				'js_options' => array(
					'min'  => 6,
					'max'  => 18,
					'step' => 1,
				),
				'std'        => 14,
				'tab'        => 'google-map',
			),
			array(
				'id'   => 'inspiry_address',
				'name' => esc_html__( 'Office Address to Display', 'inspiry-real-estate' ),
				'desc' => esc_html__( 'Given address will be displayed on contact page.', 'inspiry-real-estate' ),
				'type' => 'textarea',
				'tab'  => 'contact-details',
			),
			array(
				'id'   => 'inspiry_phone',
				'name' => esc_html__( 'Phone', 'inspiry-real-estate' ),
				'type' => 'text',
				'tab'  => 'contact-details',
			),
			array(
				'id'   => 'inspiry_mobile',
				'name' => esc_html__( 'Mobile', 'inspiry-real-estate' ),
				'type' => 'text',
				'tab'  => 'contact-details',
			),
			array(
				'id'   => 'inspiry_fax',
				'name' => esc_html__( 'Fax', 'inspiry-real-estate' ),
				'type' => 'text',
				'tab'  => 'contact-details',
			),
			array(
				'id'   => 'inspiry_display_email',
				'name' => esc_html__( 'Email to Display', 'inspiry-real-estate' ),
				'desc' => esc_html__( 'Given email address will be displayed on contact page.', 'inspiry-real-estate' ),
				'type' => 'text',
				'std'  => $admin_email,
				'tab'  => 'contact-details',
			),
			array(
				'id'    => 'inspiry_work_hours',
				'name'  => esc_html__( 'Working Hours', 'inspiry-real-estate' ),
				'type'  => 'text',
				'clone' => true,
				'tab'   => 'contact-details',
			),
			array(
				'id'   => 'inspiry_form_heading',
				'name' => esc_html__( 'Contact Form Heading', 'inspiry-real-estate' ),
				'type' => 'text',
				'std'  => esc_html__( 'Send Us a Message', 'inspiry-real-estate' ),
				'tab'  => 'contact-form',
			),
			array(
				'id'   => 'inspiry_email',
				'name' => esc_html__( 'Contact Form Email', 'inspiry-real-estate' ),
				'desc' => esc_html__( 'Given email address will receive messages from theme based contact form', 'inspiry-real-estate' ),
				'type' => 'text',
				'std'  => $admin_email,
				'tab'  => 'contact-form',
			),
			array(
				'id'   => 'inspiry_contact_form_7',
				'name' => esc_html__( 'Contact Form 7 Shortcode', 'inspiry-real-estate' ),
				'desc' => esc_html__( 'You can provide contact form 7 shortcode, If you want to use a custom form. It will be displayed if above given email address is empty.', 'inspiry-real-estate' ),
				'type' => 'text',
				'std'  => '',
				'tab'  => 'contact-form',
				'size' => 50,
			),
		),
	);

	return apply_filters( 'ire_contact_meta_boxes', $meta_boxes );  // apply a filter before returning meta boxes
}

add_filter( 'rwmb_meta_boxes', 'ire_register_contact_meta_boxes' );
