<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://themeforest.net/user/InspiryThemes
 * @since      1.0.0
 *
 * @package    Inspiry_Real_Estate
 * @subpackage Inspiry_Real_Estate/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Inspiry_Real_Estate
 * @subpackage Inspiry_Real_Estate/admin
 * @author     M Saqib Sarwar <saqib@inspirythemes.com>
 */
class Inspiry_Real_Estate_Admin {

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
	 * Price format options
	 *
	 * @access   public
	 * @var      array    $options    Contains price format options
	 */
	public $price_format_options;

	/**
	 * URL slugs options
	 *
	 * @access   public
	 * @var      array    $options    Contains URL slugs options
	 */
	public $url_slugs_options;

	/**
	 * Social options
	 *
	 * @access   public
	 * @var      array    $options    Contains Social options
	 */
	public $social_options;

	/**
	 * Maps options
	 *
	 * @access   public
	 * @var      array    $options    Contains Maps options
	 */
	public $map_options;

	/**
	 * MC options
	 *
	 * @access   public
	 * @var      array    $options    Contains MC options
	 */
	public $mc_options;

	/**
	 * reCAPTCHA options
	 *
	 * @access   public
	 * @var      array    $options    Contains reCAPTCHA options
	 */
	public $recaptcha_options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name          = $plugin_name;
		$this->version              = $version;
		$this->price_format_options = get_option( 'inspiry_price_format_option' );
		$this->url_slugs_options    = get_option( 'inspiry_url_slugs_option' );
		$this->social_options       = get_option( 'inspiry_social_option' );
		$this->map_options          = get_option( 'inspiry_map_option' );
		$this->mc_options           = get_option( 'inspiry_mc_option' );
		$this->recaptcha_options    = get_option( 'inspiry_recaptcha_option' );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/inspiry-real-estate-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		if ( $this::is_property_edit_page() ) {
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/inspiry-real-estate-admin.js', array( 'jquery', 'jquery-ui-sortable' ), $this->version, false );
		}

	}

	/**
	 * Check if it is a property edit page.
	 *
	 * @return bool
	 */
	public static function is_property_edit_page() {
		if ( is_admin() ) {
			global $pagenow;
			if ( in_array( $pagenow, array( 'post.php', 'post-new.php' ) ) ) {
				global $post_type;
				if ( 'property' == $post_type ) {
					return true;
				}
			}
		}
		return false;
	}

	/**
	 * Add plugin settings page
	 *
	 * @since   1.0.0
	 */
	public function add_real_estate_settings() {

		add_menu_page(
			esc_html__( 'Inspiry Real Estate Settings', 'inspiry-real-estate' ),
			esc_html__( 'Real Estate', 'inspiry-real-estate' ),
			'administrator',
			'inspiry_real_estate',
			array( $this, 'display_real_estate_settings' ),
			'dashicons-admin-multisite',
			'25.786'
		);
	}

	/**
	 * Display real estate settings page
	 */
	public function display_real_estate_settings() {
		?>
		<div class="wrap">
			<?php
			/* Make a call to the WordPress function for rendering errors when settings are saved. */
			settings_errors();
			?>
			<h1 class="screen-reader-text"><?php esc_html_e( 'Inspiry Real Estate Settings', 'inspiry-real-estate' ); ?></h1>
			<div class="inspiry-ire-page">
				<header class="inspiry-ire-page-header">
					<h2 class="title"><span class="theme-title"><?php esc_html_e( 'Inspiry Real Estate Settings', 'inspiry-real-estate' ); ?></span></h2>
					<p class="credit">
						<a class="inspiry-ire-logo-wrap" href="<?php echo esc_url( 'https://themeforest.net/user/inspirythemes/portfolio?order_by=sales' ); ?>" target="_blank">
							<img src="<?php echo IRE_PLUGIN_URL . 'admin/images/logo.png'; ?>" alt=""><?php esc_html_e( 'Inspiry Themes', 'inspiry-real-estate' ); ?>
						</a>
					</p>
				</header>
				<?php
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'inspiry-real-estate' ) );
				}

				$current_tab = 'price_format';
				if ( isset( $_GET['tab'] ) && array_key_exists( $_GET['tab'], $this->tabs() ) ) {
					$current_tab = $_GET['tab'];
				}

				$this->tabs_nav( $current_tab );

				if ( file_exists( IRE_PLUGIN_DIR . 'admin/settings/' . $current_tab . '.php' ) ) {
					require_once IRE_PLUGIN_DIR . 'admin/settings/' . $current_tab . '.php';
				}
				?>
				<footer class="inspiry-ire-page-footer">
					<p><?php printf( esc_html__( 'Version  %s', 'inspiry-real-estate' ), esc_html( $this->version ) ); ?></p>
				</footer>
			</div><!-- /.inspiry-ire-page -->
		</div><!-- /.wrap -->
		<?php
	}

	/**
	 * Tabs
	 */
	public function tabs() {

		$tabs = array(
			'price_format' => esc_html__( 'Price Format', 'inspiry-real-estate' ),
			'url_slugs'    => esc_html__( 'URL Slugs', 'inspiry-real-estate' ),
			'social'       => esc_html__( 'Social', 'inspiry-real-estate' ),
			'map'          => esc_html__( 'Maps', 'inspiry-real-estate' ),
			'captcha'      => esc_html__( 'reCAPTCHA', 'inspiry-real-estate' ),
			'mc_settings'  => esc_html__( 'Mortgage Calculator', 'inspiry-real-estate' ),
		);

		return $tabs;
	}

	/**
	 * Generates tabs navigation
	 *
	 * @param $current_tab
	 */
	public function tabs_nav( $current_tab ) {
		$tabs = $this->tabs();
		?>
		<div id="inspiry-ire-tabs" class="inspiry-ire-tabs">
			<?php
			if ( ! empty( $tabs ) && is_array( $tabs ) ) {
				foreach ( $tabs as $slug => $title ) {
					if ( file_exists( IRE_PLUGIN_DIR . 'admin/settings/' . $slug . '.php' ) ) {
						$active_tab = ( $current_tab === $slug ) ? ' inspiry-is-active-tab' : '';
						$admin_url  = ( $current_tab === $slug ) ? '#' : admin_url( 'admin.php?page=inspiry_real_estate&tab=' . $slug );
						echo '<a class="inspiry-ire-tab ' . esc_attr( $active_tab ) . '" href="' . esc_url_raw( $admin_url ) . '" data-tab="' . esc_attr( $slug ) . '">' . esc_html( $title ) . '</a>';
					}
				}
			}
			?>
		</div>
		<?php
	}

	/**
	 * Initialize real estate settings page
	 */
	public function initialize_price_format_options() {

		// If the price format options do not exist then create them
		if ( false == $this->price_format_options ) {
			add_option( 'inspiry_price_format_option', apply_filters( 'inspiry_price_format_default_options', array( $this, 'price_format_default_options' ) ) );
		}

		/**
		 * Section
		 */
		add_settings_section(
			'inspiry_price_format_section',                                                 // ID used to identify this section and with which to register options
			esc_html__( 'Price Format', 'inspiry-real-estate' ),                                     // Title to be displayed on the administration page
			array( $this, 'price_format_settings_desc' ),                     // Callback used to render the description of the section
			'inspiry_price_format_page'                                                     // Page on which to add this section of options
		);

		/**
		 * Price Format Fields
		 */
		add_settings_field(
			'currency_sign',
			esc_html__( 'Currency Sign', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_price_format_page',
			'inspiry_price_format_section',
			array(
				'field_id'          => 'currency_sign',
				'field_option'      => 'inspiry_price_format_option',
				'field_default'     => '$',
				'field_description' => esc_html__( 'Default: $', 'inspiry-real-estate' ),
			)
		);

		add_settings_field(
			'currency_position',
			esc_html__( 'Currency Sign Position', 'inspiry-real-estate' ),
			array( $this, 'select_option_field' ),
			'inspiry_price_format_page',
			'inspiry_price_format_section',
			array(
				'field_id'          => 'currency_position',
				'field_option'      => 'inspiry_price_format_option',
				'field_default'     => 'before',
				'field_options'     => array(
					'before' => esc_html__( 'Before ($450,000)', 'inspiry-real-estate' ),
					'after'  => esc_html__( 'After (450,000$)', 'inspiry-real-estate' ),
				),
				'field_description' => esc_html__( 'Default: Before', 'inspiry-real-estate' ),
			)
		);

		add_settings_field(
			'thousand_separator',
			esc_html__( 'Thousand Separator', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_price_format_page',
			'inspiry_price_format_section',
			array(
				'field_id'          => 'thousand_separator',
				'field_option'      => 'inspiry_price_format_option',
				'field_default'     => ',',
				'field_description' => esc_html__( 'Default: ,', 'inspiry-real-estate' ),
			)
		);

		add_settings_field(
			'decimal_separator',
			esc_html__( 'Decimal Separator', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_price_format_page',
			'inspiry_price_format_section',
			array(
				'field_id'          => 'decimal_separator',
				'field_option'      => 'inspiry_price_format_option',
				'field_default'     => '.',
				'field_description' => esc_html__( 'Default: .', 'inspiry-real-estate' ),
			)
		);

		add_settings_field(
			'number_of_decimals',
			esc_html__( 'Number of Decimals', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_price_format_page',
			'inspiry_price_format_section',
			array(
				'field_id'          => 'number_of_decimals',
				'field_option'      => 'inspiry_price_format_option',
				'field_default'     => '0',
				'field_description' => esc_html__( 'Default: 0', 'inspiry-real-estate' ),
			)
		);

		add_settings_field(
			'empty_price_text',
			esc_html__( 'Empty Price Text', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_price_format_page',
			'inspiry_price_format_section',
			array(
				'field_id'          => 'empty_price_text',
				'field_option'      => 'inspiry_price_format_option',
				'field_default'     => esc_html__( 'Price on call', 'inspiry-real-estate' ),
				'field_description' => esc_html__( 'Text to display in case of empty price. Example: Price on call', 'inspiry-real-estate' ),
			)
		);

		/**
		 * Register Settings
		 */
		register_setting( 'inspiry_price_format_option_group', 'inspiry_price_format_option' );

	}

	public function initialize_url_slugs_options() {

		// create plugin options if not exist
		if ( false == $this->url_slugs_options ) {
			add_option( 'inspiry_url_slugs_option', apply_filters( 'inspiry_url_slugs_default_options', array( $this, 'url_slugs_default_options' ) ) );
		}

		/**
		 * Section
		 */
		add_settings_section(
			'inspiry_url_slugs_section',                                                 // ID used to identify this section and with which to register options
			esc_html__( 'URL Slugs', 'inspiry-real-estate' ),                           // Title to be displayed on the administration page
			array( $this, 'url_slugs_settings_desc' ),          // Callback used to render the description of the section
			'inspiry_url_slugs_page'                                          // Page on which to add this section of options
		);

		/*
		 * URL Slugs Fields
		 */
		add_settings_field(
			'property_url_slug',
			esc_html__( 'Property', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_url_slugs_page',
			'inspiry_url_slugs_section',
			array(
				'field_id'          => 'property_url_slug',
				'field_option'      => 'inspiry_url_slugs_option',
				'field_default'     => esc_html__( 'property', 'inspiry-real-estate' ),
				'field_description' => esc_html__( 'Default: property', 'inspiry-real-estate' ),
			)
		);

		add_settings_field(
			'property_type_url_slug',
			esc_html__( 'Property Type', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_url_slugs_page',
			'inspiry_url_slugs_section',
			array(
				'field_id'          => 'property_type_url_slug',
				'field_option'      => 'inspiry_url_slugs_option',
				'field_default'     => esc_html__( 'property-type', 'inspiry-real-estate' ),
				'field_description' => esc_html__( 'Default: property-type', 'inspiry-real-estate' ),
			)
		);

		add_settings_field(
			'property_status_url_slug',
			esc_html__( 'Property Status', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_url_slugs_page',
			'inspiry_url_slugs_section',
			array(
				'field_id'          => 'property_status_url_slug',
				'field_option'      => 'inspiry_url_slugs_option',
				'field_default'     => esc_html__( 'property-status', 'inspiry-real-estate' ),
				'field_description' => esc_html__( 'Default: property-status', 'inspiry-real-estate' ),
			)
		);

		add_settings_field(
			'property_city_url_slug',
			esc_html__( 'Property City', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_url_slugs_page',
			'inspiry_url_slugs_section',
			array(
				'field_id'          => 'property_city_url_slug',
				'field_option'      => 'inspiry_url_slugs_option',
				'field_default'     => esc_html__( 'property-city', 'inspiry-real-estate' ),
				'field_description' => esc_html__( 'Default: property-city', 'inspiry-real-estate' ),
			)
		);

		add_settings_field(
			'property_feature_url_slug',
			esc_html__( 'Property Feature', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_url_slugs_page',
			'inspiry_url_slugs_section',
			array(
				'field_id'          => 'property_feature_url_slug',
				'field_option'      => 'inspiry_url_slugs_option',
				'field_default'     => esc_html__( 'property-feature', 'inspiry-real-estate' ),
				'field_description' => esc_html__( 'Default: property-feature', 'inspiry-real-estate' ),
			)
		);

		add_settings_field(
			'agent_url_slug',
			esc_html__( 'Agent', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_url_slugs_page',
			'inspiry_url_slugs_section',
			array(
				'field_id'          => 'agent_url_slug',
				'field_option'      => 'inspiry_url_slugs_option',
				'field_default'     => esc_html__( 'agent', 'inspiry-real-estate' ),
				'field_description' => esc_html__( 'Default: agent', 'inspiry-real-estate' ),
			)
		);

		/**
		 * Register Settings
		 */
		register_setting( 'inspiry_url_slugs_option_group', 'inspiry_url_slugs_option' );

	}

	public function initialize_social_options() {

		/**
		 * Section
		 */
		add_settings_section(
			'inspiry_social_section',
			esc_html__( 'Social', 'inspiry-real-estate' ),
			'',
			'inspiry_social_page'
		);

		add_settings_field(
			'inspiry_facebook_url',
			esc_html__( 'Facebook URL', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_social_page',
			'inspiry_social_section',
			array(
				'field_id'          => 'inspiry_facebook_url',
				'field_option'      => 'inspiry_social_option',
				'field_default'     => ire_has_option_value( 'inspiry_facebook_url' ),
				'field_description' => '',
			)
		);

		add_settings_field(
			'inspiry_twitter_url',
			esc_html__( 'Twitter URL', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_social_page',
			'inspiry_social_section',
			array(
				'field_id'          => 'inspiry_twitter_url',
				'field_option'      => 'inspiry_social_option',
				'field_default'     => ire_has_option_value( 'inspiry_twitter_url' ),
				'field_description' => '',
			)
		);

		add_settings_field(
			'inspiry_linkedin_url',
			esc_html__( 'LinkedIn URL', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_social_page',
			'inspiry_social_section',
			array(
				'field_id'          => 'inspiry_linkedin_url',
				'field_option'      => 'inspiry_social_option',
				'field_default'     => ire_has_option_value( 'inspiry_linkedin_url' ),
				'field_description' => '',
			)
		);

		add_settings_field(
			'inspiry_instagram_url',
			esc_html__( 'Instagram URL', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_social_page',
			'inspiry_social_section',
			array(
				'field_id'          => 'inspiry_instagram_url',
				'field_option'      => 'inspiry_social_option',
				'field_default'     => ire_has_option_value( 'inspiry_instagram_url' ),
				'field_description' => '',
			)
		);

		add_settings_field(
			'inspiry_pinterest_url',
			esc_html__( 'Pinterest URL', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_social_page',
			'inspiry_social_section',
			array(
				'field_id'          => 'inspiry_pinterest_url',
				'field_option'      => 'inspiry_social_option',
				'field_default'     => ire_has_option_value( 'inspiry_pinterest_url' ),
				'field_description' => '',
			)
		);

		add_settings_field(
			'inspiry_youtube_url',
			esc_html__( 'YouTube URL', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_social_page',
			'inspiry_social_section',
			array(
				'field_id'          => 'inspiry_youtube_url',
				'field_option'      => 'inspiry_social_option',
				'field_default'     => ire_has_option_value( 'inspiry_youtube_url' ),
				'field_description' => '',
			)
		);

		add_settings_field(
			'inspiry_rss_url',
			esc_html__( 'Rss URL', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_social_page',
			'inspiry_social_section',
			array(
				'field_id'          => 'inspiry_rss_url',
				'field_option'      => 'inspiry_social_option',
				'field_default'     => ire_has_option_value( 'inspiry_rss_url' ),
				'field_description' => '',
			)
		);

		add_settings_field(
			'inspiry_skype_username',
			esc_html__( 'Skype Username', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_social_page',
			'inspiry_social_section',
			array(
				'field_id'          => 'inspiry_skype_username',
				'field_option'      => 'inspiry_social_option',
				'field_default'     => ire_has_option_value( 'inspiry_skype_username' ),
				'field_description' => '',
			)
		);

		// Register Settings
		register_setting( 'inspiry_social_option_group', 'inspiry_social_option' );
	}

	public function initialize_map_options() {

		/**
		 * Section
		 */
		add_settings_section(
			'inspiry_map_section',
			esc_html__( 'Maps', 'inspiry-real-estate' ),
			'',
			'inspiry_map_page'
		);

		/**
		 * Google Map API Key Field
		 */
		add_settings_field(
			'inspiry_google_map_api_key',
			esc_html__( 'Google Maps Api Key', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_map_page',
			'inspiry_map_section',
			array(
				'field_id'          => 'inspiry_google_map_api_key',
				'field_option'      => 'inspiry_map_option',
				'field_default'     => ire_has_option_value( 'inspiry_google_map_api_key' ),
				'field_description' => '',
			)
		);

		/**
		 * Google Map Language Field
		 */
		add_settings_field(
			'inspiry_google_map_auto_lang',
			esc_html__( 'Automatically Switch Google Map Language', 'inspiry-real-estate' ),
			array( $this, 'radio_option_field' ),
			'inspiry_map_page',
			'inspiry_map_section',
			array(
				'field_id'          => 'inspiry_google_map_auto_lang',
				'field_option'      => 'inspiry_map_option',
				'field_default'     => ire_has_option_value( 'inspiry_google_map_auto_lang', '0' ),
				'field_description' => esc_html__( 'Based on site language from general settings OR current language if you are using WPML.', 'inspiry-real-estate' ),
			)
		);

		/**
		 * Google Map Styles Field
		 */
		add_settings_field(
			'inspiry_google_maps_styles',
			esc_html__( 'Google Maps Styles JSON (optional)', 'inspiry-real-estate' ),
			array( $this, 'textarea_option_field' ),
			'inspiry_map_page',
			'inspiry_map_section',
			array(
				'field_id'          => 'inspiry_google_maps_styles',
				'field_option'      => 'inspiry_map_option',
				'field_default'     => '',
				'field_description' => sprintf( esc_html__( 'You can create Google Maps styles JSON using %1$s Google Styling Wizard %2$s or %3$s Snazzy Maps %4$s.', 'easy-real-estate' ), '<a href="https://mapstyle.withgoogle.com/" target="_blank">', '</a>', '<a href="https://snazzymaps.com/" target="_blank">', '</a>' ),
			)
		);

		/**
		 * Google Map Type Field
		 */
		add_settings_field(
			'inspiry_property_map_type',
			esc_html__( 'Google Map Type', 'inspiry-real-estate' ),
			array( $this, 'select_option_field' ),
			'inspiry_map_page',
			'inspiry_map_section',
			array(
				'field_id'          => 'inspiry_property_map_type',
				'field_option'      => 'inspiry_map_option',
				'field_default'     => '',
				'field_description' => esc_html__( 'Choose Google Map Type', 'inspiry-real-estate' ),
				'field_options'     => array(
					'roadmap'   => esc_html__( 'RoadMap', 'inspiry-real-estate' ),
					'satellite' => esc_html__( 'Satellite', 'inspiry-real-estate' ),
					'hybrid'    => esc_html__( 'Hybrid', 'inspiry-real-estate' ),
					'terrain'   => esc_html__( 'Terrain', 'inspiry-real-estate' ),
				),
			)
		);

		/**
		 * Google Map Defualt Address
		 */
		add_settings_field(
			'property_submit_default_address',
			esc_html__( 'Default Address for New Property', 'inspiry-real-estate' ),
			array( $this, 'textarea_option_field' ),
			'inspiry_map_page',
			'inspiry_map_section',
			array(
				'field_id'          => 'property_submit_default_address',
				'field_option'      => 'inspiry_map_option',
				'field_default'     => '15421 Southwest 39th Terrace, Miami, FL 33185, USA',
				'field_description' => esc_html__( 'Exmaple: 15421 Southwest 39th Terrace, Miami, FL 33185, USA', 'inspiry-real-estate' ),

			)
		);

			/**
		 * Google Map Defualt Location
		 */
		add_settings_field(
			'property_submit_default_location',
			esc_html__( 'Default Map Location for New Property (Latitude,Longitude)', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_map_page',
			'inspiry_map_section',
			array(
				'field_id'          => 'property_submit_default_location',
				'field_option'      => 'inspiry_map_option',
				'field_default'     => '25.7308309,-80.44414899999998',
				'field_description' => sprintf( esc_html__( 'You can use %s OR %s to get Latitude and longitude of your desired location.', 'easy-real-estate' ), '<a href="http://www.latlong.net/" target="_blank">latlong.net</a>', '<a href="https://getlatlong.net/" target="_blank">getlatlong.net</a>' ),

			)
		);

		/**
		 * Register Settings
		 */
		register_setting( 'inspiry_map_option_group', 'inspiry_map_option' );
	}

	public function initialize_recaptcha_options() {

		/**
		 * Section
		 */
		add_settings_section(
			'inspiry_recaptcha_section',
			esc_html__( 'Google reCAPTCHA', 'inspiry-real-estate' ),
			'',
			'inspiry_recaptcha_page'
		);

		add_settings_field(
			'inspiry_google_reCAPTCHA',
			esc_html__( 'Google reCAPTCHA', 'inspiry-real-estate' ),
			array( $this, 'radio_option_field' ),
			'inspiry_recaptcha_page',
			'inspiry_recaptcha_section',
			array(
				'field_id'          => 'inspiry_google_reCAPTCHA',
				'field_option'      => 'inspiry_recaptcha_option',
				'field_default'     => ire_has_option_value( 'inspiry_google_reCAPTCHA', '0' ),
				'field_description' => '',
			)
		);

		add_settings_field(
			'inspiry_reCAPTCHA_site_key',
			esc_html__( 'reCAPTCHA Site Key', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_recaptcha_page',
			'inspiry_recaptcha_section',
			array(
				'field_id'          => 'inspiry_reCAPTCHA_site_key',
				'field_option'      => 'inspiry_recaptcha_option',
				'field_default'     => ire_has_option_value( 'inspiry_reCAPTCHA_site_key' ),
				'field_description' => '',
			)
		);

		add_settings_field(
			'inspiry_reCAPTCHA_secret_key',
			esc_html__( 'reCAPTCHA Secret Key', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_recaptcha_page',
			'inspiry_recaptcha_section',
			array(
				'field_id'          => 'inspiry_reCAPTCHA_secret_key',
				'field_option'      => 'inspiry_recaptcha_option',
				'field_default'     => ire_has_option_value( 'inspiry_reCAPTCHA_secret_key' ),
				'field_description' => '',
			)
		);

		add_settings_field(
			'inspiry_reCAPTCHA_language',
			esc_html__( 'reCAPTCHA Language', 'inspiry-real-estate' ),
			array( $this, 'select_option_field' ),
			'inspiry_recaptcha_page',
			'inspiry_recaptcha_section',
			array(
				'field_id'          => 'inspiry_reCAPTCHA_language',
				'field_option'      => 'inspiry_recaptcha_option',
				'field_default'     => ire_has_option_value( 'inspiry_reCAPTCHA_language', 'en' ),
				'field_options'     => array(
					'ar'     => 'Arabic',
					'bn'     => 'Bengali',
					'bg'     => 'Bulgarian',
					'ca'     => 'Catalan',
					'zh-CN'  => 'Chinese (Simplified)',
					'zh-TW'  => 'Chinese (Traditional)',
					'hr'     => 'Croatian',
					'cs'     => 'Czech',
					'da'     => 'Danish',
					'nl'     => 'Dutch',
					'en-GB'  => 'English (UK)',
					'en'     => 'English (US)',
					'et'     => 'Estonian',
					'fil'    => 'Filipino',
					'fi'     => 'Finnish',
					'fr'     => 'French',
					'fr-CA'  => 'French (Canadian)',
					'de'     => 'German',
					'gu'     => 'Gujarati',
					'Value'  => 'Language',
					'de-AT'  => 'German (Austria)',
					'de-CH'  => 'German (Switzerland)',
					'el'     => 'Greek',
					'iw'     => 'Hebrew',
					'hi'     => 'Hindi',
					'hu'     => 'Hungarain',
					'id'     => 'Indonesian',
					'it'     => 'Italian',
					'ja'     => 'Japanese',
					'kn'     => 'Kannada',
					'ko'     => 'Korean',
					'lv'     => 'Latvian',
					'lt'     => 'Lithuanian',
					'ms'     => 'Malay',
					'ml'     => 'Malayalam',
					'mr'     => 'Marathi',
					'no'     => 'Norwegian',
					'fa'     => 'Persian',
					'pl'     => 'Polish',
					'pt'     => 'Portuguese',
					'pt-BR'  => 'Portuguese (Brazil)',
					'pt-PT'  => 'Portuguese (Portugal)',
					'ro'     => 'Romanian',
					'ru'     => 'Russian',
					'sr'     => 'Serbian',
					'sk'     => 'Slovak',
					'sl'     => 'Slovenian',
					'es'     => 'Spanish',
					'es-419' => 'Spanish (Latin America)',
					'sv'     => 'Swedish',
					'ta'     => 'Tamil',
					'te'     => 'Telugu',
					'th'     => 'Thai',
					'tr'     => 'Turkish',
					'uk'     => 'Ukrainian',
					'ur'     => 'Urdu',
					'vi'     => 'Vietnamese',
				),
				'field_description' => '',
			)
		);

		/**
		 * Register Settings
		 */
		register_setting( 'inspiry_recaptcha_option_group', 'inspiry_recaptcha_option' );
	}

	public function initialize_mc_options() {

		/**
		 * Section
		 */
		add_settings_section(
			'inspiry_mc_section',
			esc_html__( 'Mortgage Calculator', 'inspiry-real-estate' ),
			'',
			'inspiry_mc_page'
		);

		/**
		 * Principal Amount Fields
		 */
		add_settings_field(
			'inspiry_mc_principal_amount',
			esc_html__( 'Principal Amount', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_mc_page',
			'inspiry_mc_section',
			array(
				'field_id'          => 'inspiry_mc_principal_amount',
				'field_option'      => 'inspiry_mc_option',
				'field_default'     => 'Principal Amount',
				'field_description' => esc_html__( 'Default: Principal Amount', 'inspiry-real-estate' ),
			)
		);

		/**
		 * Years Fields
		 */
		add_settings_field(
			'inspiry_mc_years',
			esc_html__( 'Years', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_mc_page',
			'inspiry_mc_section',
			array(
				'field_id'          => 'inspiry_mc_years',
				'field_option'      => 'inspiry_mc_option',
				'field_default'     => 'Years',
				'field_description' => esc_html__( 'Default: Years', 'inspiry-real-estate' ),
			)
		);

		/**
		 * Monthly Payment Fields
		 */
		add_settings_field(
			'inspiry_mc_monthly_payment',
			esc_html__( 'Monthly Payment:', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_mc_page',
			'inspiry_mc_section',
			array(
				'field_id'          => 'inspiry_mc_monthly_payment',
				'field_option'      => 'inspiry_mc_option',
				'field_default'     => 'Monthly Payment',
				'field_description' => esc_html__( 'Default: Monthly Payment', 'inspiry-real-estate' ),
			)
		);

		/**
		 * Balance Payable With Interest Fields
		 */
		add_settings_field(
			'inspiry_mc_payable_with_int',
			esc_html__( 'Balance Payable With Interest:', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_mc_page',
			'inspiry_mc_section',
			array(
				'field_id'          => 'inspiry_mc_payable_with_int',
				'field_option'      => 'inspiry_mc_option',
				'field_default'     => 'Balance Payable With Interest',
				'field_description' => esc_html__( 'Default: Balance Payable With Interest', 'inspiry-real-estate' ),
			)
		);

		/**
		 * Balance Payable With Interest Fields
		 */
		add_settings_field(
			'inspiry_mc_total_down_payment',
			esc_html__( 'Total With Down Payment:', 'inspiry-real-estate' ),
			array( $this, 'text_option_field' ),
			'inspiry_mc_page',
			'inspiry_mc_section',
			array(
				'field_id'          => 'inspiry_mc_total_down_payment',
				'field_option'      => 'inspiry_mc_option',
				'field_default'     => 'Total With Down Payment',
				'field_description' => esc_html__( 'Default: Total With Down Payment', 'inspiry-real-estate' ),
			)
		);

		/**
		 * Register Settings
		 */
		register_setting( 'inspiry_mc_option_group', 'inspiry_mc_option' );
	}

	/**
	 * Price format section description
	 */
	public function price_format_settings_desc() {
		echo '<p>' . esc_html__( 'Using options provided below, You can modify price format to match your needs.', 'inspiry-real-estate' ) . '</p>';
	}

	/**
	 * URL slugs section description
	 */
	public function url_slugs_settings_desc() {
		echo '<p>' . esc_html__( 'You can modify URL slugs to match your needs.', 'inspiry-real-estate' ) . '</p>';
		echo '<p><strong>' . esc_html__( 'Just make sure to re-save permalinks settings after every change to avoid 404 errors. You can do that from Settings > Permalinks .', 'inspiry-real-estate' ) . '</strong></p>';
	}

	/**
	 * Reusable text option field for settings page
	 *
	 * @param $args array   field arguments
	 */
	public function text_option_field( $args ) {

		if ( $args['field_id'] ) {

			$field_id          = $args['field_id'];
			$field_option      = $args['field_option'];
			$field_value       = $args['field_default'];
			$field_description = $args['field_description'];

			// Default value or stored value based on option field
			if ( isset( $this->price_format_options[ $field_id ] ) ) {

				$field_value = $this->price_format_options[ $field_id ];

			} elseif ( isset( $this->url_slugs_options[ $field_id ] ) ) {

				$field_value = $this->url_slugs_options[ $field_id ];

			} elseif ( isset( $this->social_options[ $field_id ] ) ) {

				$field_value = $this->social_options[ $field_id ];

			} elseif ( isset( $this->map_options[ $field_id ] ) ) {

				$field_value = $this->map_options[ $field_id ];

			} elseif ( isset( $this->mc_options[ $field_id ] ) ) {

				$field_value = $this->mc_options[ $field_id ];

			} elseif ( isset( $this->recaptcha_options[ $field_id ] ) ) {

				$field_value = $this->recaptcha_options[ $field_id ];
			}

			echo '<input type="text" name="' . $field_option . '[' . $field_id . ']" class="inspiry-text-field regular-text code ' . $field_id . '" value="' . $field_value . '" />';
			if ( isset( $field_description ) && ! empty( $field_description ) ) {
				echo '<br/><label class="inspiry-field-description">' . $field_description . '</label>';
			}
		} else {
			esc_html_e( 'Field id is missing!', 'inspiry-real-estate' );
		}
	}

	 /**
	  * Reusable text option field for settings page
	  *
	  * @param $args array   field arguments
	  */
	public function textarea_option_field( $args ) {

		if ( $args['field_id'] ) {

			$field_id          = $args['field_id'];
			$field_option      = $args['field_option'];
			$field_value       = $args['field_default'];
			$field_description = $args['field_description'];

			if ( isset( $this->map_options[ $field_id ] ) ) {

				$field_value = stripslashes( $this->map_options[ $field_id ] );

			}

			echo '<textarea rows="7" cols="20" name="' . $field_option . '[' . $field_id . ']" class="inspiry-text-field regular-text code' . $field_id . '" >' . $field_value . '</textarea>';
			if ( isset( $field_description ) && ! empty( $field_description ) ) {
				echo '<br/><label class="inspiry-field-description">' . $field_description . '</label>';
			}
		} else {
			esc_html_e( 'Field id is missing!', 'inspiry-real-estate' );
		}
	}

	/**
	 * Reusable select options field for settings page
	 *
	 * @param $args array   field arguments
	 */
	public function select_option_field( $args ) {

		if ( $args['field_id'] ) {

			$field_id          = $args['field_id'];
			$field_option      = $args['field_option'];
			$field_options     = $args['field_options'];
			$field_value       = $args['field_default'];
			$field_description = $args['field_description'];
			$field_name        = $field_option . '[' . $field_id . ']';

			// Default value or stored value based on option field
			if ( isset( $this->url_slugs_options[ $field_id ] ) ) {

				$field_value = $this->url_slugs_options[ $field_id ];

			} elseif ( isset( $this->price_format_options[ $field_id ] ) ) {

				$field_value = $this->price_format_options[ $field_id ];

			} elseif ( isset( $this->recaptcha_options[ $field_id ] ) ) {

				$field_value = $this->recaptcha_options[ $field_id ];

			}elseif ( isset( $this->map_options[ $field_id ] ) ) {

				$field_value = $this->map_options[ $field_id ];

			}
			?>
			<select name="<?php echo esc_html( $field_name ); ?>" class="inspiry-select-field <?php echo $field_id; ?>">
				<?php foreach ( $field_options as $key => $value ) { ?>
					<option value="<?php echo $key; ?>" <?php selected( $field_value, $key ); ?>><?php echo $value; ?></option>
				<?php } ?>
			</select>
			<?php
			if ( isset( $field_description ) ) {
				echo '<br/><label class="inspiry-field-description">' . $field_description . '</label>';
			}
		} else {
			esc_html_e( 'Field id is missing!', 'inspiry-real-estate' );
		}
	}

	/**
	 * Reusable text option field for settings page
	 *
	 * @param $args array   field arguments
	 */
	public function radio_option_field( $args ) {

		if ( $args['field_id'] ) {

			$field_id          = $args['field_id'];
			$field_option      = $args['field_option'];
			$field_value       = $args['field_default'];
			$field_description = $args['field_description'];
			$field_name        = $field_option . '[' . $field_id . ']';

			// Default value or stored value based on option field
			if ( isset( $this->map_options[ $field_id ] ) ) {

				$field_value = $this->map_options[ $field_id ];

			} elseif ( isset( $this->mc_options[ $field_id ] ) ) {

				$field_value = $this->mc_options[ $field_id ];

			} elseif ( isset( $this->recaptcha_options[ $field_id ] ) ) {

				$field_value = $this->recaptcha_options[ $field_id ];

			}
			?>
			<fieldset>
				<label>
					<input type="radio" name="<?php echo esc_html( $field_name ); ?>" value="1" <?php checked( $field_value, '1' ); ?> />
					<span><?php esc_html_e( 'Yes', 'inspiry-real-estate' ); ?></span>
				</label>
				<br>
				<label>
					<input type="radio" name="<?php echo esc_html( $field_name ); ?>" value="0" <?php checked( $field_value, '0' ); ?> />
					<span><?php esc_html_e( 'No', 'inspiry-real-estate' ); ?></span>
				</label>
			</fieldset>
			<?php
			if ( isset( $field_description ) && ! empty( $field_description ) ) {
				echo '<label class="inspiry-field-description">' . $field_description . '</label>';
			}
		} else {
			esc_html_e( 'Field id is missing!', 'inspiry-real-estate' );
		}
	}

	/**
	 * Provides default values for price format options
	 */
	public function price_format_default_options() {

		$defaults = array(
			'currency_sign'      => '$',
			'currency_position'  => 'before',
			'thousand_separator' => ',',
			'decimal_separator'  => '.',
			'number_of_decimals' => '0',
			'empty_price_text'   => 'Price on call',
		);

		return $defaults;
	}

	/**
	 * Provides default values for url slugs options
	 */
	public function url_slugs_default_options() {

		$defaults = array(
			'property_url_slug'         => 'property',
			'property_type_url_slug'    => 'property-type',
			'property_status_url_slug'  => 'property-status',
			'property_city_url_slug'    => 'property-city',
			'property_feature_url_slug' => 'property-feature',
			'agent_url_slug'            => 'agent',
		);

		return $defaults;
	}

	/**
	 * Add plugin action links
	 *
	 * @param $links
	 * @return array
	 */
	public function ire_real_estate_action_links( $links ) {
		$links[] = '<a href="' . get_admin_url( null, 'admin.php?page=inspiry_real_estate' ) . '">' . esc_html__( 'Settings', 'inspiry-real-estate' ) . '</a>';
		return $links;
	}
}
