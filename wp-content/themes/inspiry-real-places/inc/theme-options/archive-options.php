<?php
/*
 * Search Options
 */
global $opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Archives', 'inspiry' ),
    'id'    => 'archives-section',
    'desc'  => esc_html__( 'This section contains options related property post type archive and taxonomy archives pages like property city, property status, property type and property feature.', 'inspiry' ),
    'fields'=> array(

        array(
            'id'       => 'inspiry_archive_module_below_header',
            'type'     => 'button_set',
            'title'    => esc_html__( 'What to Display Below Header on Archive Pages', 'inspiry' ),
            'options'  => array(
                'banner'        => esc_html__( 'Image Banner', 'inspiry' ),
                'google-map'    => esc_html__( 'Google Map', 'inspiry' ),
            ),
            'default'  => 'google-map',
        ),
        array(
            'id'       => 'inspiry_archive_properties_number',
            'type'     => 'select',
            'title'    => esc_html__( 'Number of Properties on an Archive Page', 'inspiry' ),
            'options'  => array(
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
                6 => '6',
                7 => '7',
                8 => '8',
                9 => '9',
                10 => '10',
            ),
            'default'  => 6,
            'select2'  => array( 'allowClear' => false ),
        ),
        array(
            'id'       => 'inspiry_archive_layout',
            'type'     => 'select',
            'title'    => esc_html__( 'Archive Page Layout', 'inspiry' ),
            'options'  => array(
                'list'     => esc_html__( 'List Layout - Full Width', 'inspiry' ),
                'grid'     => esc_html__( 'Grid Layout - Full Width', 'inspiry' ),
            ),
            'default'  => 'list',
            'select2'  => array( 'allowClear' => false ),
        ),
        array(
            'id'       => 'inspiry_archive_order',
            'type'     => 'select',
            'title'    => esc_html__( 'Default Order of Properties on an Archive Page.', 'inspiry' ),
            'options'  => array(
                'price-asc'     => esc_html__( 'Sort by Price Low to High', 'inspiry' ),
                'price-desc'    => esc_html__( 'Sort by Price High to Low', 'inspiry' ),
                'date-asc'      => esc_html__( 'Sort by Date Old to New', 'inspiry' ),
                'date-desc'     => esc_html__( 'Sort by Date New to Old', 'inspiry' ),
            ),
            'default'  => 'date-desc',
            'select2'  => array( 'allowClear' => false ),
        ),

    ) ) );