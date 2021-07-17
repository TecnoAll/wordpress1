<div class="favorite-and-print clearfix">
    <?php
    global $inspiry_options;
    $only_print_icon = false;

    if ( isset( $inspiry_options[ 'inspiry_favorites_page' ] ) && !empty( $inspiry_options[ 'inspiry_favorites_page' ] ) ) {

        if ( is_added_to_favorite( get_the_ID() ) ) {
            ?>
            <a id="add-to-favorite" class="add-to-fav added" href="#"><i class="fas fa-star"></i>&nbsp;&nbsp;<span><?php esc_html_e( 'Added to Favorites', 'inspiry' ); ?></span></a>
            <?php
        } else {
            ?>
            <a id="add-to-favorite" class="add-to-fav" href="#"><i class="far fa-star"></i>&nbsp;&nbsp;<span><?php esc_html_e( 'Add to Favorites', 'inspiry' ); ?></span></a>
            <?php
            /*
             * Action hook
             * check inspiry_generate_favorite_data() in inc/util/real-estate-functions.php
             */
            do_action( 'inspiry_add_to_favorites' );
        }

    } else {
        $only_print_icon = true;
    }
    ?>
    <a class="printer-icon <?php if ( $only_print_icon ) { echo 'take-full-width'; } ?>" href="javascript:window.print()"><i class="fas fa-print"></i>&nbsp;&nbsp;<?php esc_html_e( 'Print', 'inspiry' ); ?></a>
</div>