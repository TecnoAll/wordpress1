<?php
if ( ! function_exists( 'inspiry_generate_dynamic_css' ) ) {
	/**
	 * Generate dynamic css
	 */
	function inspiry_generate_dynamic_css( $realplaces_custom_css ) {

		global $inspiry_options;

		$dynamic_css                  = array();
		$dynamic_css_min_width_1200px = array();

		$header_variation = $inspiry_options['inspiry_header_variation'];

		/*
		 * HEADER VARIATION ONE
		 */

		if ( $header_variation == 1 ) {

			$menu_button_bg                = $inspiry_options['inspiry_menu_button_bg'];
			$menu_button_text              = $inspiry_options['inspiry_menu_button_txt'];
			$main_menu_close               = $inspiry_options['inspiry_main_menu_close'];
			$header_phone_icon             = $inspiry_options['inspiry_header_phone_icon'];
			$header_search_toggle_btn      = $inspiry_options['inspiry_header_search_toggle_btn'];
			$header_search_toggle_btn_icon = $inspiry_options['inspiry_header_search_toggle_btn_icon'];
			$header_search_btn_bg          = $inspiry_options['inspiry_header_search_btn_bg'];

			// Display Menu Button or Not?
			if ( $inspiry_options['inspiry_keep_menu_visible'] == '1' ) {
				$dynamic_css[] = array(
					'elements' => '.button-menu-reveal',
					'property' => 'display',
					'value'    => 'none !important'
				);
				$dynamic_css[] = array(
					'elements' => '.site-main-nav',
					'property' => 'display',
					'value'    => 'block !important'
				);
			}

			// Menu button
			$dynamic_css[] = array(
				'elements' => '.button-menu-reveal, .button-menu-reveal.active',
				'property' => 'background-color',
				'value'    => $menu_button_bg['regular']
			);
			$dynamic_css[] = array(
				'elements' => '.button-menu-reveal:hover',
				'property' => 'background-color',
				'value'    => $menu_button_bg['hover']
			);
			$dynamic_css[] = array(
				'elements' => '.button-menu-reveal',
				'property' => 'color',
				'value'    => $menu_button_text['regular']
			);
			$dynamic_css[] = array(
				'elements' => '.button-menu-reveal:hover',
				'property' => 'color',
				'value'    => $menu_button_text['hover']
			);

			// Menu Close Button
			$dynamic_css[] = array(
				'elements' => '.button-menu-close',
				'property' => 'background-color',
				'value'    => $main_menu_close['regular']
			);
			$dynamic_css[] = array(
				'elements' => '.button-menu-close:hover',
				'property' => 'background-color',
				'value'    => $main_menu_close['hover']
			);

			// Header phone icon - header variation one
			$dynamic_css[] = array(
				'elements' => '.contact-number .contacts-icon-container .contacts-icon',
				'property' => 'fill',
				'value'    => $header_phone_icon,
			);

			// Search Fields Collapse & Expand Button
			$dynamic_css[] = array(
				'elements' => '.hidden-fields-reveal-btn',
				'property' => 'background-color',
				'value'    => $header_search_toggle_btn['regular']
			);
			$dynamic_css[] = array(
				'elements' => '.hidden-fields-reveal-btn:hover',
				'property' => 'background-color',
				'value'    => $header_search_toggle_btn['hover']
			);
			$dynamic_css[] = array(
				'elements' => '.hidden-fields-reveal-btn .icon-plus-container g',
				'property' => 'fill',
				'value'    => $header_search_toggle_btn_icon['regular']
			);
			$dynamic_css[] = array(
				'elements' => '.hidden-fields-reveal-btn:hover .icon-plus-container g, .hidden-fields-reveal-btn:hover .icon',
				'property' => 'fill',
				'value'    => $header_search_toggle_btn_icon['hover']
			);

			// search button
			$dynamic_css[] = array(
				'elements' => '.header-advance-search .form-submit-btn',
				'property' => 'background-color',
				'value'    => $header_search_btn_bg['regular']
			);
			$dynamic_css[] = array(
				'elements' => '.header-advance-search .form-submit-btn:hover',
				'property' => 'background-color',
				'value'    => $header_search_btn_bg['hover']
			);

		} elseif ( $header_variation == 2 ) {

			$header_border_color    = $inspiry_options['inspiry_2nd_header_border_color'];
			$header_submit_btn_bg   = $inspiry_options['inspiry_2nd_header_submit_btn_bg'];
			$header_submit_btn_text = $inspiry_options['inspiry_2nd_header_submit_btn_text'];
			$header_phone_icon      = $inspiry_options['inspiry_2nd_header_phone_icon'];

			// header border color
			$dynamic_css_min_width_1200px[] = array(
				'elements' => '.header-variation-two .header-social-nav .fab',
				'property' => 'border-color',
				'value'    => $header_border_color,
			);

			// submit button
			$dynamic_css_min_width_1200px[] = array(
				'elements' => '.header-variation-two .submit-property-link',
				'property' => 'background-color',
				'value'    => $header_submit_btn_bg['regular'],
			);
			$dynamic_css_min_width_1200px[] = array(
				'elements' => '.header-variation-two .submit-property-link:hover',
				'property' => 'background-color',
				'value'    => $header_submit_btn_bg['hover'],
			);
			$dynamic_css_min_width_1200px[] = array(
				'elements' => '.header-variation-two .submit-property-link',
				'property' => 'color',
				'value'    => $header_submit_btn_text['regular'],
			);
			$dynamic_css_min_width_1200px[] = array(
				'elements' => '.header-variation-two .submit-property-link:hover',
				'property' => 'color',
				'value'    => $header_submit_btn_text['hover'],
			);

			// Header phone icon
			$dynamic_css[] = array(
				'elements' => '.contact-number .contacts-icon-container .contacts-icon',
				'property' => 'fill',
				'value'    => $header_phone_icon,
			);

		} elseif ( $header_variation == 3 ) {

			$inspiry_3rd_header_user_nav   = $inspiry_options['inspiry_3rd_header_user_nav'];
			$inspiry_3rd_header_phone_icon = $inspiry_options['inspiry_3rd_header_phone_icon'];

			// SVG color in User Nav
			$dynamic_css[] = array(
				'elements' => '.header-variation-three .icon-email-two,
                                 .header-variation-three .icon-lock',
				'property' => 'fill',
				'value'    => $inspiry_3rd_header_user_nav['regular'],
			);

			$dynamic_css[] = array(
				'elements' => '.header-variation-three .user-nav a:hover .icon-email-two,
                                 .header-variation-three .user-nav a:hover .icon-lock',
				'property' => 'fill',
				'value'    => $inspiry_3rd_header_user_nav['hover'],
			);

			// Header phone icon
			$dynamic_css[] = array(
				'elements' => '.header-variation-three .icon-phone-two',
				'property' => 'fill',
				'value'    => $inspiry_3rd_header_phone_icon,
			);
		}


		/*
		 * SLIDER VARIATION ONE
		 */

		$inspiry_slider_type = $inspiry_options['inspiry_slider_type'];

		if ( $inspiry_slider_type == 'properties-slider' || $inspiry_slider_type == 'properties-slider-two' ) {

			$inspiry_slide_status_tag_background       = $inspiry_options['inspiry_slide_status_tag_background'];
			$inspiry_slide_status_tag_hover_background = $inspiry_options['inspiry_slide_status_tag_hover_background'];
			$inspiry_slide_meta_icon_color             = $inspiry_options['inspiry_slide_meta_icon_color'];

			$dynamic_css[] = array(
				'elements' => '.slide-overlay .property-status-tag:before',
				'property' => 'border-right-color',
				'value'    => $inspiry_slide_status_tag_background,
			);

			$dynamic_css[] = array(
				'elements' => '.slide-overlay .property-status-tag:hover:before',
				'property' => 'border-right-color',
				'value'    => $inspiry_slide_status_tag_hover_background,
			);

			// Property Meta Icons Color
			$dynamic_css[] = array(
				'elements' => '.slide-overlay .meta-icon',
				'property' => 'fill',
				'value'    => $inspiry_slide_meta_icon_color,
			);

		} elseif ( $inspiry_slider_type == 'properties-slider-three' ) {

			$inspiry_3rd_slider_status_tag_background       = $inspiry_options['inspiry_3rd_slider_status_tag_background'];
			$inspiry_3rd_slider_status_tag_hover_background = $inspiry_options['inspiry_3rd_slider_status_tag_hover_background'];

			$dynamic_css[] = array(
				'elements' => '.slide-overlay .property-status-tag:before',
				'property' => 'border-right-color',
				'value'    => $inspiry_3rd_slider_status_tag_background,
			);

			$dynamic_css[] = array(
				'elements' => '.slide-overlay .property-status-tag:hover:before',
				'property' => 'border-right-color',
				'value'    => $inspiry_3rd_slider_status_tag_hover_background,
			);
		}


		/*
		 * HOME PROPERTIES
		 */

		$inspiry_home_properties_variation = 1;

		if ( isset ( $inspiry_options['inspiry_home_properties_variation'] ) ) {
			$inspiry_home_properties_variation = $inspiry_options['inspiry_home_properties_variation'];
		}

		if ( $inspiry_home_properties_variation == 1 ) {

			$inspiry_hp_1_pd_1_status_tag_background       = $inspiry_options['inspiry_hp_1_pd_1_status_tag_background'];
			$inspiry_hp_1_pd_1_status_tag_hover_background = $inspiry_options['inspiry_hp_1_pd_1_status_tag_hover_background'];
			$inspiry_hp_1_pd_1_meta_icon_color             = $inspiry_options['inspiry_hp_1_pd_1_meta_icon_color'];
			$inspiry_hp_1_pd_2_status_tag_background       = $inspiry_options['inspiry_hp_1_pd_2_status_tag_background'];
			$inspiry_hp_1_pd_2_status_tag_hover_background = $inspiry_options['inspiry_hp_1_pd_2_status_tag_hover_background'];
			$inspiry_hp_1_pd_2_meta_icon_color             = $inspiry_options['inspiry_hp_1_pd_2_meta_icon_color'];

			// Home Properties One - Property Design One
			$dynamic_css[] = array(
				'elements' => '
                    .row-odd .property-post-odd .property-status-tag:before,
                    .row-even .property-post-even .property-status-tag:before',
				'property' => 'border-right-color',
				'value'    => $inspiry_hp_1_pd_1_status_tag_background,
			);

			$dynamic_css[] = array(
				'elements' => '
                    .row-odd .property-post-odd .property-status-tag:hover:before,
                    .row-even .property-post-even .property-status-tag:hover:before',
				'property' => 'border-right-color',
				'value'    => $inspiry_hp_1_pd_1_status_tag_hover_background,
			);

			// Property Meta Icons Color
			$dynamic_css[] = array(
				'elements' => '
                    .row-odd .property-post-odd .meta-icon,
                    .row-even .property-post-even .meta-icon',
				'property' => 'fill',
				'value'    => $inspiry_hp_1_pd_1_meta_icon_color,
			);


			// Home Properties One - Property Design Two
			$dynamic_css[] = array(
				'elements' => '
                    .row-odd .property-post-even .property-status-tag:before,
                    .row-even .property-post-odd .property-status-tag:before',
				'property' => 'border-right-color',
				'value'    => $inspiry_hp_1_pd_2_status_tag_background,
			);

			$dynamic_css[] = array(
				'elements' => '
                    .row-odd .property-post-even .property-status-tag:hover:before,
                    .row-even .property-post-odd .property-status-tag:hover:before',
				'property' => 'border-right-color',
				'value'    => $inspiry_hp_1_pd_2_status_tag_hover_background,
			);

			// Property Meta Icons Color
			$dynamic_css[] = array(
				'elements' => '
                    .row-odd .property-post-even .meta-icon,
                    .row-even .property-post-odd .meta-icon',
				'property' => 'fill',
				'value'    => $inspiry_hp_1_pd_2_meta_icon_color,
			);

		} elseif ( $inspiry_home_properties_variation == 2 ) {

			$inspiry_hp_2_status_tag_background       = $inspiry_options['inspiry_hp_2_status_tag_background'];
			$inspiry_hp_2_status_tag_hover_background = $inspiry_options['inspiry_hp_2_status_tag_hover_background'];
			$inspiry_hp_2_meta_icon_color             = $inspiry_options['inspiry_hp_2_meta_icon_color'];


			$dynamic_css[] = array(
				'elements' => '.property-listing-two .property-status-tag:before',
				'property' => 'border-right-color',
				'value'    => $inspiry_hp_2_status_tag_background,
			);

			$dynamic_css[] = array(
				'elements' => '.property-listing-two .property-status-tag:hover:before',
				'property' => 'border-right-color',
				'value'    => $inspiry_hp_2_status_tag_hover_background,
			);

			// Property Meta Icons Color
			$dynamic_css[] = array(
				'elements' => '.property-listing-two .property-meta .meta-icon',
				'property' => 'fill',
				'value'    => $inspiry_hp_2_meta_icon_color,
			);

		}

		/*
		 * Featured PROPERTIES
		 */

		$inspiry_home_featured_variation = $inspiry_options['inspiry_home_featured_variation'];

		if ( $inspiry_home_featured_variation == 1 ) {

			$inspiry_fp_1_status_tag_background       = $inspiry_options['inspiry_fp_1_status_tag_background'];
			$inspiry_fp_1_status_tag_hover_background = $inspiry_options['inspiry_fp_1_status_tag_hover_background'];

			$dynamic_css[] = array(
				'elements' => '.featured-properties-one .property-status-tag:before',
				'property' => 'border-right-color',
				'value'    => $inspiry_fp_1_status_tag_background,
			);

			$dynamic_css[] = array(
				'elements' => '.featured-properties-one .property-status-tag:hover:before',
				'property' => 'border-right-color',
				'value'    => $inspiry_fp_1_status_tag_hover_background,
			);

		} elseif ( $inspiry_home_featured_variation == 2 ) {

			$inspiry_fp_2_status_tag_background       = $inspiry_options['inspiry_fp_2_status_tag_background'];
			$inspiry_fp_2_status_tag_hover_background = $inspiry_options['inspiry_fp_2_status_tag_hover_background'];
			$inspiry_fp_2_meta_icon_color             = $inspiry_options['inspiry_fp_2_meta_icon_color'];

			$dynamic_css[] = array(
				'elements' => '.featured-properties-two .property-status-tag:before',
				'property' => 'border-right-color',
				'value'    => $inspiry_fp_2_status_tag_background,
			);

			$dynamic_css[] = array(
				'elements' => '.featured-properties-two .property-status-tag:hover:before',
				'property' => 'border-right-color',
				'value'    => $inspiry_fp_2_status_tag_hover_background,
			);

			// Property Meta Icons Color
			$dynamic_css[] = array(
				'elements' => '.featured-properties-two .meta-icon',
				'property' => 'fill',
				'value'    => $inspiry_fp_2_meta_icon_color,
			);
		}

		/**
		 * Property Details PAGE
		 */

		$inspiry_property_details_heading_color                         = $inspiry_options['inspiry_property_details_heading_color'];
		$inspiry_property_details_price_color                           = $inspiry_options['inspiry_property_details_price_color'];
		$inspiry_property_details_meta_color                            = $inspiry_options['inspiry_property_details_meta_color'];
		$inspiry_property_details_agent_background                      = $inspiry_options['inspiry_property_details_agent_background'];
		$inspiry_property_details_agent_meta_color                      = $inspiry_options['inspiry_property_details_agent_meta_color'];
		$inspiry_property_details_agent_social_info_color               = $inspiry_options['inspiry_property_details_agent_social_info_color'];
		$inspiry_property_details_agent_social_heading_color            = $inspiry_options['inspiry_property_details_agent_social_heading_color'];
		$inspiry_property_details_agent_section_button_text_color       = $inspiry_options['inspiry_property_details_agent_section_button_text_color'];
		$inspiry_property_details_agent_section_button_text_hover_color = $inspiry_options['inspiry_property_details_agent_section_button_text_hover_color'];
		$inspiry_property_details_agent_section_button_color            = $inspiry_options['inspiry_property_details_agent_section_button_color'];
		$inspiry_property_details_agent_section_button_hover_color      = $inspiry_options['inspiry_property_details_agent_section_button_hover_color'];

		$dynamic_css[] = array(
			'elements' => '.single-property .fancy-title',
			'property' => 'color',
			'value'    => $inspiry_property_details_heading_color,
		);
		$dynamic_css[] = array(
			'elements' => '.single-property-price',
			'property' => 'color',
			'value'    => $inspiry_property_details_price_color,
		);
		$dynamic_css[] = array(
			'elements' => '.single-property .meta-icon',
			'property' => 'fill',
			'value'    => $inspiry_property_details_meta_color,
		);
		$dynamic_css[] = array(
			'elements' => '.single-property .property-title-wrapper .favorite-and-print .fa',
			'property' => 'color',
			'value'    => $inspiry_property_details_meta_color,
		);
		$dynamic_css[] = array(
			'elements' => '.single-property .agent-post-even, .agent-single-post .agent-content-wrapper, .single-property .agent-sidebar-widget',
			'property' => 'background-color',
			'value'    => $inspiry_property_details_agent_background,
		);
		$dynamic_css[] = array(
			'elements' => '.single-property .agent-social-profiles a, .single-property .agent-name span',
			'property' => 'color',
			'value'    => $inspiry_property_details_agent_meta_color,
		);
		$dynamic_css[] = array(
			'elements' => '.single-property .agent-contacts-list .contacts-icon',
			'property' => 'fill',
			'value'    => $inspiry_property_details_agent_meta_color,
		);
		$dynamic_css[] = array(
			'elements' => '.single-property .agent-common-styles .agent-contacts-list span',
			'property' => 'color',
			'value'    => $inspiry_property_details_agent_social_heading_color,
		);
		$dynamic_css[] = array(
			'elements' => '.single-property .agent-common-styles p, .single-property .agent-common-styles .agent-contacts-list > li',
			'property' => 'color',
			'value'    => $inspiry_property_details_agent_social_info_color,
		);
		$dynamic_css[] = array(
			'elements' => '.single-property .agent-post-even .btn-default, .single-property .agent-sidebar-widget .btn-default',
			'property' => 'color',
			'value'    => $inspiry_property_details_agent_section_button_text_color,
		);
		$dynamic_css[] = array(
			'elements' => '.single-property .agent-post-even .btn-default:hover, .single-property .agent-sidebar-widget .btn-default:hover',
			'property' => 'color',
			'value'    => $inspiry_property_details_agent_section_button_text_hover_color,
		);
		$dynamic_css[] = array(
			'elements' => '.single-property .agent-post-even .btn-default, .single-property .agent-sidebar-widget .btn-default',
			'property' => 'background-color',
			'value'    => $inspiry_property_details_agent_section_button_color,
		);
		$dynamic_css[] = array(
			'elements' => '.single-property .agent-post-even .btn-default:hover, .single-property .agent-sidebar-widget .btn-default:hover',
			'property' => 'background-color',
			'value'    => $inspiry_property_details_agent_section_button_hover_color,
		);

		/*
		 * SCROLL TO TOP
		 */

		$inspiry_scroll_to_top_bg_color   = $inspiry_options['inspiry_scroll_to_top_bg_color'];
		$inspiry_scroll_to_top_icon_color = $inspiry_options['inspiry_scroll_to_top_icon_color'];

		$dynamic_css[] = array(
			'elements' => '#scroll-top',
			'property' => 'background-color',
			'value'    => $inspiry_scroll_to_top_bg_color['regular'],
		);

		$dynamic_css[] = array(
			'elements' => '#scroll-top:hover',
			'property' => 'background-color',
			'value'    => $inspiry_scroll_to_top_bg_color['hover'],
		);

		$dynamic_css[] = array(
			'elements' => '#scroll-top:active',
			'property' => 'background-color',
			'value'    => $inspiry_scroll_to_top_bg_color['active'],
		);

		$dynamic_css[] = array(
			'elements' => '#scroll-top i',
			'property' => 'color',
			'value'    => $inspiry_scroll_to_top_icon_color['regular'],
		);

		$dynamic_css[] = array(
			'elements' => '#scroll-top:hover i',
			'property' => 'color',
			'value'    => $inspiry_scroll_to_top_icon_color['hover'],
		);

		$dynamic_css[] = array(
			'elements' => '#scroll-top:active i',
			'property' => 'color',
			'value'    => $inspiry_scroll_to_top_icon_color['active'],
		);

		// Start generating if related arrays are populated
		if ( count( $dynamic_css ) > 0 || count( $dynamic_css_min_width_1200px ) > 0 ) {

			// Basic dynamic CSS
			if ( count( $dynamic_css ) > 0 ) {
				foreach ( $dynamic_css as $css_unit ) {
					if ( ! empty( $css_unit['value'] ) ) {
						$realplaces_custom_css .= strip_tags( $css_unit['elements'] . " { " . $css_unit['property'] . " : " . $css_unit['value'] . ";" . " }\n" );
					}
				}
			}

			// CSS for min width of 1200px
			if ( count( $dynamic_css_min_width_1200px ) > 0 ) {
				$realplaces_custom_css .= "@media (min-width: 1200px) {\n";
				foreach ( $dynamic_css_min_width_1200px as $css_unit ) {
					if ( ! empty( $css_unit['value'] ) ) {
						$realplaces_custom_css .= strip_tags( $css_unit['elements'] . " { " . $css_unit['property'] . " : " . $css_unit['value'] . ";" . " }\n" );
					}
				}
				$realplaces_custom_css .= "}\n";
			}
		}

		return $realplaces_custom_css;
	}
}

if ( ! is_admin() ) {
	add_filter( 'realplaces_custom_css', 'inspiry_generate_dynamic_css' );
}