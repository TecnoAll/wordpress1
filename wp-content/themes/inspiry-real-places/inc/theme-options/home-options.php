<?php
/*
 * Home Options
 */
global $opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__('Home', 'inspiry'),
    'id'    => 'home-section',
    'desc'  => esc_html__('This section contains options for homepage.', 'inspiry'),
    'fields'=> array(
        array(
            'id'       => 'inspiry_home_module_below_header',
            'type'     => 'button_set',
            'title'    => esc_html__( 'What to display below header', 'inspiry' ),
            'options'  => array(
                'banner'        => esc_html__( 'Image Banner', 'inspiry' ),
                'google-map'    => esc_html__( 'Google Map', 'inspiry' ),
                'slider'        => esc_html__( 'Slider', 'inspiry' ),
            ),
            'default'  => 'slider',
        ),
        array(
            'id'       => 'inspiry_slider_type',
            'type'     => 'select',
            'title'    => esc_html__( 'Select the type of slider', 'inspiry' ),
            'options'  => array(
                'properties-slider'     => esc_html__( 'Properties Slider', 'inspiry' ),
                'properties-slider-two' => esc_html__( 'Properties Slider Two', 'inspiry' ),
                'properties-slider-three' => esc_html__( 'Properties Slider Three', 'inspiry' ),
                'revolution-slider'     => esc_html__( 'Revolution Slider', 'inspiry' ),
            ),
            'default'  => 'properties-slider',
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_home_module_below_header', '=', 'slider' ),
        ),
        array(
            'id'       => 'inspiry_home_slides_number',
            'type'     => 'select',
            'title'    => esc_html__( 'Number of slides to display', 'inspiry' ),
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
                11 => '11',
                12 => '12',
                13 => '13',
                14 => '14',
                15 => '15',
            ),
            'default'  => 3,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_slider_type', '=', array( 'properties-slider', 'properties-slider-two', 'properties-slider-three' ) ),
        ),
        array(
            'id'       => 'inspiry_slide_button_text',
            'type'     => 'text',
            'title'    => esc_html__( 'Slider Button Text', 'inspiry' ),
            'default'  => esc_html__( 'More Details', 'inspiry' ),
            'required' => array( 'inspiry_slider_type', '=', array( 'properties-slider-two', 'properties-slider-three' ) ),
        ),
        array(
            'id'        => 'inspiry_revolution_slider_alias',
            'type'      => 'text',
            'title'     => esc_html__( 'Revolution Slider Alias', 'inspiry' ),
            'required'  => array( 'inspiry_slider_type', '=', array( 'revolution-slider' ) )
        ),

    ) ) );

/*
 * Layout Sub Section
 */
Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Layout', 'inspiry'),
    'id'    => 'layout-section',
    'desc'  => esc_html__('This section contains homepage layout related options.', 'inspiry'),
    'subsection' => true,
    'fields'=> array(
        array(
            'id'       => 'inspiry_home_sections_width',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Home sections width', 'inspiry' ),
            'subtitle' => esc_html__( 'Some section can appear in full width.', 'inspiry' ),
            'options'  => array(
                'boxed'   => esc_html__( 'Keep Boxed', 'inspiry' ),
                'wide'    => esc_html__( 'Allow Full Width', 'inspiry' ),
            ),
            'default'  => 'wide',
        ),
        array(
            'id'       => 'inspiry_home_search',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Search Form', 'inspiry' ),
            'desc'     => esc_html__( 'The 1st header variation already includes it, So this applies only with other header variations.', 'inspiry' ),
            'default'  => 0,
            'on'       => esc_html__( 'Show', 'inspiry' ),
            'off'      => esc_html__( 'Hide', 'inspiry' ),
            'required' => array( 'inspiry_header_variation', '=', array( '2', '3' ) ),
        ),
        array(
            'id'      => 'inspiry_home_sections',
            'type'    => 'sorter',
            'title'   => esc_html__('Homepage layout manager', 'inspiry'),
            'desc'    => esc_html__('Organize homepage sections in the way you want them to appear.', 'inspiry'),
            'options' => array(
                'enabled'  => array(
                    'content'       => esc_html__( 'Page Contents', 'inspiry' ),
                ),
                'disabled' => array(
                    'properties'    => esc_html__( 'Properties', 'inspiry' ),
                    'featured'      => esc_html__( 'Featured', 'inspiry' ),
                    'how-it-works'  => esc_html__( 'How It Works', 'inspiry' ),
                    'partners'      => esc_html__( 'Partners', 'inspiry' ),
                    'news'          => esc_html__( 'News', 'inspiry' ),
                ),
            )
        ),
    ) ) );


