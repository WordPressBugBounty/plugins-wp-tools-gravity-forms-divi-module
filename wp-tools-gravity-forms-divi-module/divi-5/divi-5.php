<?php

if ( !function_exists( 'wpt_divi5_gravity_form_enqueue_visual_builder_assets' ) ) {
    /**
     * Enqueue Divi 5 Visual Builder Assets
     *
     * @since 1.0.0
     */
    function wpt_divi5_gravity_form_enqueue_visual_builder_assets() {
        $loader = wpt_divi_gf_container();
        if ( et_core_is_fb_enabled() && et_builder_d5_enabled() ) {
            wp_enqueue_script(
                'wpt-d5-divi-gravity-form',
                $loader['url'] . '/divi-5/visual-builder/build/d5-divi-gravity-form.js',
                [
                    'react',
                    'jquery-core',
                    'divi-module-library',
                    'wp-hooks',
                    'divi-rest',
                    'divi-module-library',
                    'divi-vendor-wp-hooks',
                    'wp-i18n'
                ],
                '1.0.0',
                true
            );
        }
        wp_enqueue_style( 'wpt-d5-divi-gravity-form' );
        $check = false;
        $check_value = ( $check ? 'true' : 'false' );
        wp_add_inline_script( 'wpt-d5-divi-gravity-form', "window._xP9zQfA1 = {$check_value};", 'before' );
    }

}
add_action( 'divi_visual_builder_assets_before_enqueue_scripts', 'wpt_divi5_gravity_form_enqueue_visual_builder_assets' );
add_action( 'init', function () {
    $loader = wpt_divi_gf_container();
    wp_register_style(
        'wpt-d5-divi-gravity-form',
        $loader['url'] . '/divi-5/visual-builder/styles/bundle.css',
        false,
        $loader['version']
    );
} );