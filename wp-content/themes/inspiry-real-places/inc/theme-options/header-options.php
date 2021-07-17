<?php
/*
 * Header Options
 */
global $opt_name;
Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Header', 'inspiry' ),
	'id'     => 'header-section',
	'desc'   => esc_html__( 'This section contains options for header.', 'inspiry' ),
	'fields' => array(

		array(
			'id'       => 'inspiry_header_variation',
			'type'     => 'image_select',
			'title'    => esc_html__( 'Header Design Variation', 'inspiry' ),
			'subtitle' => esc_html__( 'Select the design variation that you want to use for site header.', 'inspiry' ),
			'options'  => array(
				'1' => array(
					'title' => esc_html__( '1st Variation', 'inspiry' ),
					'img'   => get_template_directory_uri() . '/inc/theme-options/images/header-variation-1.png',
				),
				'2' => array(
					'title' => esc_html__( '2nd Variation', 'inspiry' ),
					'img'   => get_template_directory_uri() . '/inc/theme-options/images/header-variation-2.png',
				),
				'3' => array(
					'title' => esc_html__( '3rd Variation', 'inspiry' ),
					'img'   => get_template_directory_uri() . '/inc/theme-options/images/header-variation-3.png',
				)
			),
			'default'  => '1',
		),
		array(
			'id'      => 'inspiry_sticky_header',
			'type'    => 'switch',
			'title'   => esc_html__( 'Sticky Header', 'inspiry' ),
			'desc'    => esc_html__( 'This feature only works above 992px screen size.', 'inspiry' ),
			'default' => 0,
			'on'      => esc_html__( 'Enable', 'inspiry' ),
			'off'     => esc_html__( 'Disable', 'inspiry' ),
		),
		array(
			'id'       => 'inspiry_keep_menu_visible',
			'type'     => 'switch',
			'title'    => esc_html__( 'Keep the Menu Visible?', 'inspiry' ),
			'desc'     => esc_html__( 'Do you want to keep the menu visible and disable the menu button?', 'inspiry' ),
			'default'  => 0,
			'on'      => esc_html__( 'Yes', 'inspiry' ),
			'off'       => esc_html__( 'No', 'inspiry' ),
			'required' => array( 'inspiry_header_variation', '=', '1' ),
		),
		array(
			'id'       => 'inspiry_header_menu_title',
			'type'     => 'text',
			'title'    => esc_html__( 'Menu Button Title', 'inspiry' ),
			'default'  => esc_html__( 'Menu', 'inspiry' ),
			'required' => array( 'inspiry_header_variation', '=', '1' ),
		),
		array(
			'id'       => 'inspiry_logo',
			'type'     => 'media',
			'url'      => false,
			'title'    => esc_html__( 'Logo', 'inspiry' ),
			'subtitle' => esc_html__( 'Upload logo image for your Website. Otherwise site title will be displayed in place of logo.', 'inspiry' ),
		),
		array(
			'id'       => 'inspiry_header_email',
			'type'     => 'text',
			'title'    => esc_html__( 'Email Address', 'inspiry' ),
			'default'  => '',
			'validate' => 'email',
			'required' => array( 'inspiry_header_variation', '=', '3' ),
		),
		array(
			'id'      => 'inspiry_header_phone',
			'type'    => 'text',
			'title'   => esc_html__( 'Phone Number', 'inspiry' ),
			'default' => '',
		),
		array(
			'id'       => 'inspiry_banner_image',
			'type'     => 'media',
			'url'      => false,
			'title'    => esc_html__( 'Banner Image', 'inspiry' ),
			'desc'     => esc_html__( 'Banner image should have minimum width of 2000px and minimum height of 320px.', 'inspiry' ),
			'subtitle' => esc_html__( 'This banner image will be displayed on all the pages where banner image is not overridden by page specific banner settings.', 'inspiry' ),
		),
		array(
			'id'       => 'inspiry_display_wpml_flags',
			'type'     => 'switch',
			'title'    => esc_html__( 'WPML/POLYLANG Language Switcher Flags', 'inspiry' ),
			'subtitle' => esc_html__( 'Do you want to display WPML or POLYLANG language switcher flags in header top bar ?', 'inspiry' ),
			'desc'     => esc_html__( 'This option only works if WPML or POLYLANG plugin is installed and activated.', 'inspiry' ),
			'default'  => 1,
			'on'       => esc_html__( 'Display', 'inspiry' ),
			'off'      => esc_html__( 'Hide', 'inspiry' ),
		),
		array(
			'id'      => 'inspiry_page_loader',
			'type'    => 'switch',
			'title'   => esc_html__( 'Page Loader', 'inspiry' ),
			'desc'    => esc_html__( 'You can enable or disable page loader.', 'inspiry' ),
			'default' => false,
			'on'      => esc_html__( 'Enable', 'inspiry' ),
			'off'     => esc_html__( 'Disable', 'inspiry' ),
		),
		array(
			'id'       => 'inspiry_page_loader_gif',
			'type'     => 'media',
			'url'      => false,
			'title'    => esc_html__( 'Page Loader Gif', 'inspiry' ),
			'desc'     => esc_html__( 'You can upload your page loader gif here or default one will be displayed.', 'inspiry' ),
			'required' => array( 'inspiry_page_loader', '=', '1' ),
		),
		array(
			'id'    => 'inspiry_quick_js',
			'type'  => 'ace_editor',
			'title' => esc_html__( 'Quick JavaScript', 'inspiry' ),
			'desc'  => esc_html__( 'You can paste your JavaScript code here.', 'inspiry' ),
			'mode'  => 'javascript',
			'theme' => 'chrome',
		),

	)
) );

