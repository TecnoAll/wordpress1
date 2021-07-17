<?php
/*
 * Misc Options
 */
global $opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Misc', 'inspiry' ),
    'id'    => 'misc-section',
    'desc'  => esc_html__( 'This section contains options related to various features across the theme.', 'inspiry' ),
    'fields'=> array(
        array(
            'id' => 'inspiry_agent_cc_email',
            'type' => 'text',
            'title' => esc_html__( 'CC Email Address for Messages to Agents', 'inspiry' ),
            'subtitle' => esc_html__( 'Given email address will receive a carbon copy of every message sent to any agent.', 'inspiry' ),
            'desc' => esc_html__( 'You can provide multiple email addresses separated with comma.', 'inspiry' ),
        ),
	    array(
		    'id' => 'inspiry_agent_bcc_email',
		    'type' => 'text',
		    'title' => esc_html__( 'BCC Email Address for Messages to Agents', 'inspiry' ),
		    'subtitle' => esc_html__( 'Given email address will receive a blind carbon copy of every message sent to any agent.', 'inspiry' ),
		    'desc' => esc_html__( 'You can provide multiple email addresses separated with comma.', 'inspiry' ),
	    ),
	    array(
		    'id'       => 'inspiry_single_property_nav',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Link to Previous and Next Property ', 'inspiry' ),
		    'default'  => 1,
		    'on'       => esc_html__( 'Enable', 'inspiry' ),
		    'off'      => esc_html__( 'Disable', 'inspiry' ),
	    ),
	    array(
		    'id'       => 'inspiry_single_posts_nav',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Link to Previous and Next Post ', 'inspiry' ),
		    'default'  => 1,
		    'on'       => esc_html__( 'Enable', 'inspiry' ),
		    'off'      => esc_html__( 'Disable', 'inspiry' ),
	    ),
    ) ) );