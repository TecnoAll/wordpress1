<div id="site-logo" class="site-logo">
    <div class="logo-inner-wrapper">
        <?php
        global $inspiry_options;
        $logo_image_classes = '';
        $inspiry_site_name  = get_bloginfo( 'name' );
        $inspiry_tag_line   = get_bloginfo( 'description' );

        if ( isset( $inspiry_options['inspiry_logo_on_print'] ) && '1' === $inspiry_options['inspiry_logo_on_print'] ) {
	        $logo_image_classes .= 'hide-on-print';
        }else{
	        if ( isset( $inspiry_options['inspiry_logo_invert_on_print'] ) && '1' === $inspiry_options['inspiry_logo_invert_on_print'] ) {
		        $logo_image_classes .= 'invert-on-print';
	        }
        }
        
        if ( function_exists( 'has_custom_logo' ) && has_custom_logo() && ( ! empty( get_custom_logo() ) ) ) {

	        the_custom_logo();

        } elseif ( !empty( $inspiry_options['inspiry_logo'] ) && !empty( $inspiry_options['inspiry_logo']['url'] ) ) {

            /*
             * Image based logo
             */
            $inspiry_logo = $inspiry_options['inspiry_logo']['url'];
            $inspiry_logo_url = inspiry_filter_protocol( $inspiry_logo );
            ?><a href="<?php echo esc_url( home_url('/') ); ?>"><img class="<?php echo esc_attr( $logo_image_classes ); ?>" src="<?php echo esc_url( $inspiry_logo_url ); ?>" alt="<?php echo esc_attr( $inspiry_site_name ); ?>" /></a><?php

        } else {

            /*
             * Text based logo
             */
            if ( is_front_page() || is_home() || is_page_template( 'page-templates/home.php' ) ) {
                ?><h1 class="site-title"><a href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><?php echo esc_html( $inspiry_site_name ); ?></a></h1><?php
            } else {
                ?><h2 class="site-title"><a href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><?php echo esc_html( $inspiry_site_name ); ?></a></h2><?php
            }

        }

        if( ! empty( $inspiry_tag_line ) ) {
            ?><small class="tag-line"><?php echo esc_html( $inspiry_tag_line ); ?></small><?php
        }
        ?>
    </div><!-- /.logo-inner-wrapper -->
</div>
<!-- /#site-logo -->