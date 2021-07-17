<?php

/**
 * Class INSPIRY_Mortgage_Calculator
 *
 * @since 1.1.3
 */

class INSPIRY_Mortgage_Calculator extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'inspiry-mortgage-calculator',
			__( 'Inspiry Mortgage Calculator', 'mc' ),
			array( 'description' => __( 'It provides an easy to use inspiry mortgage calculator widget.', 'mc' ) )
		);
	}


	/**
	 * Creating widget front-end - This is where the action happens.
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		 $inspiry_price_format_option = get_option( 'inspiry_price_format_option' );
	    $currency_sign                = ( isset( $inspiry_price_format_option['currency_sign'] )      ? $inspiry_price_format_option['currency_sign']      : '$' );
		$title                        = ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Monthly Mortgage Payments', 'mc' );
		$title                        = apply_filters( 'widget_title', $title );

		$inspiry_mc_total_amount_label    = ( isset( $instance['inspiry_mc_total_amount_label'] ) && ! empty( $instance['inspiry_mc_total_amount_label'] ) ) ? $instance['inspiry_mc_total_amount_label'] : __( 'Total Amount', 'mc' );
		$inspiry_mc_down_payment_label    = ( isset( $instance['inspiry_mc_down_payment_label'] ) && ! empty( $instance['inspiry_mc_down_payment_label'] ) ) ? $instance['inspiry_mc_down_payment_label'] : __( 'Down Payment', 'mc' );
		$inspiry_mc_interest_rate_label   = ( isset( $instance['inspiry_mc_interest_rate_label'] ) && ! empty( $instance['inspiry_mc_interest_rate_label'] ) ) ? $instance['inspiry_mc_interest_rate_label'] : __( 'Interest Rate', 'mc' );
		$inspiry_mc_mortgage_period_label = ( isset( $instance['inspiry_mc_mortgage_period_label'] ) && ! empty( $instance['inspiry_mc_mortgage_period_label'] ) ) ? $instance['inspiry_mc_mortgage_period_label'] : __( 'Mortgage Period', 'mc' );

		// before and after widget arguments are defined by themes
		echo $args['before_widget'];

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>
		<div class="inspiry-mc-wrapper clearfx">
			<form id="inspiry-mc-form" action="#inspiry-mc-form">
				<p>
					<label for="mc-total-amount"><?php echo esc_html( $inspiry_mc_total_amount_label ); ?></label>
					<input type="number" name="inspiry_mc_total_amount_label" id="inspiry-mc-total-amount" min="1" class="required" placeholder="<?php echo esc_attr( $currency_sign); ?>" value="<?php {
						if( is_singular('property') ){
							echo get_post_meta( get_the_ID(), 'REAL_HOMES_property_price', true );
						}
					}; ?>"/>
				</p>
				<p>
					<label for="mc-down-payment"><?php echo esc_html( $inspiry_mc_down_payment_label ); ?></label>
					<input type="number" name="inspiry_mc_down_payment_label" id="inspiry-mc-down-payment" min="0" class="required" placeholder="<?php echo esc_attr( $currency_sign); ?>">
				</p>
				<p>
					<label for="mc-interest-rate"><?php echo esc_html( $inspiry_mc_interest_rate_label ); ?></label>
					<input type="number" name="inspiry_mc_interest_rate_label" id="inspiry-mc-interest-rate" min="0" class="required" placeholder="<?php esc_html_e( '%', 'mc' ); ?>">
				</p>
				<p>
					<label for="mc-mortgage-period"><?php echo esc_html( $inspiry_mc_mortgage_period_label ); ?></label>
					<input type="number" name="inspiry_mc_mortgage_period_label" id="inspiry-mc-mortgage-period" class="required" placeholder="<?php esc_html_e( 'Years', 'mc' ); ?>">
				</p>
				<p>
					<input type="submit" id="inspiry-mc-submit" value="<?php esc_html_e( 'Calculate Mortgage', 'mc' ); ?>">
				</p>
			</form>

			<!-- This div is holding output values-->
			<div id="inspiry-mc-output" class="clearfix"></div>
		</div>

		<?php
		echo $args['after_widget'];
	}

	/**
	 * Widget Backend
	 *
	 * @param array $instance
	 */
	public function form( $instance ) {
		$title                            = isset( $instance['title'] ) ? $instance['title'] : __( 'Mortgage Payments', 'mc' );
		$inspiry_mc_total_amount_label    = isset( $instance['inspiry_mc_total_amount_label'] ) ? $instance['inspiry_mc_total_amount_label'] : __( 'Total Amount', 'mc' );
		$inspiry_mc_down_payment_label    = isset( $instance['inspiry_mc_down_payment_label'] ) ? $instance['inspiry_mc_down_payment_label'] : __( 'Down Payment', 'mc' );
		$inspiry_mc_interest_rate_label   = isset( $instance['inspiry_mc_interest_rate_label'] ) ? $instance['inspiry_mc_interest_rate_label'] : __( 'Interest Rate', 'mc' );
		$inspiry_mc_mortgage_period_label = isset( $instance['inspiry_mc_mortgage_period_label'] ) ? $instance['inspiry_mc_mortgage_period_label'] : __( 'Mortgage Period', 'mc' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php echo esc_html__( 'Title', 'mc' ) . ':'; ?>
			</label>
			<input class="widefat"
				   id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				   type="text"
				   value="<?php
					if ( isset( $title ) ) {
						echo esc_attr( $title );}
					?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'mc-total-amount' ) ); ?>">
				<?php echo esc_html__( 'Total Amount Label', 'mc' ) . ':'; ?>
			</label>
			<input class="widefat"
				   id="<?php echo esc_attr( $this->get_field_id( 'mc-total-amount' ) ); ?>"
				   name="<?php echo esc_attr( $this->get_field_name( 'inspiry_mc_total_amount_label' ) ); ?>"
				   type="text"
				   value="<?php
					if ( isset( $inspiry_mc_total_amount_label ) ) {
						echo esc_attr( $inspiry_mc_total_amount_label );}
					?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'mc-down-payment' ) ); ?>">
				<?php echo esc_html__( 'Down Payment Label', 'mc' ) . ':'; ?>
			</label>
			<input class="widefat"
				   id="<?php echo esc_attr( $this->get_field_id( 'mc-down-payment' ) ); ?>"
				   name="<?php echo esc_attr( $this->get_field_name( 'inspiry_mc_down_payment_label' ) ); ?>"
				   type="text"
				   value="<?php
					if ( isset( $inspiry_mc_down_payment_label ) ) {
						echo esc_attr( $inspiry_mc_down_payment_label );}
					?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'mc-interest-rate' ) ); ?>">
				<?php echo esc_html__( 'Interest Rate Label', 'mc' ) . ':'; ?>
			</label>
			<input class="widefat"
				   id="<?php echo esc_attr( $this->get_field_id( 'mc-interest-rate' ) ); ?>"
				   name="<?php echo esc_attr( $this->get_field_name( 'inspiry_mc_interest_rate_label' ) ); ?>"
				   type="text"
				   value="<?php
					if ( isset( $inspiry_mc_interest_rate_label ) ) {
						echo esc_attr( $inspiry_mc_interest_rate_label );}
					?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'mc-mortgage-period' ) ); ?>">
				<?php echo esc_html__( 'Mortgage Period Label', 'mc' ) . ':'; ?>
			</label>
			<input class="widefat"
				   id="<?php echo esc_attr( $this->get_field_id( 'mc-mortgage-period' ) ); ?>"
				   name="<?php echo esc_attr( $this->get_field_name( 'inspiry_mc_mortgage_period_label' ) ); ?>"
				   type="text"
				   value="<?php
					if ( isset( $inspiry_mc_mortgage_period_label ) ) {
						echo esc_attr( $inspiry_mc_mortgage_period_label );}
					?>" />
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title']                            = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['inspiry_mc_total_amount_label']    = ( ! empty( $new_instance['inspiry_mc_total_amount_label'] ) ) ? sanitize_text_field( $new_instance['inspiry_mc_total_amount_label'] ) : '';
		$instance['inspiry_mc_down_payment_label']    = ( ! empty( $new_instance['inspiry_mc_down_payment_label'] ) ) ? sanitize_text_field( $new_instance['inspiry_mc_down_payment_label'] ) : '';
		$instance['inspiry_mc_interest_rate_label']   = ( ! empty( $new_instance['inspiry_mc_interest_rate_label'] ) ) ? sanitize_text_field( $new_instance['inspiry_mc_interest_rate_label'] ) : '';
		$instance['inspiry_mc_mortgage_period_label'] = ( ! empty( $new_instance['inspiry_mc_mortgage_period_label'] ) ) ? sanitize_text_field( $new_instance['inspiry_mc_mortgage_period_label'] ) : '';

		return $instance;
	}


}//end class


