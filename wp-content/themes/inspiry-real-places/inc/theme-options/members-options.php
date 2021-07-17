<?php
/*
 * Members Options
 */
global $opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Members', 'inspiry' ),
    'id'    => 'memebers-section',
    'desc'  => esc_html__( 'This section contains options related to registered users.', 'inspiry' ),
    'fields'=> array(

        array(
            'id'       => 'inspiry_header_user_nav',
            'type'     => 'switch',
            'title'    => esc_html__( 'User Navigation in Header', 'inspiry' ),
            'default'  => 1,
            'on'       => esc_html__( 'Show', 'inspiry' ),
            'off'      => esc_html__( 'Hide', 'inspiry' ),
        ),
	    array(
		    'id'      => 'inspiry_header_user_nav_favourites',
		    'type'    => 'text',
		    'title'   => esc_html__( 'Label For "Favourite" ', 'inspiry' ),
		    'default' => 'Favourite',
		    'required' => array( 'inspiry_header_user_nav', '=', '1' )
	    ),
	    array(
		    'id'      => 'inspiry_header_user_nav_logout',
		    'type'    => 'text',
		    'title'   => esc_html__( 'Label For "Logout" ', 'inspiry' ),
		    'default' => 'Logout',
		    'required' => array( 'inspiry_header_user_nav', '=', '1' )
	    ),
	    array(
		    'id'      => 'inspiry_header_user_nav_profile',
		    'type'    => 'text',
		    'title'   => esc_html__( 'Label For "Profile" ', 'inspiry' ),
		    'default' => 'Profile',
		    'required' => array( 'inspiry_header_user_nav', '=', '1' )
	    ),
	    array(
		    'id'      => 'inspiry_header_user_nav_properties',
		    'type'    => 'text',
		    'title'   => esc_html__( 'Label For "My Properties" ', 'inspiry' ),
		    'default' => 'My Properties',
		    'required' => array( 'inspiry_header_user_nav', '=', '1' )
	    ),
	    array(
		    'id'      => 'inspiry_header_user_nav_submit',
		    'type'    => 'text',
		    'title'   => esc_html__( 'Label For "Submit" ', 'inspiry' ),
		    'default' => 'Submit',
		    'required' => array( 'inspiry_header_user_nav', '=', '1' )
		),
		array(
			'id'       => 'inspiry_submit_for_registered_only',
			'type'     => 'switch',
			'title'    => esc_html__( 'Display Submit button for Registered Users only', 'inspiry' ),
			'desc'     => esc_html__( 'Do you want to display the submit property link for registered members only?', 'inspiry' ),
			'default'  => 1,
			'on'      => esc_html__( 'Yes', 'inspiry' ),
			'off'       => esc_html__( 'No', 'inspiry' ),
		),
        array(
            'id'       => 'inspiry_restricted_level',
            'type'     => 'radio',
            'title'    => esc_html__( 'Restrict Admin Access', 'inspiry' ),
            "desc"     => esc_html__( 'Restrict admin access to any user level equal to or below the selected user level.', 'inspiry' ),
            'options'  => array(
                '0' => esc_html__( 'Subscriber ( Level 0 )', 'inspiry' ),
                '1' => esc_html__( 'Contributor ( Level 1 )', 'inspiry' ),
                '2' => esc_html__( 'Author ( Level 2 )', 'inspiry' ),
                // '7' => esc_html__( 'Editor ( Level 7 )', 'inspiry' ),
            ),
            'default'  => '0',
        ),

        /*
         * Commented out this as I have change the approach to register by sending password as part of email during registration.
        array(
            'id'       => 'ire_new_user_notification',
            'type'     => 'switch',
            'title'    => esc_html__( 'Registration Email Notification to Admin and Newly Registered User', 'inspiry' ),
            'default'  => 1,
            'on'       => esc_html__('Enabled', 'inspiry'),
            'off'      => esc_html__('Disabled', 'inspiry'),
        ),
        */

        /*
         * Profile Page
         */
        array(
            'id'       => 'inspiry_edit_profile_page',
            'type'     => 'select',
            'data'     => 'pages',
            'title'    => esc_html__( 'Edit Profile Page', 'inspiry' ),
            'desc'     => esc_html__( 'Make sure the selected page is using Edit Profile template.', 'inspiry' ),
        ),


        /*
         * Favorites Page
         */
        array(
            'id'       => 'inspiry_favorites_page',
            'type'     => 'select',
            'data'     => 'pages',
            'title'    => esc_html__( 'Favorites Page', 'inspiry' ),
            'subtitle' => esc_html__( 'Select a page to display favorite properties.', 'inspiry' ),
            'desc'     => esc_html__( 'Make sure the selected page is using Favorites template.', 'inspiry' ),
        ),
        array(
            'id'       => 'inspiry_favorites_properties_number',
            'type'     => 'select',
            'title'    => esc_html__( 'Number of Properties on Favorites Page', 'inspiry' ),
            'options'  => array(
                3 => '3',
                6 => '6',
                9 => '9',
                12 => '12',
                15 => '15',
            ),
            'default'  => 6,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_favorites_page', '>', '0' )
        ),


        /*
         * Properties Page
         */
        array(
            'id'       => 'inspiry_my_properties_page',
            'type'     => 'select',
            'data'     => 'pages',
            'title'    => esc_html__( 'My Properties Page', 'inspiry' ),
            'desc'     => esc_html__( 'Make sure the selected page is using My Properties template.', 'inspiry' ),
        ),
        array(
            'id'       => 'inspiry_my_properties_number',
            'type'     => 'select',
            'title'    => esc_html__( 'Number of Properties on My Properties Page', 'inspiry' ),
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
            'default'  => 5,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_my_properties_page', '>', '0' )
        ),


        /*
         * Submit Property
         */
        array(
            'id'       => 'inspiry_submit_property_page',
            'type'     => 'select',
            'data'     => 'pages',
            'title'    => esc_html__( 'Submit Property Page', 'inspiry' ),
            'desc'     => esc_html__( 'Make sure the selected page is using Submit Property template.', 'inspiry' ),
        ),
        array(
            'id'       => 'inspiry_default_submit_status',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Default Status of Submitted Property', 'inspiry' ),
            'options'  => array(
                'pending' => esc_html__( 'Pending for Review', 'inspiry' ),
                'publish' => esc_html__( 'Publish', 'inspiry' ),
            ),
            'default'  => 'pending',
            'required' => array( 'inspiry_submit_property_page', '>', '0' )
        ),
        array(
            'id'       => 'inspiry_submit_address',
            'type'     => 'text',
            'title'    => esc_html__( 'Default Address for Property Submit Form', 'inspiry' ),
            'default'  => '15421 Southwest 39th Terrace, Miami, FL 33185, USA',
            'required' => array( 'inspiry_submit_property_page', '>', '0' )
        ),
        array(
            'id'       => 'inspiry_submit_location_coordinates',
            'type'     => 'text',
            'title'    => esc_html__( 'Default Location Coordinates for Property Submit Map', 'inspiry' ),
            'desc'     => sprintf ( 'You can use <a href="%1$s" target="_blank">latlong.net</a> or <a href="%2$s" target="_blank">itouchmap.com</a> to get Latitude and longitude of your desired location.', esc_url( 'http://www.latlong.net/' ), esc_url( 'http://itouchmap.com/latlong.html' ) ),
            'default'  => '25.7308309,-80.44414899999998',
            'required' => array( 'inspiry_submit_property_page', '>', '0' )
        ),
        array(
            'id'       => 'inspiry_submit_notice_email',
            'type'     => 'text',
            'title'    => esc_html__( 'Email for Property Submit Notice', 'inspiry' ),
            'desc'     => esc_html__( 'This email address will receive a notice whenever a user submits a property.', 'inspiry' ),
            'validate' => 'email',
            'required' => array( 'inspiry_submit_property_page', '>', '0' )
        ),
        array(
            'id'       => 'inspiry_submit_message_to_reviewer',
            'type'     => 'switch',
            'title'    => esc_html__( 'Message for Reviewer on Property Submit Form', 'inspiry' ),
            'default'  => 0,
            'on'       => esc_html__('Enabled', 'inspiry'),
            'off'      => esc_html__('Disabled', 'inspiry'),
            'required' => array(
                array( 'inspiry_submit_property_page', '>', '0' ),
                array( 'inspiry_submit_notice_email', '!=', '' ),
            ),
        ),

        array(
            'id'       => 'inspiry_auto_generate_property_id',
            'type'     => 'switch',
            'title'    => esc_html__( 'Auto-Generate Property ID', 'inspiry' ),
            'default'  => 0,
            'on'       => esc_html__('Enabled', 'inspiry'),
            'off'      => esc_html__('Disabled', 'inspiry'),
            'required' => array(
                array( 'inspiry_submit_property_page', '>', '0' ),
            ),
        ),

        array(
            'id'       => 'inspiry_auto_generate_id_pattern',
            'type'     => 'text',
            'default' => 'RP-{ID}-property',
            'title'    => esc_html__( 'Auto-Generated Property ID Pattern', 'inspiry' ),
            'desc'     => esc_html__( 'Please use {ID} in your pattern as it will be replaced by the Property ID.', 'inspiry' ),
            'validate' => 'not_empty',
            'required' => array( 'inspiry_auto_generate_property_id', '>', '0' )
        ),


    ) ) );

Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Property Submit', 'inspiry'),
    'id'    => 'property-submit-options',
    'desc'  => esc_html__('This section contains Property Submit related options.', 'inspiry'),
    'subsection' => true,
    'fields' => array(
        array(
            'id'      => 'inspiry_property_address_field',
            'type'    => 'switch',
            'title'   => esc_html__('Address Field', 'inspiry'),
            'on'      => esc_html__('Show', 'inspiry'),
            'off'     => esc_html__('Hide', 'inspiry'),
            'default'  => 1,
        ),

	    array(
		    'id'      => 'inspiry_property_desc_field',
		    'type'    => 'switch',
		    'title'   => esc_html__('Property Description Field', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),

	    array(
		    'id'      => 'inspiry_property_type_field',
		    'type'    => 'switch',
		    'title'   => esc_html__('Type Field', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),

	    array(
		    'id'      => 'inspiry_property_location_field',
		    'type'    => 'switch',
		    'title'   => esc_html__('Location Field', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),

	    array(
		    'id'      => 'inspiry_property_status_field',
		    'type'    => 'switch',
		    'title'   => esc_html__('Status Field', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),

	    array(
		    'id'      => 'inspiry_property_bedrooms_field',
		    'type'    => 'switch',
		    'title'   => esc_html__('Bedrooms Field', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),

	    array(
		    'id'      => 'inspiry_property_bathrooms_field',
		    'type'    => 'switch',
		    'title'   => esc_html__('Bathrooms Field', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),

	    array(
		    'id'      => 'inspiry_property_garages_field',
		    'type'    => 'switch',
		    'title'   => esc_html__('Garages Field', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),

	    array(
		    'id'      => 'inspiry_property_sale_or_rent_field',
		    'type'    => 'switch',
		    'title'   => esc_html__('Sale OR Rent Price Field', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),

	    array(
		    'id'      => 'inspiry_property_price_postfix_field',
		    'type'    => 'switch',
		    'title'   => esc_html__('Price Postfix Text Field', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),

	        array(
		    'id'      => 'inspiry_property_area_field',
		    'type'    => 'switch',
		    'title'   => esc_html__('Area Field', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),

	        array(
		    'id'      => 'inspiry_property_post_prefix_field',
		    'type'    => 'switch',
		    'title'   => esc_html__('Area Postfix Text Field', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),


	    array(
		    'id'      => 'inspiry_property_id_field',
		    'type'    => 'switch',
		    'title'   => esc_html__('Property ID Field', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),

	    array(
		    'id'      => 'inspiry_property_virtual_tour_url_field',
		    'type'    => 'switch',
		    'title'   => esc_html__('Property Video URL Field', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),

	    array(
		    'id'      => 'inspiry_property_year_built_field',
		    'type'    => 'switch',
		    'title'   => esc_html__('Year Built Field', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),

	    array(
		    'id'      => 'inspiry_property_parent_field',
		    'type'    => 'switch',
		    'title'   => esc_html__('Parent Property Field', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),

	    array(
		    'id'      => 'inspiry_property_virtual_tour_url_360_field',
		    'type'    => 'switch',
		    'title'   => esc_html__('Virtual Tour Embed Code Field', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),


	    array(
		    'id'      => 'inspiry_property_drag_image_box_field',
		    'type'    => 'switch',
		    'title'   => esc_html__('Drag And Drop Image Box Field', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),



	    array(
		    'id'      => 'inspiry_property_agent_information_option_field',
		    'type'    => 'switch',
		    'title'   => esc_html__('Agent Information Option Field ', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),


	    array(
		    'id'      => 'inspiry_property_mark_as_feature_checkbox',
		    'type'    => 'switch',
		    'title'   => esc_html__('Mark As Featured Property Checkbox', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),

	    array(
		    'id'      => 'inspiry_property_features_field',
		    'type'    => 'switch',
		    'title'   => esc_html__('Features Field', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),

	    array(
		    'id'      => 'inspiry_property_additional_details_field',
		    'type'    => 'switch',
		    'title'   => esc_html__('Additional Details Field', 'inspiry'),
		    'on'      => esc_html__('Show', 'inspiry'),
		    'off'     => esc_html__('Hide', 'inspiry'),
		    'default'  => 1,
	    ),


    ),
));