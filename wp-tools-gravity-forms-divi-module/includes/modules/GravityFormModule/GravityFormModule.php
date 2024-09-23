<?php

namespace WPT_Divi_Gravity_Modules\GravityFormModule;

use ET_Builder_Module;
use ET_Builder_Element;
/**
 * GravityFormModule.
 */
class GravityFormModule extends ET_Builder_Module {
    public $main_css_element = 'section%%order_class%%';

    public $name = 'Gravity Form';

    public $slug = 'et_pb_wpt_gravityform';

    public $vb_support = 'on';

    protected $container;

    protected $module_credits = [
        'module_uri' => 'https://wptools.app/wordpress-plugin/gravity-forms-divi-module/?utm_source=divi-module&utm_medium=page&utm_campaign=gf-divi&utm_content=free',
        'author'     => 'WP Tools → Get 7 day FREE Trial',
        'author_uri' => 'https://wptools.app/wordpress-plugin/gravity-forms-divi-module/?utm_source=divi-module&utm_medium=page&utm_campaign=gf-divi&utm_content=free#pricing',
    ];

    /**
     * Constructor.
     */
    public function __construct( $container ) {
        $this->container = $container;
        $this->container['gf_divi_fields']->set_module( $this );
        parent::__construct();
    }

    /**
     * Advanced fields.
     */
    public function get_advanced_fields_config() {
        return [
            'border'                => false,
            'borders'               => false,
            'text'                  => false,
            'box_shadow'            => false,
            'filters'               => false,
            'animation'             => false,
            'text_shadow'           => false,
            'max_width'             => false,
            'margin_padding'        => false,
            'custom_margin_padding' => false,
            'background'            => false,
            'fonts'                 => false,
            'link_options'          => false,
        ];
    }

    /**
     * Custom css fields.
     */
    public function get_custom_css_fields_config() {
        return [];
    }

    /**
     * Divi module fields.
     *
     * @return [type] [description]
     */
    public function get_fields() {
        $fields = $this->container['gf_divi_fields']->get_fields();
        return $fields;
    }

    /**
     * Get default for given keys
     */
    public function get_default( $key ) {
        return $this->container['gf_divi_fields']->get_default( $key );
    }

    /**
     * Get the selector.
     */
    public function get_selector( $key ) {
        return $this->container['gf_divi_fields']->get_selector( $key );
    }

    /**
     * Settings modal toggle
     *
     * @return [type] [description]
     */
    public function get_settings_modal_toggles() {
        return $this->get_settings_modal_toggles__free();
    }

    /**
     * Freely available options.
     */
    public function get_settings_modal_toggles__free() {
        return [
            'general' => [
                'toggles' => [
                    'main_content' => esc_html__( 'Shortcode Parameters', 'wp-tools-gravity-forms-divi-module' ),
                ],
            ],
        ];
    }

    public function init() {
    }

    /**
     * Render function
     *
     * @param  [type] $unprocessed_props [description]
     * @param  [type] $content           [description]
     * @param  [type] $render_slug       [description]
     * @return [type] [description]
     */
    public function render( $unprocessed_props, $content = null, $render_slug = null ) {
        $module_classes = $this->module_classname( $render_slug );
        $is_sticky = ( strpos( $module_classes, 'et_pb_sticky_module' ) !== false ?: false );
        $module_class = trim( ET_Builder_Element::add_module_order_class( '', $render_slug ) );
        $defaults = wp_parse_args( $unprocessed_props, $this->container['gf_divi_fields']->get_defaults() );
        foreach ( $defaults as $key => $value ) {
            if ( isset( $this->props[$key] ) and empty( $this->props[$key] ) ) {
                $this->props[$key] = $value;
            }
        }
        $props = wp_parse_args( $this->props, $defaults );
        $this->container[$render_slug] = $props;
        $this->container['divi']->enqueue_et_pb_wpt_gravityform_assets();
        $main_selector = 'section.' . $module_class;
        $gravityform_id = $this->container['gravityform']->get_unprefixed_gravityform_id( $props['gravityform_id'] );
        $post_id = null;
        // phpcs:ignore WordPress.Security.NonceVerification
        if ( wp_doing_ajax() && isset( $_POST['options'], $_POST['options']['current_page'], $_POST['options']['current_page']['id'] ) ) {
            // phpcs:ignore WordPress.Security.NonceVerification
            $post_id = (int) $_POST['options']['current_page']['id'];
        } else {
            global $post;
            if ( $post ) {
                $post_id = $post->ID;
            }
        }
        $gravityform_id = apply_filters( 'wpt_divi_gravity_form_id', $gravityform_id, $post_id );
        $gravityform_shortcode = sprintf(
            '[gravityform id=%1$s title=%2$s description=%3$s ajax=%4$s tabindex=%5$s  field_values="%6$s"/]',
            $gravityform_id,
            ( $props['title'] == 'on' ? 'true' : 'false' ),
            ( $props['description'] == 'on' ? 'true' : 'false' ),
            ( $props['ajax'] == 'on' ? 'true' : 'false' ),
            $props['tabindex'],
            $props['field_values']
        );
        \ET_Builder_Element::set_style( $render_slug, [
            'selector'    => $this->container['gf_divi_fields']->get_selector( 'description' ),
            'declaration' => 'display:block;',
        ] );
        // premium styles
        // checkbox input fix
        \ET_Builder_Element::set_style( $render_slug, [
            'selector'    => "{$main_selector} .gform_wrapper .gfield_checkbox .gchoice input[type='checkbox'], {$main_selector} .gform_wrapper .ginput_container_consent input[type='checkbox']",
            'declaration' => 'vertical-align:middle;',
        ] );
        \ET_Builder_Element::set_style( $render_slug, [
            'selector'    => "{$main_selector} .gform_wrapper .gfield_radio input[type='radio']",
            'declaration' => 'vertical-align:middle;',
        ] );
        ob_start();
        require $this->container['dir'] . '/resources/views/et_pb_wpt_gravityform.php';
        return ob_get_clean();
    }

}
