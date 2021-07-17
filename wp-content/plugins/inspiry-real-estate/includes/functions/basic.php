<?php
/**
 * Get template part for RHEA plugin.
 *
 * @access public
 *
 * @param mixed $slug Template slug.
 * @param string $name Template name (default: '').
 */
function ire_get_template_part( $slug, $name = '' ) {
	$template = '';

	$template_name = "{$slug}.php";
	if ( '' !== $name ) {
		$template_name = "{$slug}-{$name}.php";
	}

	if ( file_exists( STYLESHEETPATH . '/' . $template_name ) ) {           // Try to get from child theme
		$template = STYLESHEETPATH . '/' . $template_name;
	} elseif ( file_exists( TEMPLATEPATH . '/' . $template_name ) ) {       // Try to get from parent theme
		$template = TEMPLATEPATH . '/' . $template_name;
	} elseif ( file_exists( IRE_PLUGIN_DIR . '/' . $template_name ) ) {  // Otherwise get from plugin
		$template = IRE_PLUGIN_DIR . '/' . $template_name;
	}

	// Allow 3rd party plugins to filter template file from their plugin.
	$template = apply_filters( 'ire_get_template_part', $template, $slug, $name );

	if ( $template ) {
		load_template( $template, false );
	}
}


/**
 * Output excerpt for given number of words
 *
 * @param int $len
 * @param string $trim
 */
function ire_excerpt( $len = 15, $trim = "&hellip;" ) {
    echo esc_html( ire_get_excerpt( $len, $trim ) );
}


/**
 * Return excerpt for given number of words.
 *
 * @param int $len
 * @param string $trim
 *
 * @return string
 */
function ire_get_excerpt( $len = 15, $trim = "&hellip;" ) {
    return wp_trim_words( get_the_excerpt(), $len, $trim );
}


/**
 * Output given message for visitor
 *
 * @param string $heading
 * @param string $message
 */
function ire_message( $heading = '', $message = '' ) {

	echo '<div class="inspiry-message">';
	if ( ! empty( $heading ) ) {
		echo '<h3>' . $heading . '</h3>';
	}
	if ( ! empty( $message ) ) {
		echo '<p>' . $message . '</p>';
	}
	echo '</div>';
}


/**
 *  Return true if ID is not set or Show button is selected in Theme Options.
 *  Return false if Hide button is selected in Theme Options.
 *
 * @param $id
 *
 * @return bool
 * @since 1.7.0
 */
function ire_is_displayable( $id ) {

	global $inspiry_options;

	if ( ! isset( $inspiry_options[ $id ] ) || ( $inspiry_options[ $id ] == '1' ) ) {
		return true;
	}

	return false;
}


function ire_paypal_button( $inspiry_options ){

	// Get payment related options
	$paypal_payment_enabled = $inspiry_options[ 'inspiry_payment_via_paypal' ];
	$paypal_ipn_url         = $inspiry_options[ 'inspiry_paypal_ipn_url' ];
	$paypal_merchant_id     = $inspiry_options[ 'inspiry_paypal_merchant_id' ];
	$paypal_sandbox         = $inspiry_options[ 'inspiry_paypal_sandbox' ];
	$paypal_payment_amount  = $inspiry_options[ 'inspiry_paypal_payment_amount' ];
	$paypal_currency_code   = $inspiry_options[ 'inspiry_paypal_currency_code' ];

	if( ( $paypal_payment_enabled )
	    && ( !empty( $paypal_ipn_url ) )
	    && ( !empty( $paypal_merchant_id ) )
	    && ( !empty( $paypal_currency_code ) )
	    && ( !empty( $paypal_payment_amount ) ) ) {

		$paypal_button_script = get_template_directory_uri() . "/js/paypal-button.min.js";
		?>
		<script src="<?php echo esc_url( add_query_arg( array( 'merchant' => $paypal_merchant_id ), $paypal_button_script ) ); ?>"
		        <?php if( $paypal_sandbox ){ ?>data-env="sandbox"<?php } ?>
		        data-callback="<?php echo esc_url( $paypal_ipn_url ); ?>"
		        data-tax="0"
		        data-shipping="0"
		        data-currency="<?php echo esc_attr( $paypal_currency_code ); ?>"
		        data-amount="<?php echo esc_attr( $paypal_payment_amount ); ?>"
		        data-quantity="1"
		        data-name="<?php the_title(); ?>"
		        data-number="<?php the_ID(); ?>"
		        data-button="buynow"
		></script>
		<?php
	}
}


/**
 * Returns the theme option value if exists
 *
 * @param $key
 * @param string $value
 *
 * @return string
 */
function ire_has_option_value( $key, $value = '' ) {

	global $inspiry_options;

	if ( isset( $inspiry_options[ $key ] ) && ! empty( $inspiry_options[ $key ] ) ) {
		return $inspiry_options[ $key ];
	}

	return $value;
}

/**
 * Migrates old options values to plugin options
 */
function ire_migrate_options_data() {

    // Social Options
	$social_options = get_option( 'inspiry_social_option' );
	if ( false == $social_options ) {
		$social_default_options = array(
			'inspiry_facebook_url'   => ire_has_option_value( 'inspiry_facebook_url' ),
			'inspiry_twitter_url'    => ire_has_option_value( 'inspiry_twitter_url' ),
			'inspiry_linkedin_url'   => ire_has_option_value( 'inspiry_linkedin_url' ),
			'inspiry_instagram_url'  => ire_has_option_value( 'inspiry_instagram_url' ),
			'inspiry_pinterest_url'  => ire_has_option_value( 'inspiry_pinterest_url' ),
			'inspiry_youtube_url'    => ire_has_option_value( 'inspiry_youtube_url' ),
			'inspiry_rss_url'        => ire_has_option_value( 'inspiry_rss_url' ),
			'inspiry_skype_username' => ire_has_option_value( 'inspiry_skype_username' ),
		);
		update_option( 'inspiry_social_option', $social_default_options );
	}

	// Map Options
	$map_options = get_option( 'inspiry_map_option' );
	if ( false == $map_options ) {
		$map_default_options = array(
			'inspiry_google_map_api_key'   => ire_has_option_value( 'inspiry_google_map_api_key' ),
			'inspiry_google_map_auto_lang' => ire_has_option_value( 'inspiry_google_map_auto_lang', '0' ),
		);
		update_option( 'inspiry_map_option', $map_default_options );
	}

	// reCAPTCHA options
	$recaptcha_options = get_option( 'inspiry_recaptcha_option' );
	if ( false == $recaptcha_options ) {
		$recaptcha__default_options = array(
			'inspiry_google_reCAPTCHA'     => ire_has_option_value( 'inspiry_google_reCAPTCHA', '0' ),
			'inspiry_reCAPTCHA_site_key'   => ire_has_option_value( 'inspiry_reCAPTCHA_site_key' ),
			'inspiry_reCAPTCHA_secret_key' => ire_has_option_value( 'inspiry_reCAPTCHA_secret_key' ),
			'inspiry_reCAPTCHA_language'   => ire_has_option_value( 'inspiry_reCAPTCHA_language', 'en' ),
		);
		update_option( 'inspiry_recaptcha_option', $recaptcha__default_options );
	}

}

add_action( 'admin_init', 'ire_migrate_options_data', PHP_INT_MAX );