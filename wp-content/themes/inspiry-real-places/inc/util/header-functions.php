<?php
/*
 * Dynamic CSS
 */
require_once( get_template_directory() . '/css/dynamic-css.php' );

if ( ! function_exists( 'inspiry_quick_css' ) ) :
	/**
	 * Generate Quick CSS
	 */
	function inspiry_quick_css( $realplaces_custom_css ){
		global $inspiry_options;
		if ( isset( $inspiry_options[ 'inspiry_quick_css' ] ) ) {
			// Quick CSS from Theme Options
			$quick_css = stripslashes( $inspiry_options[ 'inspiry_quick_css' ] );
			if ( ! empty( $quick_css ) ) {
				$realplaces_custom_css .= strip_tags( $quick_css ) . "\n";
			}
		}

		return $realplaces_custom_css;
	}
endif;

if( ! function_exists( 'inspiry_quick_js' ) ) :
    /**
     * Generate Quick JS
     */
    function inspiry_quick_js( $realplaces_custom_js ){
        global $inspiry_options;
        if ( isset( $inspiry_options[ 'inspiry_quick_js' ] ) ) {
            // Quick JS from Theme Options
            $quick_js = stripslashes( $inspiry_options[ 'inspiry_quick_js' ] );
            if( ! empty( $quick_js )){
	            $realplaces_custom_js .= esc_js( $quick_js ) . "\n";
            }
        }

	    return $realplaces_custom_js;
    }

endif;

if ( ! is_admin() ) {
	add_filter( 'realplaces_custom_css', 'inspiry_quick_css' );
	add_filter( 'realplaces_custom_js', 'inspiry_quick_js' );
}

if ( ! function_exists( 'inspiry_get_banner_image' ) ) :
	/**
	 * Get banner image
	 * @return bool|string
	 */
	function inspiry_get_banner_image() {
		global $post;

		if ( is_home() ) {
			$blog_id         = get_option( 'page_for_posts' );
			$banner_image_id = get_post_meta( $blog_id, 'REAL_HOMES_page_banner_image', true );
			if ( $banner_image_id ) {
				return wp_get_attachment_url( $banner_image_id );
			}
		} else if ( isset( $post->ID ) ) {
			if ( is_page_template( 'page-templates/home.php' ) ) {
				$banner_image_id = get_post_meta( $post->ID, 'inspiry_homepage_banner_image', true );
			} else {
				$banner_image_id = get_post_meta( $post->ID, 'REAL_HOMES_page_banner_image', true );
			}

			if ( $banner_image_id ) {
				return wp_get_attachment_url( $banner_image_id );
			}
		}
		return inspiry_get_default_banner();
	}
endif;

if ( ! function_exists( 'inspiry_get_default_banner' ) ) :
	/**
	 * Get default banner
	 * @return string
	 */
	function inspiry_get_default_banner() {
		global $inspiry_options;
		$banner_image_path = null;
		if ( !empty( $inspiry_options['inspiry_banner_image'] ) ) {
			$banner_image_path = $inspiry_options['inspiry_banner_image']['url'];
		}
		return empty( $banner_image_path ) ? esc_url( get_template_directory_uri() . '/images/banner.png' ) : $banner_image_path;
	}
endif;