if ( class_exists( 'Inspiry_Real_Estate' ) ) {

/*
 * Properties Sub Section
 */
Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Properties', 'inspiry'),
    'id'    => 'properties-section',
    'desc'  => esc_html__('This section contains homepage properties related options.', 'inspiry'),
    'subsection' => true,
    'fields'=> array(

        array(
            'id'        => 'inspiry_home_properties_variation',
            'type'      => 'image_select',
            'title'     => esc_html__( 'Properties design variation', 'inspiry' ),
            'subtitle'  => esc_html__( 'Select the design variation that you want to use for homepage properties.', 'inspiry' ),
            'options'   => array(
                '1' => array(
                    'title' => esc_html__('1st Variation', 'inspiry'),
                    'img' => get_template_directory_uri() . '/inc/theme-options/images/properties-variation-1.png',
                ),
                '2' => array(
                    'title' => esc_html__('2nd Variation', 'inspiry'),
                    'img' => get_template_directory_uri() . '/inc/theme-options/images/properties-variation-2.png',
                ),
                '3' => array(
                    'title' => esc_html__('3rd Variation', 'inspiry'),
                    'img' => get_template_directory_uri() . '/inc/theme-options/images/properties-variation-3.png',
                ),
                '4' => array(
                    'title' => esc_html__('4th Variation', 'inspiry'),
                    'img' => get_template_directory_uri() . '/inc/theme-options/images/properties-variation-4.png',
                )
            ),
            'default'   => '1',
        ),
        array(
            'id'       => 'inspiry_home_properties_number_1',
            'type'     => 'select',
            'title'    => esc_html__( 'Number of properties to display', 'inspiry' ),
            'options'  => array(
                2  => '2',
                4  => '4',
                6  => '6',
                8  => '8',
                10 => '10',
                12 => '12',
            ),
            'default'  => 4,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_home_properties_variation', '=', '1' ),
        ),
        array(
            'id'       => 'inspiry_home_properties_gallery',
            'type'     => 'switch',
            'title'    => esc_html__( 'Multiple Photos', 'inspiry' ),
            'subtitle' => esc_html__( '* This can slow website performance', 'inspiry' ),
            'desc'     => esc_html__( 'Each property can display multiple photos sliding over each other', 'inspiry' ),
            'default'  => 0,
            'on'       => esc_html__('Enabled', 'inspiry'),
            'off'      => esc_html__('Disabled', 'inspiry'),
            'required' => array( 'inspiry_home_properties_variation', '=', '1' ),
        ),
        array(
            'id'       => 'inspiry_home_properties_gallery_limit',
            'type'     => 'select',
            'title'    => esc_html__( 'Max number of photos', 'inspiry' ),
            'options'  => array(
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ),
            'default'  => 3,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_home_properties_gallery', '=', '1' ),
        ),
        array(
            'id'       => 'inspiry_home_properties_number_2',
            'type'     => 'select',
            'title'    => esc_html__( 'Number of properties to display', 'inspiry' ),
            'options'  => array(
                4  => '4',
                8  => '8',
                12 => '12',
                16 => '16',
                20 => '20',
            ),
            'default'  => 8,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_home_properties_variation', '=', '2' ),
        ),
        array(
            'id'       => 'inspiry_welcome_title',
            'type'     => 'text',
            'title'    => esc_html__( 'Welcome Board Title', 'inspiry' ),
            'default'  => esc_html__( 'We are Offering the Best Real Estate Deals', 'inspiry' ),
            'required' => array( 'inspiry_home_properties_variation', '=', '3' ),
        ),
        array(
            'id'           => 'inspiry_welcome_text',
            'type'         => 'textarea',
            'title'        => esc_html__( 'Welcome Board Text', 'inspiry' ),
            'desc'         => esc_html__( 'Following html tags are allowed: a, br, em and strong.', 'inspiry' ),
            'validate'     => 'html_custom',
            'default'      => '',
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
            'required' => array( 'inspiry_home_properties_variation', '=', '3' ),
        ),
        array(
            'id'       => 'inspiry_home_properties_number_3',
            'type'     => 'select',
            'title'    => esc_html__( 'Number of properties to display', 'inspiry' ),
            'options'  => array(
                3  => '3',
                6  => '6',
                9  => '9',
                12 => '12',
                15 => '15',
            ),
            'default'  => 3,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_home_properties_variation', '=', '3' ),
        ),
        array(
            'id'       => 'inspiry_home_properties_number_4',
            'type'     => 'select',
            'title'    => esc_html__( 'Number of properties to display', 'inspiry' ),
            'options'  => array(
                3  => '3',
                6  => '6',
                9  => '9',
                12 => '12',
                15 => '15',
            ),
            'default'  => 3,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_home_properties_variation', '=', '4' ),
        ),
        array(
            'id'       => 'inspiry_home_properties_order',
            'type'     => 'select',
            'title'    => esc_html__( 'Sort Order', 'inspiry' ),
            'options'  => array(
                'price-asc'     => esc_html__( 'Sort by Price Low to High', 'inspiry' ),
                'price-desc'    => esc_html__( 'Sort by Price High to Low', 'inspiry' ),
                'date-asc'      => esc_html__( 'Sort by Date Old to New', 'inspiry' ),
                'date-desc'     => esc_html__( 'Sort by Date New to Old', 'inspiry' ),
            ),
            'default'  => 'date-desc',
            'select2'  => array( 'allowClear' => false ),
        ),
        array(
            'id'       => 'inspiry_home_properties_kind',
            'type'     => 'radio',
            'title'    => esc_html__( 'Select the kind of properties you want to display', 'inspiry' ),
            'options'  => array(
                'default'   => esc_html__( 'Default ( No Filtration )', 'inspiry' ),
                'random'  => esc_html__( 'Random', 'inspiry' ),
                'featured'  => esc_html__( 'Featured', 'inspiry' ),
                'selection' => esc_html__( 'Based on my selection of Locations, Statuses and Types.', 'inspiry' ),
            ),
            'default'  => 'default'
        ),
        array(
            'id'       => 'inspiry_home_exclude_featured',
            'type'     => 'checkbox',
            'title'    => esc_html__('Exclude Featured Properties?', 'inspiry'),
            'desc'     => esc_html__('Check this option if you want to exclude Featured Properties from Recent Properties on Homepage .', 'inspiry'),
            'default'  => '0',// 1 = on | 0 = off
            'required' => array( 'inspiry_home_properties_kind', '=', 'default' ),

        ),
        array(
            'id'    =>'inspiry_home_properties_locations',
            'type'  => 'select',
            'title' => esc_html__( 'Locations', 'inspiry' ),
            'multi' => true,
            'data'  => 'terms',
            'args'  => array(
                'taxonomies' => 'property-city',
                'args' => array()
            ),
            'required' => array( 'inspiry_home_properties_kind', '=', 'selection' ),
        ),
        array(
            'id'    =>'inspiry_home_properties_statuses',
            'type'  => 'select',
            'title' => esc_html__( 'Statuses', 'inspiry' ),
            'multi' => true,
            'data'  => 'terms',
            'args'  => array(
                'taxonomies' => 'property-status',
                'args' => array()
            ),
            'required' => array( 'inspiry_home_properties_kind', '=', 'selection' ),
        ),
        array(
            'id'    =>'inspiry_home_properties_types',
            'type'  => 'select',
            'title' => esc_html__( 'Types', 'inspiry' ),
            'multi' => true,
            'data'  => 'terms',
            'args'  => array(
                'taxonomies' => 'property-type',
                'args' => array()
            ),
            'required' => array( 'inspiry_home_properties_kind', '=', 'selection' ),
        ),

    ) ) );

}