/**
 * Register Mortgage Calculator
 */
function inspiry_register_mortgage_calculator() {
	register_widget( 'INSPIRY_Mortgage_Calculator' );
}
add_action( 'widgets_init', 'inspiry_register_mortgage_calculator' );


/**
 * Localize the script with new data
 */
function inspiry_mc_localization_strings() {

	$mc_output_string      = '';
	$inspiry_mc_options    = get_option( 'inspiry_mc_option' );
	$mc_principal_amount   = ( isset( $inspiry_mc_options['inspiry_mc_principal_amount'] )    ? $inspiry_mc_options['inspiry_mc_principal_amount']   : 'Principal Amount:' );
	$mc_years              = ( isset( $inspiry_mc_options['inspiry_mc_years'] )               ? $inspiry_mc_options['inspiry_mc_years']              : 'Years:' );
	$mc_monthly_payment    = ( isset( $inspiry_mc_options['inspiry_mc_monthly_payment'] )     ? $inspiry_mc_options['inspiry_mc_monthly_payment']    : 'Monthly Payment:' );
	$mc_payable_with_int   = ( isset( $inspiry_mc_options['inspiry_mc_payable_with_int'] )    ? $inspiry_mc_options['inspiry_mc_payable_with_int']   : 'Balance Payable With Interest:' );
	$mc_total_down_payment = ( isset( $inspiry_mc_options['inspiry_mc_total_down_payment'] )  ? $inspiry_mc_options['inspiry_mc_total_down_payment'] : 'Total With Down Payment:' );

	if ( ! empty( $mc_principal_amount ) ) {
		$mc_output_string .= $mc_principal_amount . ' [mortgage_amount]' . ' LINEBREAK ';
	}
	if ( ! empty( $mc_years ) ) {
		$mc_output_string .= $mc_years . ' [amortization_years]' . ' LINEBREAK ';
	}

	if ( ! empty( $mc_monthly_payment ) ) {
		$mc_output_string .= $mc_monthly_payment . ' [mortgage_payment]' . ' LINEBREAK ';
	}

	if ( ! empty( $mc_payable_with_int ) ) {
		$mc_output_string .= $mc_payable_with_int . ' [total_mortgage_interest]' . ' LINEBREAK ';
	}

	if ( ! empty( $mc_total_down_payment ) ) {
		$mc_output_string .= $mc_total_down_payment . ' [total_mortgage_down_payment]' . ' LINEBREAK ';
	}

	$inspiry_price_format_option = get_option( 'inspiry_price_format_option' );

	$currency_sign      = ( isset( $inspiry_price_format_option['currency_sign'] )      ? $inspiry_price_format_option['currency_sign']      : '$' );
	$number_of_decimals = ( isset( $inspiry_price_format_option['number_of_decimals'] ) ? $inspiry_price_format_option['number_of_decimals'] : '0' );
	$decimal_separator  = ( isset( $inspiry_price_format_option['decimal_separator'] )  ? $inspiry_price_format_option['decimal_separator']  : '.' );
	$thousand_separator = ( isset( $inspiry_price_format_option['thousand_separator'] ) ? $inspiry_price_format_option['thousand_separator'] : ',' );
	$currency_position  = ( isset( $inspiry_price_format_option['currency_position'] )  ? $inspiry_price_format_option['currency_position']  : 'before' );
	$localization       = array(
		'mc_output_string'          => $mc_output_string,
		'mc_currency_sign'          => $currency_sign,
		'mc_currency_sign_position' => $currency_position,
		'mc_thousand_separator'     => $thousand_separator,
		'mc_decimal_separator'      => $decimal_separator,
		'mc_number_of_decimals'     => $number_of_decimals,
	);
	return $localization;
}


/**
 * Load plugin Scripts
 */
function inspiry_mortgage_calculator_scripts() {

	$inspiry_mc_url = plugin_dir_url( __FILE__ );

	wp_enqueue_style(
		' inspiry-mortgage-calculator',
		$inspiry_mc_url . 'css/main.css',
		'1.1.3',
		'screen'
	);

	wp_enqueue_script(
		' inspiry-mortgage-calculator',
		$inspiry_mc_url . 'js/mortgage-calculator.js',
		array( 'jquery' ),
		'1.1.3',
		true
	);

	// Localizing Scripts
	$localization = inspiry_mc_localization_strings();
	wp_localize_script( ' inspiry-mortgage-calculator', 'inspiry_mc_strings', $localization );
}
add_action( 'wp_enqueue_scripts', 'inspiry_mortgage_calculator_scripts' );