if ( class_exists( 'WP_Currencies' ) ) {

	$currency_codes = array();

	if ( function_exists( 'get_currencies' ) ) {
		$currencies     = get_currencies();
		if ( 0 < count( $currencies ) ) {
			foreach ( $currencies as $currency_code => $currency ) {
				$currency_codes[ $currency_code ] = $currency['name'];
			}
		}
	}

	Redux::setSection( $opt_name, array(
		'title'      => esc_html__( 'Currency Switcher', 'inspiry' ),
		'id'         => 'currency-switcher-section',
		'desc'       => esc_html__( 'This section contains currency switch related options.', 'inspiry' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'theme_base_currency',
				'title'   => esc_html__( 'Base Currency', 'inspiry' ),
				'type'    => 'select',
				'default' => 'USD',
				'options' => $currency_codes,
				'select2' => array( 'allowClear' => false ),
				'desc'    => esc_html__( 'Selected currency will be used as base currency for all conversions. You can find full list of supported currencies at <a target="_blank" href="https://openexchangerates.org/currencies">https://openexchangerates.org/currencies</a>', 'inspiry' ),

			),

			array(
				'id'      => 'theme_supported_currencies',
				'title'   => esc_html__( 'Currencies You Want to Support', 'inspiry' ),
				'type'    => 'textarea',
				'default' => "AUD,CAD,CHF,EUR,GBP,HKD,JPY,NOK,SEK,USD",
				'desc'    => esc_html__( 'Only provide comma separated list of currency codes in capital letters. Do not add dashes, spaces or currency signs.', 'inspiry' ),

			),

			array(
				'id'      => 'theme_currency_expiry',
				'title'   => esc_html__( 'Expiry Period for Switched Currency', 'inspiry' ),
				'type'    => 'select',
				'default' => '604800',
				'options' => array(
					'3600'     => esc_html__( 'One Hour', 'inspiry' ),
					'86400'    => esc_html__( 'One Day', 'inspiry' ),
					'604800'   => esc_html__( 'One Week', 'inspiry' ),
					'18144000' => esc_html__( 'One Month', 'inspiry' ),
				),
				'select2' => array( 'allowClear' => false ),

			),

		),

	) );
}
