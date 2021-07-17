<?php
/**
 * Inspiry Sidebar
 * A simple class that adds a "add sidebar area" form to the widget page and allows to create widgets on the fly
 *
 */

if ( ! class_exists( 'inspiry_sidebar' ) ) {
	class inspiry_sidebar {
		var $sidebars = array();
		var $stored = "";

		//constructor, makes sure that we only load most of the stuff on the widget page, except for the register sidebar function
		function __construct() {
			$this->stored       = 'inspiry_sidebars';
			$this->title        = wp_get_theme()->get( 'Name' ) . " - " . esc_html__( 'Custom Widget Area', 'inspiry-real-estate' );

			add_action( 'load-widgets.php', array( $this, 'load_assets' ), 5 );
			add_action( 'widgets_init', array( $this, 'register_custom_sidebars' ), 1000 );
			add_action( 'wp_ajax_inspiry_ajax_delete_custom_sidebar', array( $this, 'delete_sidebar_area' ), 1000 );
		}

		//load backend css, js and add hooks to the widget page
		function load_assets() {
			add_action( 'admin_print_scripts', array( $this, 'template_add_widget_field' ) );
			add_action( 'load-widgets.php', array( $this, 'add_sidebar_area' ), 100 );

			wp_enqueue_script( 'inspiry_sidebar', IRE_PLUGIN_URL . 'includes/sidebars/sidebar.js' );
			wp_enqueue_style( 'inspiry_sidebar', IRE_PLUGIN_URL . 'includes/sidebars/sidebar.css' );
		}


		//js template that gets attached to the widget area so the user can add widget names
		function template_add_widget_field() {
			$nonce = wp_create_nonce( 'inspiry-delete-custom-sidebar-nonce' );
			$nonce = '<input type="hidden" name="inspiry-delete-custom-sidebar-nonce" value="' . $nonce . '" />';

			echo "\n<script type='text/html' id='inspiry-tmpl-add-widget'>";
			echo "\n  <form class='inspiry-add-widget' method='POST'>";
			echo "\n  <h3>" . $this->title . "</h3>";
			echo "\n    <span class='inspiry_style_wrap'><input type='text' value='' placeholder = '" . esc_html__( 'Enter new Widget Area name here', 'inspiry-real-estate' ) . "' name='inspiry-add-widget' class='regular-text' /></span>";
			echo "\n    <input class='inspiry_button button button-primary' type='submit' value='" . esc_html__( 'Add Widget Area', 'inspiry-real-estate' ) . "' />";
			echo "\n    " . $nonce;
			echo "\n  </form>";
			echo "\n</script>\n";
		}


		//adds a sidebar area to the database
		function add_sidebar_area() {
			if ( ! empty( $_POST['inspiry-add-widget'] ) ) {
				$this->sidebars = get_option( $this->stored );
				$name           = $this->get_name( $_POST['inspiry-add-widget'] );

				if ( empty( $this->sidebars ) ) {
					$this->sidebars = array( $name );
				} else {
					$this->sidebars = array_merge( $this->sidebars, array( $name ) );
				}

				update_option( $this->stored, $this->sidebars );
				wp_redirect( admin_url( 'widgets.php' ) );
				die();
			}
		}

		//delete a sidebar area from the database
		function delete_sidebar_area() {
			check_ajax_referer( 'inspiry-delete-custom-sidebar-nonce' );

			if ( ! empty( $_POST['name'] ) ) {
				$name           = stripslashes( $_POST['name'] );
				$this->sidebars = get_option( $this->stored );

				if ( ( $key = array_search( $name, $this->sidebars ) ) !== false ) {
					unset( $this->sidebars[ $key ] );
					update_option( $this->stored, $this->sidebars );
					echo "sidebar-deleted";
				}
			}

			die();
		}


		//checks the user submitted name and makes sure that there are no coalitions
		function get_name( $name ) {
			if ( empty( $GLOBALS['wp_registered_sidebars'] ) ) {
				return $name;
			}

			$taken = array();
			foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
				$taken[] = $sidebar['name'];
			}

			if ( empty( $this->sidebars ) ) {
				$this->sidebars = array();
			}
			$taken = array_merge( $taken, $this->sidebars );

			if ( in_array( $name, $taken ) ) {
				$counter  = substr( $name, - 1 );
				$new_name = "";

				if ( ! is_numeric( $counter ) ) {
					$new_name = $name . " 1";
				} else {
					$new_name = substr( $name, 0, - 1 ) . ( (int) $counter + 1 );
				}

				$name = $this->get_name( $new_name );
			}

			return $name;
		}


		//register custom sidebar areas
		function register_custom_sidebars() {
			if ( empty( $this->sidebars ) ) {
				$this->sidebars = get_option( $this->stored );
			}

			$args = array(
				'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widgettitle">',
				'after_title'   => '</h3>'
			);


			$args = apply_filters( 'inspiry_custom_widget_args', $args );

			if ( is_array( $this->sidebars ) ) {
				foreach ( $this->sidebars as $sidebar ) {
					$args['name'] = $sidebar;

					$args['id']    = inspiry_backend_safe_string( $sidebar, '-' );
					$args['class'] = 'inspiry-custom';
					register_sidebar( $args );
				}
			}
		}
	}
}

// instance of inspiry_sidebar class (initiate)
new inspiry_sidebar();