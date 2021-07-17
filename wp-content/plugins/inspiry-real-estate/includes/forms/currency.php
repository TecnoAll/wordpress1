<?php

/**
 * Get Base Currency
 *
 * @return mixed|string
 */
function ire_get_base_currency() {
	global $inspiry_options;

	if ( isset( $inspiry_options[ 'theme_base_currency' ] ) ) {
		$base_currency = $inspiry_options[ 'theme_base_currency' ];
		if ( empty( $base_currency ) ) {
			$base_currency = 'USD';
		}

		return $base_currency;
	}
}


/**
 * Get Supported Currencies
 *
 * @return array
 */
function ire_supported_currencies() {
	global $inspiry_options;

	$supported_currencies_array = array();

	$supported_currencies_str = $inspiry_options[ 'theme_supported_currencies' ];
	if ( ! empty( $supported_currencies_str ) ) {
		$supported_currencies_array = explode( ',', $supported_currencies_str );
	}

	// fall back
	if ( empty( $supported_currencies_str ) || empty( $supported_currencies_array ) ) {
		$supported_currencies_array = array(
			'AUD',
			'CAD',
			'CHF',
			'EUR',
			'GBP',
			'HKD',
			'JPY',
			'NOK',
			'SEK',
			'USD'
		);
	}

	return $supported_currencies_array;
}


/**
 * Get Current Currency
 *
 * @return mixed|string
 */
function ire_get_current_currency() {

	if ( isset( $_COOKIE[ "current_currency" ] ) ) {
		$temp_current_currency = $_COOKIE[ "current_currency" ];
		if ( ire_currency_exists( $temp_current_currency ) ) {    // validate current currency
			$current_currency = $temp_current_currency;
		}
	}

	if ( empty( $current_currency ) ) {
		$current_currency = ire_get_base_currency();
	}

	return $current_currency;
}


/**
 * Ajax Currency Switch
 */
function ire_switch_currency() {
	global $inspiry_options;

	// Overall request validation
	if ( isset( $_POST[ 'switch_to_currency' ] ) ):

		// WordPress Nonce
		$nonce = $_POST[ 'nonce' ];
		if ( ! wp_verify_nonce( $nonce, 'switch_currency_nonce' ) ) {
			echo json_encode( array(
				'success' => false,
				'message' => esc_html__( 'Unverified Nonce!', 'inspiry-real-estate' )
			) );
			die;
		}

		// wp-currencies plugin is required - https://wordpress.org/plugins/wp-currencies/
		if ( class_exists( 'WP_Currencies' ) ) {

			$switch_to_currency = $_POST[ 'switch_to_currency' ];

			// expiry time
			$expiry_period = intval( $inspiry_options[ 'theme_currency_expiry' ] );
			if ( ! $expiry_period ) {
				$expiry_period = 60 * 60;   // one hour
			}
			$expiry = time() + $expiry_period;

			// save cookie
			if ( ire_currency_exists( $switch_to_currency ) && setcookie( 'current_currency', $switch_to_currency, $expiry, '/' ) ) {
				echo json_encode( array(
					'success' => true
				) );
			} else {
				echo json_encode( array(
					'success' => false,
					'message' => esc_html__( "Failed to updated cookie !", 'inspiry-real-estate' )
				) );
			}

		} else {
			echo json_encode( array(
				'success' => false,
				'message' => esc_html__( 'wp-currencies plugin is missing !', 'inspiry-real-estate' )
			) );
		}

	else:
		echo json_encode( array(
				'success' => false,
				'message' => esc_html__( "Invalid Request !", 'inspiry-real-estate' )
			)
		);
	endif;

	die;

}

add_action( 'wp_ajax_nopriv_switch_currency', 'ire_switch_currency' );
add_action( 'wp_ajax_switch_currency', 'ire_switch_currency' );


function ire_currency_switcher() {

	if ( class_exists( 'WP_Currencies' ) ) {
		?>
		<div class="switcher__currency">
			<?php
			$supported_currencies = ire_supported_currencies();

			if ( 0 < count( $supported_currencies ) ) {
				echo '<form id="currency-switcher-form" method="post" action="' . admin_url( 'admin-ajax.php' ) . '" >';

				echo '<div id="currency-switcher">';

				$current_currency = ire_get_current_currency();

				echo '<div id="selected-currency">' . $current_currency . '</div>';

				echo '<ul id="currency-switcher-list">';
				foreach ( $supported_currencies as $currency_code ) {
					echo '<li data-currency-code="' . $currency_code . '">' . $currency_code . '</li>';
				}
				echo '</ul>';

				echo '</div>';

				echo '<input type="hidden" id="switch-to-currency" name="switch_to_currency" value="' . $current_currency . '" />';
				echo '<input type="hidden" name="action" value="switch_currency" />';
				echo '<input type="hidden" name="nonce" value="' . wp_create_nonce( 'switch_currency_nonce' ) . '"/>';

				echo '</form>';
			}
			?>
		</div>
		<?php
	}

}


function ire_currency_exists( $currency_code ) {

	$currencies = get_currencies();

	$codes = [];
	if ( $currencies && is_array( $currencies ) ) {
		foreach ( $currencies as $key => $value ) {
			$codes[] = $key;
		}
	}

	return $codes && is_array( $codes ) ? in_array( strtoupper( $currency_code ), (array) $codes ) : null;
}


function ire_convert_currency( $amount = 1, $from = 'USD', $in = 'EUR' ) {

	$rates = wp_currencies()->get_rates();

	$error = $result = '';
	// check first if rates exist
	if ( $rates && is_array( $rates ) && count( $rates ) > 100 ) {

		if ( ! ire_currency_exists( $from ) OR ! ire_currency_exists( $in ) ) {
			trigger_error(
				__( 'WP Currencies: Currency does not exist or was not found in database.', 'wp_currencies' ),
				E_USER_WARNING
			);
			$error = true;
		}

		if ( ! is_numeric( $amount ) ) {
			trigger_error(
				__( 'WP Currencies: Amount to convert must be a number.', 'wp_currencies' ),
				E_USER_WARNING
			);
			$error = true;
		}

		if ( ! $error === true ) {
			$from   = strtoupper( $from );
			$in     = strtoupper( $in );
			$result = $rates[ $from ] && $rates[ $in ] ? (float) $amount * (float) $rates[ $in ] / (float) $rates[ $from ] : floatval( $amount );
		}

	} else {

		trigger_error(
			__( 'WP Currencies: There was a problem fetching currency data from database. Is your API key valid?', 'wp_currencies' ),
			E_USER_WARNING
		);

	}

	return $result;
}