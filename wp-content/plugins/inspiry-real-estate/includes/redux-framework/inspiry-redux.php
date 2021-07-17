<?php // phpcs:ignore Squiz.Commenting.FileComment.Missing

if ( ! defined( 'REDUX_PLUGIN_FILE' ) ) {
	define( 'REDUX_PLUGIN_FILE', __FILE__ );
}

// Require the main plugin class.
require_once plugin_dir_path( __FILE__ ) . 'class-redux-framework-plugin.php';

// Get plugin instance.
Redux_Framework_Plugin::instance();

