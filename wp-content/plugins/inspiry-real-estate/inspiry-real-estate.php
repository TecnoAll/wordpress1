<?php
/**
 * Plugin Name:       Inspiry Real Estate
 * Plugin URI:        http://themeforest.net/item/real-places-responsive-wordpress-real-estate-theme/12579089
 * Description:       Inspiry real estate plugin provides plugin territory functionality for Real Places theme.
 * Version:           1.5.0
 * Author:            Inspiry Themes
 * Author URI:        https://themeforest.net/user/inspirythemes/portfolio
 * Text Domain:       inspiry-real-estate
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Plugin basename
if ( ! defined( 'INSPIRY_REAL_ESTATE_PLUGIN_BASENAME' ) ) {
	define( 'INSPIRY_REAL_ESTATE_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}

// Plugin directory path
if ( ! defined( 'IRE_PLUGIN_DIR' ) ) {
	define( 'IRE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

// Plugin directory path
if ( ! defined( 'IRE_PLUGIN_URL' ) ) {
	define( 'IRE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}


/**
 * Redux framework
 */
require_once( IRE_PLUGIN_DIR . 'includes/redux-framework/inspiry-redux.php' );


/**
 * Functions
 */
require_once( IRE_PLUGIN_DIR . 'includes/functions/basic.php' );
require_once( IRE_PLUGIN_DIR . 'includes/functions/real-estate.php' );
require_once( IRE_PLUGIN_DIR . 'includes/functions/contact.php' );
require_once( IRE_PLUGIN_DIR . 'includes/functions/members.php' );
require_once( IRE_PLUGIN_DIR . 'includes/functions/profile.php' );


/**
 * Meta Boxes
 */
include_once( IRE_PLUGIN_DIR . 'includes/meta-boxes/load-meta-boxes.php' );
include_once( IRE_PLUGIN_DIR . 'includes/meta-boxes/contact.php' );
include_once( IRE_PLUGIN_DIR . 'includes/meta-boxes/properties-pages.php' );
include_once( IRE_PLUGIN_DIR . 'includes/meta-boxes/others.php' );


/**
 * Dynamic Sidebars
 */
include_once( IRE_PLUGIN_DIR . 'includes/sidebars/inspiry-sidebars.php' );


/**
 * Widgets
 */
include_once( IRE_PLUGIN_DIR . 'includes/widgets/advance-search-widget.php' );
include_once( IRE_PLUGIN_DIR . 'includes/widgets/featured-properties-widget.php' );
include_once( IRE_PLUGIN_DIR . 'includes/widgets/social-icons-widget.php' );
include_once( IRE_PLUGIN_DIR . 'includes/widgets/mortgage-calculator/mortgage-calculator.php' );


/**
 * Forms
 */
include_once( IRE_PLUGIN_DIR . 'includes/forms/members.php' );
include_once( IRE_PLUGIN_DIR . 'includes/forms/contact.php' );
include_once( IRE_PLUGIN_DIR . 'includes/forms/property.php' );
include_once( IRE_PLUGIN_DIR . 'includes/forms/search.php' );
include_once( IRE_PLUGIN_DIR . 'includes/forms/profile.php' );
include_once( IRE_PLUGIN_DIR . 'includes/forms/agent.php' );
include_once( IRE_PLUGIN_DIR . 'includes/forms/currency.php' );


/**
 * Social Navigations
 */
include_once( IRE_PLUGIN_DIR . 'includes/social-navs.php' );

/**
 * The core plugin class
 */
require IRE_PLUGIN_DIR . 'includes/class-inspiry-real-estate.php';
$inspiry_real_estate = Inspiry_Real_Estate::get_instance();
$inspiry_real_estate->run();