<?php
/*
 * GDPR Options
 */
global $opt_name;
Redux::setSection( $opt_name, array(
		'title'  => esc_html__( 'GDPR', 'inspiry' ),
		'desc'   => esc_html__( 'This section contains GDPR related settings.', 'inspiry' ),
		'fields' => array(
			array(
				'id'      => 'gdpr_label_text',
				'type'    => 'text',
				'title'   => esc_html__( 'GDPR Agreement Checkbox Label', 'inspiry' ),
				'default' => esc_html__( 'GDPR Agreement', 'inspiry' ),
			),
			array(
				'id'      => 'gdpr_text',
				'type'    => 'textarea',
				'title'   => esc_html__( 'GDPR Agreement Checkbox Text', 'inspiry' ),
				'default' => esc_html__( 'I consent to having this website store my submitted information so they can respond to my inquiry.', 'inspiry' ),
				'desc'    => esc_html__( 'You can use strong, em and a tags in agreement text.', 'inspiry' ),
			),
			array(
				'id'      => 'gdpr_validation_message',
				'type'    => 'text',
				'title'   => esc_html__( 'GDPR Agreement Validation Message', 'inspiry' ),
				'default' => esc_html__( '* Please accept GDPR Agreement', 'inspiry' ),
			),
			array(
				'id'      => 'gdpr_contact_form',
				'type'    => 'switch',
				'title'   => esc_html__( 'GDPR checkbox for Contact Form', 'inspiry' ),
				'default' => '0',
				'on'      => esc_html__( 'Enable', 'inspiry' ),
				'off'     => esc_html__( 'Disable', 'inspiry' ),
			),
			array(
				'id'      => 'gdpr_agent_contact_form',
				'type'    => 'switch',
				'title'   => esc_html__( 'GDPR checkbox for Agent Contact Form', 'inspiry' ),
				'default' => '0',
				'on'      => esc_html__( 'Enable', 'inspiry' ),
				'off'     => esc_html__( 'Disable', 'inspiry' ),
			),
		)
	)
);