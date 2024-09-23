<?php

namespace WPT\DiviGravity\Divi;

use WPT_Divi_Gravity_Modules\GravityFormExtension;
use WPT_Divi_Gravity_Modules\GravityFormModule\GravityFormModule;
/**
 * Divi.
 */
class Divi {
    protected $container;

    /**
     * Constructor.
     */
    public function __construct( $container ) {
        $this->container = $container;
    }

    /**
     * Register divi extension
     *
     * @return [type] [description]
     */
    public function divi_extensions_init() {
        new GravityFormExtension($this->container);
    }

    /**
     * Enqueue assets for divi modules
     */
    public function enqueue_divi_module_assets() {
        if ( isset( $_GET['et_fb'] ) and $_GET['et_fb'] == '1' ) {
            $this->enqueue_et_pb_wpt_gravityform_assets();
        }
    }

    /**
     * Load assets for the carousel image.
     */
    public function enqueue_et_pb_wpt_gravityform_assets() {
        if ( is_rtl() ) {
            wp_enqueue_style( 'gforms_rtl_css' );
        }
        $theme_slug = get_option( 'rg_gforms_default_theme', 'gravity-theme' );
        if ( 'gravity-theme' === $theme_slug ) {
            wp_enqueue_style( 'gforms_reset_css' );
            wp_enqueue_style( 'gforms_formsmain_css' );
            wp_enqueue_style( 'gforms_ready_class_css' );
            wp_enqueue_style( 'gforms_browsers_css' );
            wp_enqueue_style( 'gform_layout' );
            wp_enqueue_style( 'gform_theme_ie11' );
            wp_enqueue_style( 'gform_basic' );
            wp_enqueue_style( 'gform_theme' );
            if ( is_rtl() ) {
                wp_enqueue_style( 'gforms_rtl_css' );
            }
        }
        if ( 'orbital' === $theme_slug && class_exists( '\\Gravity_Forms\\Gravity_Forms\\Form_Display\\GF_Form_Display_Service_Provider' ) ) {
            $gf_service_provider = new \Gravity_Forms\Gravity_Forms\Form_Display\GF_Form_Display_Service_Provider();
            $gf_service_provider->register_theme_styles();
            wp_enqueue_style( 'gravity_forms_orbital_theme' );
            wp_enqueue_style( 'gravity_forms_theme_foundation' );
            wp_enqueue_style( 'gravity_forms_theme_framework' );
            wp_enqueue_style( 'gravity_forms_theme_reset' );
        }
    }

    /**
     * ET builder ready hook
     *
     * @return [type] [description]
     */
    public function et_builder_ready() {
        new GravityFormModule($this->container);
    }

    /**
     * Get the responsive values for the given prop field
     */
    public function get_responsive_values( $prop_name, $props, $default ) {
        $desktop = et_pb_responsive_options()->get_desktop_value( $prop_name, $props, $default );
        $tablet = et_pb_responsive_options()->get_tablet_value( $prop_name, $props, $desktop );
        $phone = et_pb_responsive_options()->get_phone_value( $prop_name, $props, $tablet );
        return [
            'desktop' => $desktop,
            'tablet'  => $tablet,
            'phone'   => $phone,
        ];
    }

}
