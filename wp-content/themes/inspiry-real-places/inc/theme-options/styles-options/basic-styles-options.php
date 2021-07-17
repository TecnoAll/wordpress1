<?php
/*
 * Basic Styles Options
 */
global $opt_name;

Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Basic', 'inspiry'),
    'id'    => 'basic-styles',
    'desc'  => esc_html__('This sub section contains basic styles options.', 'inspiry' ),
    'subsection' => true,
    'fields'=> array(

        array(
            'id'        => 'inspiry_body_background',
            'type'      => 'background',
            'output'    => array( 'body', '.site-pages' ),
            'title'     => esc_html__( 'Main Background', 'inspiry' ),
            'subtitle'  => esc_html__( 'Configure body background of your choice. ( default:#eff1f5 )', 'inspiry' ),
            'default'   => '#eff1f5'
        ),
        array(
            'id'        => 'inspiry_change_font',
            'type'      => 'switch',
            'title'     => esc_html__( 'Do you want to change fonts?', 'inspiry' ),
            'default'   => '0',
            'on'    => esc_html__( 'Yes', 'inspiry' ),
            'off'   => esc_html__( 'No', 'inspiry' )
        ),
        array(
            'id'        => 'inspiry_headings_font',
            'type'      => 'typography',
            'title'     => esc_html__( 'Headings Font', 'inspiry' ),
            'subtitle'  => esc_html__( 'Select the font for headings.', 'inspiry' ),
            'desc'      => esc_html__( 'Varela Round is default font.', 'inspiry' ),
            'required'  => array( 'inspiry_change_font', '=', '1' ),
            'google'    => true,
            'font-style'    => false,
            'font-weight'   => false,
            'font-size'     => false,
            'line-height'   => false,
            'color'         => false,
            'text-align'    => false,
            'output'        => array( 'h1','h2','h3','h4','h5','h6', '.h1','.h2','.h3','.h4','.h5','.h6' ),
            'default'       => array(
                'font-family' => 'Varela Round',
                'google'      => true
            )
        ),
        array(
            'id'        => 'inspiry_body_font',
            'type'      => 'typography',
            'title'     => esc_html__( 'Text Font', 'inspiry' ),
            'subtitle'  => esc_html__( 'Select the font for body text.', 'inspiry' ),
            'desc'      => esc_html__( 'Varela Round is default font.', 'inspiry' ),
            'required'  => array( 'inspiry_change_font', '=', '1' ),
            'google'    => true,
            'font-style'    => false,
            'font-weight'   => false,
            'font-size'     => false,
            'line-height'   => false,
            'color'         => false,
            'text-align'    => false,
            'output'        => array( 'body' ),
            'default'       => array(
                'font-family' => 'Varela Round',
                'google'      => true
            )
        ),
        array(
            'id'        => 'inspiry_headings_color',
            'type'      => 'color',
            'output'    => array( 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6' ),
            'title'     => esc_html__( 'Headings Color', 'inspiry' ),
            'default'   => '#4a525d',
            'validate'  => 'color',
            'transparent' => false,
            'desc'  => 'default: #4a525d',
        ),
        array(
            'id'        => 'inspiry_text_color',
            'type'      => 'color',
            'transparent' => false,
            'output'    => array( 'body' ),
            'title'     => esc_html__( 'Text Color', 'inspiry' ),
            'desc'  => 'default: #4a525d',
            'default'   => '#4a525d',
            'validate'  => 'color'
        ),
        array(
            'id'        => 'inspiry_blockquote_color',
            'type'      => 'color',
            'output'    => array( 'blockquote', 'blockquote p' ),
            'title'     => esc_html__('Quote Text Color', 'inspiry'),
            'default'   => '#4a525d',
            'validate'  => 'color',
            'transparent' => false,
            'desc'  => 'default: #4a525d',
        ),
        array(
            'id'        => 'inspiry_link_color',
            'type'      => 'link_color',
            'title'     => esc_html__( 'Link Color', 'inspiry' ),
            'active'    => true,
            'output'    => array( 'a' ),
            'default'   => array(
                'regular' => '#191c20',
                'hover'   => '#0dbae8',
                'active'  => '#0dbae8',
            )
        ),
        array(
            'id'        => 'inspiry_content_link_color',
            'type'      => 'link_color',
            'title'     => esc_html__( 'Link Color in Page and Post Contents', 'inspiry' ),
            'active'    => true,
            'output'    => array( '.default-page .entry-content a' ),
            'default'   => array(
                'regular' => '#0dbae8',
                'hover'   => '#ff8000',
                'active'  => '#ff8000',
            )
        ),
        array(
            'id'        => 'inspiry_animation',
            'type'      => 'switch',
            'title'     => esc_html__('Animation', 'inspiry'),
            'desc'     => esc_html__('You can enable or disable CSS3 animation on various components.', 'inspiry'),
            'default'   => 1,
            'on'        => esc_html__('Enable','inspiry'),
            'off'       => esc_html__('Disable','inspiry'),
        ),
        array(
            'id'        => 'inspiry_scroll_to_top_bg_color',
            'type'      => 'link_color',
            'title'     => esc_html__( 'Background Color of Scroll to Top', 'inspiry' ),
            'default'   => array(
                'regular' => '#3CCBF5',
                'hover'   => '#0dbae8',
                'active'  => '#0dbae8',
            )
        ),
        array(
            'id'        => 'inspiry_scroll_to_top_icon_color',
            'type'      => 'link_color',
            'title'     => esc_html__( 'Icon Color of Scroll to Top', 'inspiry' ),
            'default'   => array(
                'regular' => '#ffffff',
                'hover'   => '#ffffff',
                'active'  => '#ffffff',
            )
        ),
        array(
            'id'        => 'inspiry_quick_css',
            'type'      => 'ace_editor',
            'title'     => esc_html__( 'Quick CSS', 'inspiry' ),
            'desc'      => esc_html__( 'You can use this box for some quick css changes. For big changes, Use the custom.css file in css folder. In case of child theme please use style.css file in child theme.', 'inspiry' ),
            'mode'      => 'css',
            'theme'     => 'monokai'
        )

    ) ) );