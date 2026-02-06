<?php

namespace WPT\DiviGravity;

use WPTools\Pimple\Container;
/**
 * Container
 */
class Loader extends Container {
    /**
     *
     * @var mixed
     */
    public static $instance;

    public function __construct() {
        parent::__construct();
        $this['bootstrap'] = function ( $container ) {
            return new WP\Bootstrap($container);
        };
        $this['admin'] = function ( $container ) {
            return new WP\Admin($container);
        };
        $this['divi'] = function ( $container ) {
            return new Divi\Divi($container);
        };
        $this['margin_padding'] = function ( $container ) {
            return new Divi\MarginPadding($container);
        };
        $this['gravityform'] = function ( $container ) {
            return new GravityForm\GravityForm($container);
        };
        $this['gf_divi_fields'] = function ( $container ) {
            return new \WPT_Divi_Gravity_Modules\GravityFormModule\Fields($container);
        };
        $this['api'] = function ( $container ) {
            return new WP\Api($container);
        };
        $this['d5_conversion'] = function ( $container ) {
            return new Divi5\Conversion\Conversion($container);
        };
    }

    /**
     * Get container instance.
     */
    public static function get_instance() {
        if ( !self::$instance ) {
            self::$instance = new Loader();
        }
        return self::$instance;
    }

    /**
     * Plugin run
     */
    public function run() {
        // activation hook
        register_activation_hook( $this['file'], [$this['bootstrap'], 'register_activation_hook'] );
        // on plugins loaded
        add_action( 'init', [$this['bootstrap'], 'plugins_loaded'] );
        //divi actions
        add_action( 'et_builder_ready', [$this['divi'], 'et_builder_ready'], 1 );
        add_action( 'divi_extensions_init', [$this['divi'], 'divi_extensions_init'] );
        add_action( 'wp_enqueue_scripts', [$this['divi'], 'enqueue_divi_module_assets'] );
        add_action( 'admin_notices', [$this['admin'], 'default_theme_notice'] );
        add_action( 'admin_enqueue_scripts', [$this['admin'], 'default_theme_notice_enqueue_scripts'] );
        add_action( 'wp_ajax_wpt_divi_gf_default_theme_check_notice', [$this['admin'], 'ajax_wpt_divi_gf_default_theme_check_notice'] );
        $loader = $this;
        add_action( 'admin_menu', function () use($loader) {
            add_submenu_page(
                'et_divi_options',
                'Gravity Form Divi',
                'Gravity Form Divi',
                'manage_options',
                $loader['slug'],
                function () use($loader) {
                    // phpcs:ignore
                    echo file_get_contents( $loader['dir'] . '/resources/views/sub_menu.html' );
                }
            );
        }, 99 );
        add_action( 'wp_print_styles', function () {
            wp_dequeue_style( 'et_pb_wpt_gravityform-styles' );
        } );
        // to get sticky scroll works. adding to valid slug.
        add_filter(
            'et_builder_get_module_slugs_by_post_type',
            function ( $slugs, $post_type ) {
                if ( !in_array( 'et_pb_wpt_gravityform', $slugs ) ) {
                    $slugs[] = 'et_pb_wpt_gravityform';
                }
                return $slugs;
            },
            99,
            2
        );
        // divi 5
        add_action( 'rest_api_init', function () {
            register_rest_route( 'wpt_divi_gf/v1', '/gravityforms/', [
                'methods'             => 'GET',
                'callback'            => [$this['api'], 'gravityforms'],
                'permission_callback' => function () {
                    return true;
                },
            ] );
        } );
        /**
         * Register "Gravity Form Module"'s REST API Route and endpoint.
         */
        add_action( 'init', function () {
            if ( class_exists( '\\ET\\Builder\\Framework\\Route\\RESTRoute' ) ) {
                $route = new \ET\Builder\Framework\Route\RESTRoute('wpt_divi_gf/v1');
                $route->prefix( '/module-data' )->group( function ( $router ) {
                    $router->get( '/gravity-form-module/gravityform', \WPT\DiviGravity\Divi5\Modules\GravityFormModule\GravityFormModuleController::class );
                } );
            }
        } );
        add_filter( 'divi.conversion.moduleLibrary.conversionMap', [$this["d5_conversion"], "map"], 99 );
        wptools_gf_divi()->add_action(
            'after_license_change',
            [$this['bootstrap'], 'after_license_change'],
            10,
            2
        );
    }

}
