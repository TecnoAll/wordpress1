<?php
/*
 * Payments Options
 */
global $opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Payments', 'inspiry' ),
    'id'    => 'payments-section',
    'desc'  => esc_html__( 'This section contains options related to payments for submitted properties.', 'inspiry' ),
    'fields'=> array(

        array(
            'id'       => 'inspiry_payment_via_paypal',
            'type'     => 'switch',
            'title'    => esc_html__( 'PayPal Payments', 'inspiry' ),
            'subtitle' => esc_html__( 'Enable payment via PayPal ?', 'inspiry' ),
            'default'  => 1,
            'on'       => esc_html__( 'Enable', 'inspiry' ),
            'off'      => esc_html__( 'Disable', 'inspiry' ),
        ),
        array(
            'id'       => 'inspiry_paypal_ipn_url',
            'type'     => 'text',
            'title'    => esc_html__( 'PayPal IPN URL', 'inspiry' ),
            'subtitle' => esc_html__( 'It is a must', 'inspiry' ),
            'desc'     => esc_html__( 'Install "PayPal IPN for WordPress" plugin and get IPN URL from Settings > PayPal IPN.', 'inspiry' ),
            'validate' => 'url',
            'required' => array( 'inspiry_payment_via_paypal', '=', '1' ),
        ),
        array(
            'id'       => 'inspiry_paypal_merchant_id',
            'type'     => 'text',
            'title'    => esc_html__( 'PayPal Merchant Account ID or Email', 'inspiry' ),
            'required' => array( 'inspiry_payment_via_paypal', '=', '1' ),
        ),
        array(
            'id'       => 'inspiry_paypal_sandbox',
            'type'     => 'switch',
            'title'    => esc_html__( 'PayPal Sandbox', 'inspiry' ),
            'subtitle' => esc_html__( 'Enable PayPal sandbox for testing', 'inspiry' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enable', 'inspiry' ),
            'off'      => esc_html__( 'Disable', 'inspiry' ),
            'required' => array( 'inspiry_payment_via_paypal', '=', '1' ),
        ),
        array(
            'id'       => 'inspiry_paypal_payment_amount',
            'type'     => 'text',
            'title'    => esc_html__( 'Payment Amount for a Property', 'inspiry' ),
            'desc'     => esc_html__( 'Provide the amount that you want to charge for a property. Example: 20.00', 'inspiry' ),
            'default'  => '20.00',
            'required' => array( 'inspiry_payment_via_paypal', '=', '1' ),
        ),
        array(
            'id'       => 'inspiry_paypal_currency_code',
            'type'     => 'text',
            'title'    => esc_html__( 'Currency Code', 'inspiry' ),
            'desc'     => esc_html__( 'Provide the currency code that you want to use. Example: USD', 'inspiry' ),
            'default'  => 'USD',
            'required' => array( 'inspiry_payment_via_paypal', '=', '1' ),
        ),
        array(
            'id'       => 'inspiry_publish_on_payment',
            'type'     => 'switch',
            'title'    => esc_html__( 'Auto Action on Successful Payment', 'inspiry' ),
            'default'  => 0,
            'on'       => esc_html__( 'Publish the Property', 'inspiry' ),
            'off'      => esc_html__( 'Do Nothing', 'inspiry' ),
            'required' => array( 'inspiry_payment_via_paypal', '=', '1' ),
        ),
        /*
         * Todo: Email for payment notification
        array(
            'id'       => 'inspiry_payment_notification_email',
            'type'     => 'text',
            'title'    => esc_html__( 'Email for Payment Notification', 'inspiry' ),
            'desc'     => esc_html__( 'Given email address will receive payment notifications.', 'inspiry' ),
            'required' => array( 'inspiry_payment_via_paypal', '=', 1 ),
            'validate' => 'email',
        ),
        */

    ) ) );