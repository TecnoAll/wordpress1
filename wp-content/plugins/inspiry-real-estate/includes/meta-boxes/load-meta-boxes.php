<?php
/**
 * Meta box related code.
 */

// Deactivate Meta Box Plugin and related extensions if Installed
add_action( 'init', function() {

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	// Meta Box Plugin
	if ( is_plugin_active( 'meta-box/meta-box.php' ) ) {
		deactivate_plugins( 'meta-box/meta-box.php' );
		add_action( 'admin_notices', function () {
			?>
			<div class="update-nag notice is-dismissible">
				<p><strong><?php esc_html_e( 'Meta Box plugin has been deactivated!', 'inspiry-real-estate' ); ?></strong></p>
				<p><?php esc_html_e( 'As now its functionality is embedded with in Inspiry Real Estate plugin.', 'inspiry-real-estate' ); ?></p>
				<p><em><?php esc_html_e( 'So, You should completely remove it from your plugins.', 'inspiry-real-estate' ); ?></em></p>
			</div>
			<?php
		} );
	}

	// Meta Box Columns Extension
	if ( is_plugin_active( 'meta-box-columns/meta-box-columns.php' ) ) {
		deactivate_plugins( 'meta-box-columns/meta-box-columns.php' );
		add_action( 'admin_notices', function () {
			?>
			<div class="update-nag notice is-dismissible">
				<p>
					<strong><?php esc_html_e( 'Meta Box Columns plugin has been deactivated!', 'inspiry-real-estate' ); ?></strong>
					&nbsp;<?php esc_html_e( 'As now its functionality is embedded with in Inspiry Real Estate plugin.', 'inspiry-real-estate' ); ?>
				</p>
				<p><em><?php esc_html_e( 'So, You should completely remove it from your plugins.', 'inspiry-real-estate' ); ?></em></p>
			</div>
			<?php
		} );
	}

	// Meta Box Tabs Extension
	if ( is_plugin_active( 'meta-box-tabs/meta-box-tabs.php' ) ) {
		deactivate_plugins( 'meta-box-tabs/meta-box-tabs.php' );
		add_action( 'admin_notices', function () {
			?>
			<div class="update-nag notice is-dismissible">
				<p>
					<strong><?php esc_html_e( 'Meta Box Tabs plugin has been deactivated!', 'inspiry-real-estate' ); ?></strong>
					&nbsp;<?php esc_html_e( 'As now its functionality is embedded with in Inspiry Real Estate plugin.', 'inspiry-real-estate' ); ?>
				</p>
				<p><em><?php esc_html_e( 'So, You should completely remove it from your plugins.', 'inspiry-real-estate' ); ?></em></p>
			</div>
			<?php
		} );
	}

	// Meta Box Show Hide Extension
	if ( is_plugin_active( 'meta-box-show-hide/meta-box-show-hide.php' ) ) {
		deactivate_plugins( 'meta-box-show-hide/meta-box-show-hide.php' );
		add_action( 'admin_notices', function () {
			?>
			<div class="update-nag notice is-dismissible">
				<p>
					<strong><?php esc_html_e( 'Meta Box Show Hide plugin has been deactivated!', 'inspiry-real-estate' ); ?></strong>
					&nbsp;<?php esc_html_e( 'As now its functionality is embedded with in Inspiry Real Estate plugin.', 'inspiry-real-estate' ); ?>
				</p>
				<p><em><?php esc_html_e( 'So, You should completely remove it from your plugins.', 'inspiry-real-estate' ); ?></em></p>
			</div>
			<?php
		} );
	}

	// Meta Box Group Extension
	if ( is_plugin_active( 'meta-box-group/meta-box-group.php' ) ) {
		deactivate_plugins( 'meta-box-group/meta-box-group.php' );
		add_action( 'admin_notices', function () {
			?>
			<div class="update-nag notice is-dismissible">
				<p>
					<strong><?php esc_html_e( 'Meta Box Group plugin has been deactivated!', 'inspiry-real-estate' ); ?></strong>
					&nbsp;<?php esc_html_e( 'As now its functionality is embedded with in Inspiry Real Estate plugin.', 'inspiry-real-estate' ); ?>
				</p>
				<p><em><?php esc_html_e( 'So, You should completely remove it from your plugins.', 'inspiry-real-estate' ); ?></em></p>
			</div>
			<?php
		} );
	}

} );


// Embedded meta box plugin
if ( ! class_exists( 'RWMB_Core' ) ) {
	require_once ( IRE_PLUGIN_DIR . 'includes/meta-boxes/meta-box/meta-box.php' );
}

// Columns extension
if ( !class_exists( 'RWMB_Columns' ) ) {
	require_once ( IRE_PLUGIN_DIR . 'includes/meta-boxes/meta-box-extensions/meta-box-columns/meta-box-columns.php' );
}

// Show Hide extension
if ( !class_exists( 'RWMB_Show_Hide' ) ) {
	require_once ( IRE_PLUGIN_DIR . 'includes/meta-boxes/meta-box-extensions/meta-box-show-hide/meta-box-show-hide.php' );
}

// Tabs extension
if ( !class_exists( 'RWMB_Tabs' ) ) {
	require_once ( IRE_PLUGIN_DIR . 'includes/meta-boxes/meta-box-extensions/meta-box-tabs/meta-box-tabs.php' );
}

// Group extension
if ( !class_exists( 'RWMB_Group' ) ) {
	require_once ( IRE_PLUGIN_DIR . 'includes/meta-boxes/meta-box-extensions/meta-box-group/meta-box-group.php' );
}
// Taxonomy Term Extension
require_once ( IRE_PLUGIN_DIR . 'includes/meta-boxes/meta-box-extensions/mb-term-meta/mb-term-meta.php' );
