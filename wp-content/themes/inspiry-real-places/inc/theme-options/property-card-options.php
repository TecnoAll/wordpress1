<?php
/*
 * Footer Options
 */
global $opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Property Card', 'inspiry' ),
    'id'    => 'property-card-section',
    'desc'  => esc_html__( 'This section contains options for property card displayed in various pages across the theme.', 'inspiry' ),
    'fields'=> array(

        array(
            'id'       => 'inspiry_property_card_gallery',
            'type'     => 'switch',
            'title'    => esc_html__( 'Display images gallery for property card in list and grid layout', 'inspiry' ),
            'subtitle' => esc_html__( 'This option has performance implications.', 'inspiry' ),
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'inspiry_property_card_gallery_limit',
            'type'     => 'select',
            'title'    => esc_html__( 'Maximum number of images allowed in property card gallery.', 'inspiry' ),
            'options'  => array(
                1  => '1',
                2  => '2',
                3  => '3',
                4  => '4',
                5  => '5',
            ),
            'default'  => 3,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_property_card_gallery', '=', '1' ),
        ),
        array(
            'id'        => 'inspiry_property_card_desc_title',
            'type'      => 'text',
            'title'     => esc_html__( 'Description title for property card in list layout', 'inspiry' ),
            'default'   => esc_html__( 'Description', 'inspiry' ),
        ),
        array(
            'id'        => 'inspiry_property_card_price_title',
            'type'      => 'text',
            'title'     => esc_html__( 'Price title for property card in list layout', 'inspiry' ),
            'default'   => esc_html__( 'Price', 'inspiry' ),
        ),
        array(
            'id'        => 'inspiry_property_card_button_text',
            'type'      => 'text',
            'title'     => esc_html__( 'Button text for property card in list layout', 'inspiry' ),
            'default'   => esc_html__( 'Show Details', 'inspiry' ),
        ),

    ) ) );