/*
 * How it Works Sub Section
 */
Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'How it Works', 'inspiry'),
    'id'    => 'how-it-works-section',
    'desc'  => esc_html__('This section contains options related to "How It Works" section.', 'inspiry'),
    'subsection' => true,
    'fields'=> array(

        array(
            'id'       => 'inspiry_hiw_welcome',
            'type'     => 'text',
            'title'    => esc_html__( 'Welcome Text', 'inspiry' ),
            'default'  => esc_html__( 'Welcome', 'inspiry' ),
        ),
        array(
            'id'       => 'inspiry_hiw_title',
            'type'     => 'text',
            'title'    => esc_html__( 'Title', 'inspiry' ),
            'default'  => esc_html__( 'An Awesome title', 'inspiry' ),
        ),
        array(
            'id'           => 'inspiry_hiw_description',
            'type'         => 'textarea',
            'title'        => esc_html__( 'Description', 'inspiry' ),
            'desc'         => esc_html__( 'Following html tags are allowed: a, br, em and strong.', 'inspiry' ),
            'validate'     => 'html_custom',
            'default'      => '',
            'allowed_html' => array(
                'a'      => array(
                    'href'  => array(),
                    'title' => array()
                ),
                'br'     => array(),
                'em'     => array(),
                'strong' => array(),
            )
        ),
        array(
            'id'        => 'inspiry_hiw_section_bg',
            'type'      => 'switch',
            'title'     => esc_html__('Background Image', 'inspiry'),
            'default'   => 1,
            'on'        => esc_html__('Enable','inspiry'),
            'off'       => esc_html__('Disable','inspiry'),
        ),
        array(
            'id'       => 'inspiry_hiw_bg_image',
            'type'     => 'media',
            'url'      => false,
            'title'    => '',
            'desc' => esc_html__( 'Provide a background image for "How it Works" section.', 'inspiry' ),
            'compiler' => 'true',
            'required' => array( 'inspiry_hiw_section_bg', '=', '1' ),
        ),
        array(
            'id'       => 'inspiry_hiw_columns',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Number of Columns', 'inspiry' ),
            'desc' => esc_html__( 'Choose the number of columns to display below basic introduction on "How it Works" section.', 'inspiry' ),
            'options'  => array(
                '0' => esc_html__('None', 'inspiry'),
                '1' => esc_html__('1 Column', 'inspiry'),
                '2' => esc_html__('2 Columns', 'inspiry'),
                '3' => esc_html__('3 Columns', 'inspiry'),
            ),
            'default'  => '3',
        ),
        array(
            'id'       => 'inspiry_hiw_column_alignment',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Content alignment in a column', 'inspiry' ),
            'options'  => array(
                'left' => esc_html__('Left', 'inspiry'),
                'center' => esc_html__('Center', 'inspiry'),
            ),
            'default'  => 'left',
            'required' => array( 'inspiry_hiw_columns', '=', array( '1', '2', '3' ) ),
        ),

        /*
         * 1st Column
         */
        array(
            'id'       => 'inspiry_hiw_1st_col_icon',
            'type'     => 'media',
            'url'      => true,
            'title'    => esc_html__( '1st Column Icon', 'inspiry' ),
            'compiler' => 'true',
            'default'  => array( 'url' => get_template_directory_uri() . '/images/register-icon.svg' ),
            'required' => array( 'inspiry_hiw_columns', '=', array( '1', '2', '3' ) ),
        ),
        array(
            'id'       => 'inspiry_hiw_1st_col_title',
            'type'     => 'text',
            'title'    => esc_html__( '1st Column Title', 'inspiry' ),
            'default'  => esc_html__( 'Register', 'inspiry' ),
            'required' => array( 'inspiry_hiw_columns', '=', array( '1', '2', '3' ) ),
        ),
        array(
            'id'           => 'inspiry_hiw_1st_col_description',
            'type'         => 'textarea',
            'title'        => esc_html__( '1st Column Description', 'inspiry' ),
            'desc'         => esc_html__( 'Following html tags are allowed: a, br, em and strong.', 'inspiry' ),
            'validate'     => 'html_custom',
            'default'      => '',
            'allowed_html' => array(
                'a'      => array(
                    'href'  => array(),
                    'title' => array()
                ),
                'br'     => array(),
                'em'     => array(),
                'strong' => array(),
            ),
            'required' => array( 'inspiry_hiw_columns', '=', array( '1', '2', '3' ) ),
        ),

        /*
         * 2nd Column
         */
        array(
            'id'       => 'inspiry_hiw_2nd_col_icon',
            'type'     => 'media',
            'url'      => true,
            'title'    => esc_html__( '2nd Column Icon', 'inspiry' ),
            'compiler' => 'true',
            'default'  => array( 'url' => get_template_directory_uri() . '/images/fill-details-icon.svg' ),
            'required' => array( 'inspiry_hiw_columns', '=', array( '2', '3' ) ),
        ),
        array(
            'id'       => 'inspiry_hiw_2nd_col_title',
            'type'     => 'text',
            'title'    => esc_html__( '2nd Column Title', 'inspiry' ),
            'default'  => esc_html__( 'Fill Up Property Details', 'inspiry' ),
            'required' => array( 'inspiry_hiw_columns', '=', array( '2', '3' ) ),
        ),
        array(
            'id'           => 'inspiry_hiw_2nd_col_description',
            'type'         => 'textarea',
            'title'        => esc_html__( '2nd Column Description', 'inspiry' ),
            'desc'         => esc_html__( 'Following html tags are allowed: a, br, em and strong.', 'inspiry' ),
            'validate'     => 'html_custom',
            'default'      => '',
            'allowed_html' => array(
                'a'      => array(
                    'href'  => array(),
                    'title' => array()
                ),
                'br'     => array(),
                'em'     => array(),
                'strong' => array(),
            ),
            'required' => array( 'inspiry_hiw_columns', '=', array( '2', '3' ) ),
        ),

        /*
         * 3rd Column
         */
        array(
            'id'       => 'inspiry_hiw_3rd_col_icon',
            'type'     => 'media',
            'url'      => true,
            'title'    => esc_html__( '3rd Column Icon', 'inspiry' ),
            'compiler' => 'true',
            'default'  => array( 'url' => get_template_directory_uri() . '/images/done-icon.svg' ),
            'required' => array( 'inspiry_hiw_columns', '=', array( '3' ) ),
        ),
        array(
            'id'       => 'inspiry_hiw_3rd_col_title',
            'type'     => 'text',
            'title'    => esc_html__( '3rd Column Title', 'inspiry' ),
            'default'  => esc_html__( 'You are Done!', 'inspiry' ),
            'required' => array( 'inspiry_hiw_columns', '=', array( '3' ) ),
        ),
        array(
            'id'           => 'inspiry_hiw_3rd_col_description',
            'type'         => 'textarea',
            'title'        => esc_html__( '3rd Column Description', 'inspiry' ),
            'desc'         => esc_html__( 'Following html tags are allowed: a, br, em and strong.', 'inspiry' ),
            'validate'     => 'html_custom',
            'default'      => '',
            'allowed_html' => array(
                'a'      => array(
                    'href'  => array(),
                    'title' => array()
                ),
                'br'     => array(),
                'em'     => array(),
                'strong' => array(),
            ),
            'required' => array( 'inspiry_hiw_columns', '=', array( '3' ) ),
        ),
        array(
            'id'        => 'inspiry_hiw_submit_button',
            'type'      => 'switch',
            'title'     => esc_html__('Submit Property Button', 'inspiry'),
            'default'   => 1,
            'on'        => esc_html__('Display','inspiry'),
            'off'       => esc_html__('Hide','inspiry'),
        ),
        array(
            'id'       => 'inspiry_hiw_button_text',
            'type'     => 'text',
            'title'    => esc_html__( 'Button Text', 'inspiry' ),
            'default'  => esc_html__( 'Submit Your Property', 'inspiry' ),
            'required' => array( 'inspiry_hiw_submit_button', '=', true ),
        ),
        array(
            'id'       => 'inspiry_hiw_button_url',
            'type'     => 'text',
            'title'    => esc_html__( 'Button Target URL', 'inspiry' ),
            'validate' => 'url',
            'default'  => '',
            'required' => array( 'inspiry_hiw_submit_button', '=', true ),
        ),

    ) ) );

