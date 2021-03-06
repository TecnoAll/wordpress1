<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
    <?php
    global $inspiry_options;

    /*
     * Page loader
     */
    if ( $inspiry_options[ 'inspiry_page_loader' ] == '1' ) {
        $page_loader_gif = get_template_directory_uri() . '/images/page-loader-img.gif';
        if ( !empty( $inspiry_options['inspiry_page_loader_gif']['url'] ) ) {
            $page_loader_gif = $inspiry_options['inspiry_page_loader_gif']['url'];
        }
        ?>
        <div class="page-loader">
            <img class="page-loader-img" src="<?php echo esc_url( $page_loader_gif ); ?>" alt="<?php esc_attr_e( 'Loading...', 'inspiry' ); ?>"/>
        </div>
        <?php
    }
    ?>

    <div id="mobile-header" class="mobile-header hidden-md hidden-lg">
        <?php
        get_template_part( 'partials/header/contact-number' );
        get_template_part( 'partials/header/currency-switcher' );
        ?>
        <div class="mobile-header-nav hide">
            <div class="mobile-header-nav-wrapper">
                <?php
                get_template_part( 'partials/header/user-nav' );
                get_template_part( 'partials/header/social-networks' );
                ?>
            </div>
        </div>
    </div>

    <?php

    if ( $inspiry_options[ 'inspiry_header_variation' ] == '1' ) {
        get_template_part( 'partials/header/variation-one' );
    } elseif($inspiry_options[ 'inspiry_header_variation' ] == '2') {
        get_template_part( 'partials/header/variation-two' );
    } else {
        get_template_part( 'partials/header/variation-three' );
    }
    ?>