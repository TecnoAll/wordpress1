<?php
/*
 * Footer Options
 */
global $opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Footer', 'inspiry' ),
    'id'    => 'footer-section',
    'desc'  => esc_html__( 'This section contains options for footer.', 'inspiry' ),
    'fields'=> array(

        array(
            'id'       => 'inspiry_footer_logo',
            'type'     => 'media',
            'url'      => false,
            'title'    => esc_html__( 'Footer Logo', 'inspiry' ),
            'subtitle' => esc_html__( 'Upload footer logo.', 'inspiry' ),
        ),
        array(
            'id'           => 'inspiry_copyright_html',
            'type'         => 'textarea',
            'title'        => esc_html__( 'Footer Copyright Text', 'inspiry' ),
            'desc'         => esc_html__( 'Allowed html tags are a, br, em and strong.', 'inspiry' ),
            'validate'     => 'html_custom',
            'default'      => sprintf( '&copy; Copyright 2020 All rights reserved by <a href="%1$s" target="_blank" rel="nofollow">Inspiry Themes</a>', esc_url( 'http://themeforest.net/user/InspiryThemes' ) ),
            'allowed_html' => array(
                'a'      => array(
                    'href'  => array(),
                    'title' => array(),
                    'target' => array(),
                ),
                'br'     => array(),
                'em'     => array(),
                'strong' => array()
            ), //see http://codex.wordpress.org/Function_Reference/wp_kses
        ),

    ) ) );