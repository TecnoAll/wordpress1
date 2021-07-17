    <div class="option-bar form-control-buttons">
        <?php
        global $field_counter;
        global $number_search_fields;
        if ( $field_counter < $number_search_fields ) {
            ?><a class="hidden-fields-reveal-btn" href="#"><?php include( IRE_PLUGIN_DIR . 'public/images/icon-plus.svg' ); ?></a><?php
        }
        ?>
        <input type="submit" value="<?php esc_html_e( 'Search', 'inspiry-real-estate' ); ?>" class="form-submit-btn">
    </div>
</div>
<!-- .inline-fields -->
<div class="hidden-fields clearfix">