/*
 * Featured properties sub section
 */
Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Featured Properties', 'inspiry'),
    'id'    => 'featured-section',
    'desc'  => esc_html__('This section contains options related to featured properties on homepage.', 'inspiry'),
    'subsection' => true,
    'fields'=> array(

        array(
            'id'        => 'inspiry_home_featured_variation',
            'type'      => 'image_select',
            'title'     => esc_html__( 'Featured properties design variation', 'inspiry' ),
            'subtitle'  => esc_html__( 'Select the design variation that you want to use for featured properties.', 'inspiry' ),
            'options'   => array(
                '1' => array(
                    'title' => esc_html__('1st Variation', 'inspiry'),
                    'img' => get_template_directory_uri() . '/inc/theme-options/images/featured-variation-1.png',
                ),
                '2' => array(
                    'title' => esc_html__('2nd Variation', 'inspiry'),
                    'img' => get_template_directory_uri() . '/inc/theme-options/images/featured-variation-2.png',
                ),
                '3' => array(
                    'title' => esc_html__('3rd Variation', 'inspiry'),
                    'img' => get_template_directory_uri() . '/inc/theme-options/images/featured-variation-3.png',
                ),
            ),
            'default'   => '1',
        ),
        array(
            'id'       => 'inspiry_home_featured_columns',
            'type'     => 'select',
            'title'    => esc_html__( 'Number of columns', 'inspiry' ),
            'options'  => array(
                2  => '2',
                3  => '3',
                4  => '4',
            ),
            'default'  => 4,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_home_featured_variation', '=', array( '1' , '2' )  ),
        ),
        array(
            'id'       => 'inspiry_home_featured_number_1',
            'type'     => 'select',
            'title'    => esc_html__( 'Number of properties', 'inspiry' ),
            'options'  => array(
                2  => '2',
                3  => '3',
                4  => '4',
                6  => '6',
                8  => '8',
                9  => '9',
                10 => '10',
                12 => '12',
            ),
            'default'  => 4,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_home_featured_variation', '=', '1' ),
        ),
        array(
            'id'       => 'inspiry_home_featured_number_2',
            'type'     => 'select',
            'title'    => esc_html__( 'Number of properties', 'inspiry' ),
            'options'  => array(
                2  => '2',
                3  => '3',
                4  => '4',
                6  => '6',
                8  => '8',
                9  => '9',
                10 => '10',
                12 => '12',
            ),
            'default'  => 3,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_home_featured_variation', '=', '2' ),
        ),
        array(
            'id'       => 'inspiry_home_featured_number_3',
            'type'     => 'select',
            'title'    => esc_html__( 'Number of properties', 'inspiry' ),
            'options'  => array(
                2  => '2',
                4  => '4',
                6  => '6',
                8  => '8',
                10 => '10',
                12 => '12',
            ),
            'default'  => 3,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_home_featured_variation', '=', '3' ),
        ),
        array(
            'id'       => 'inspiry_home_featured_title',
            'type'     => 'text',
            'title'    => esc_html__( 'Title', 'inspiry' ),
            'default'  => esc_html__( 'Featured Properties', 'inspiry' ),
            'required' => array( 'inspiry_home_featured_variation', '=', array('1', '2', '3' ) ),
        ),

    ) ) );


