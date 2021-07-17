<?php
global $inspiry_options;
if ( ! empty( $inspiry_options['inspiry_header_phone'] ) ) {
    $contact_icon = 'icon-phone';

    if( $inspiry_options[ 'inspiry_header_variation' ] == '3' ) {
        $contact_icon = 'icon-phone-two';
    }
    ?>
    <div class="contact-number">
        <?php include( get_template_directory() . '/images/svg/' . $contact_icon .  '.svg' ); ?>
        <a class="mobile-version" href="tel://<?php echo esc_attr( $inspiry_options['inspiry_header_phone'] ); ?>"><?php echo esc_html( $inspiry_options['inspiry_header_phone'] ); ?></a>
    </div><!-- .contact-number -->
    <?php
}
?>

