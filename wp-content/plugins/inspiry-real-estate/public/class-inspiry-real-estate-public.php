<?php
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Inspiry_Real_Estate
 * @subpackage Inspiry_Real_Estate/public
 */
class Inspiry_Real_Estate_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/inspiry-real-estate-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		// jQuery Validate
		wp_enqueue_script( 'jquery-validate', plugin_dir_url( __FILE__ ) . 'js/jquery.validate.min.js', array( 'jquery' ), '1.13.1', false );

		// jQuery Form
		wp_enqueue_script( 'jquery-form');

		// Google reCAPTCHA
		if ( ire_is_reCAPTCHA_configured() ) {

			$recaptcha_src = esc_url_raw( add_query_arg( array(
				'render' => 'explicit',
				'onload' => 'loadInspiryReCAPTCHA'
			), '//www.google.com/recaptcha/api.js' ) );

			$inspiry_recaptcha_option = get_option( 'inspiry_recaptcha_option' );
			if ( isset( $inspiry_recaptcha_option['inspiry_reCAPTCHA_language'] ) && ! empty( $inspiry_recaptcha_option['inspiry_reCAPTCHA_language'] ) ) {
				$recaptcha_src = esc_url_raw( add_query_arg( array( 'hl' => urlencode( $inspiry_recaptcha_option['inspiry_reCAPTCHA_language'] ) ), $recaptcha_src ) );
			}

			$inspiry_google_recaptcha = ((defined("WPCF7_VERSION")) ? 'google-recaptcha-1' : 'google-recaptcha');

			// enqueue google reCAPTCHA API
			wp_enqueue_script( $inspiry_google_recaptcha, $recaptcha_src, array(), $this->version, true );
		}

		// Property Single
		if ( is_singular( 'property' ) ) {
			wp_enqueue_script( 'share', IRE_PLUGIN_URL . 'public/js/share.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( 'property-share', IRE_PLUGIN_URL . 'public/js/property-share.js', array( 'jquery', 'share' ), $this->version, true );
		}

		// Custom Script
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/inspiry-real-estate-public.js', array( 'jquery' ), $this->version, true );
	}

}