/*
 * partners sub section
 */
Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Partners', 'inspiry'),
    'id'    => 'partners-section',
    'desc'  => esc_html__('This section contains options related to partners on homepage.', 'inspiry'),
    'subsection' => true,
    'fields'=> array(
        array(
            'id'       => 'inspiry_home_partners_number',
            'type'     => 'select',
            'title'    => esc_html__( 'Number of partners', 'inspiry' ),
            'options'  => array(
                -1  => 'All',
                1  => '1',
                2  => '2',
                3  => '3',
                4  => '4',
                5  => '5',
                6  => '6',
                7  => '7',
                8  => '8',
                9  => '9',
                10 => '10',
            ),
            'default'  => 5,
            'select2'  => array( 'allowClear' => false ),
        ),
        array(
            'id'           => 'inspiry_home_partners_title',
            'type'         => 'textarea',
            'title'        => esc_html__( 'Partners Title', 'inspiry' ),
            'desc'         => esc_html__( 'You can use span tag to highlight a part of title.', 'inspiry' ),
            'validate'     => 'html_custom',
            'default'      => 'Partners Title <span>With Highlighted</span> Text.',
            'allowed_html' => array(
                'span'     => array(),
            ),
        ),

    ) ) );



/*
 * news sub section
 */
Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'News', 'inspiry'),
    'id'    => 'news-section',
    'desc'  => esc_html__('This section contains options related to news on homepage.', 'inspiry' ),
    'subsection' => true,
    'fields'=> array(
        array(
            'id'       => 'inspiry_home_posts_number',
            'type'     => 'select',
            'title'    => esc_html__( 'Number of posts to display', 'inspiry' ),
            'options'  => array(
                2  => '2',
                3  => '3',
                4  => '4',
                5  => '5',
                6  => '6',
                7  => '7',
                8  => '8',
                9  => '9',
                10 => '10',
            ),
            'default'  => 3,
            'select2'  => array( 'allowClear' => false ),
        ),
        array(
            'id'       => 'inspiry_home_news_title',
            'type'     => 'text',
            'title'    => esc_html__( 'News Title', 'inspiry' ),
            'default'  => esc_html__( 'Latest News', 'inspiry' ),
        ),
        array(
            'id'       => 'inspiry_home_news_type',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Type of News Posts', 'inspiry' ),
            'desc' => esc_html__( 'Choose the type of news posts to display on homepage.', 'inspiry' ),
            'options'  => array(
                'recent' => esc_html__('Recent', 'inspiry'),
                'category' => esc_html__('Based on Categories', 'inspiry'),
                'tag' => esc_html__('Based on Tags', 'inspiry'),
            ),
            'default'  => 'recent',
        ),
        array(
            'id'       => 'inspiry_home_news_category',
            'type'     => 'select',
	        'multi'    => true,
            'data'     => 'categories',
            'title'    => esc_html__( 'Select Categories', 'inspiry' ),
            'required' => array( 'inspiry_home_news_type', '=', 'category' ),
        ),
        array(
            'id'       => 'inspiry_home_news_tag',
            'type'     => 'select',
            'multi'    => true,
            'data'     => 'tags',
            'title'    => esc_html__( 'Select Tags', 'inspiry' ),
            'required' => array( 'inspiry_home_news_type', '=', 'tag' ),
        ),
        array(
            'id'       => 'inspiry_home_news_link_text',
            'type'     => 'text',
            'title'    => esc_html__( 'More Link Text', 'inspiry' ),
            'default'  => esc_html__( 'More', 'inspiry' ),
        ),

    ) ) );
