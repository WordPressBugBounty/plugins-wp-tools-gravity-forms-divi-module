<?php

if ( !function_exists( 'wptools_gf_divi' ) ) {
    // Create a helper function for easy SDK access.
    function wptools_gf_divi() {
        global $wptools_gf_divi;
        if ( !isset( $wptools_gf_divi ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $wptools_gf_divi = fs_dynamic_init( [
                'id'             => '4404',
                'slug'           => 'wp-tools-gravity-forms-divi-module',
                'type'           => 'plugin',
                'public_key'     => 'pk_46a480965cb088f7696e158a4b7e6',
                'is_premium'     => false,
                'premium_suffix' => 'Premium',
                'has_addons'     => false,
                'has_paid_plans' => true,
                'trial'          => [
                    'days'               => 7,
                    'is_require_payment' => false,
                ],
                'menu'           => [
                    'slug'    => 'wp-tools-gravity-forms-divi-module',
                    'support' => false,
                    'parent'  => [
                        'slug' => 'et_divi_options',
                    ],
                ],
                'is_live'        => true,
            ] );
        }
        return $wptools_gf_divi;
    }

    // Init Freemius.
    wptools_gf_divi();
    // Signal that SDK was initiated.
    do_action( 'wptools_gf_divi_loaded' );
}