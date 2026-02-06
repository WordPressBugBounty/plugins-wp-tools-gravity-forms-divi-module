<?php

namespace WPT\DiviGravity\WP;

/**
 * Bootstrap class
 */
class Bootstrap
{
    protected $container;

    /**
     * Constructor.
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * Register activation hook
     */
    public function register_activation_hook()
    {
        flush_rewrite_rules(true);
    }

    /**
     * On plugins loaded action call
     */
    public function plugins_loaded()
    {
        // register_block_type( $this->container['dir'] . '/divi-5/visual-builder/src/modules/gravity-form-module' );
        load_plugin_textdomain(
            'wp-tools-gravity-forms-divi-module',
            false,
            dirname(plugin_basename($this->container['file'])) . '/languages/'
        );
    }


    public function after_license_change($status, $plan)
    {
        $expected_plans = ['downgraded', 'cancelled', 'expired', 'trial_expired'];
        if (in_array($status, $expected_plans)) {
            if (class_exists('\ET_Core_PageResource')) {
                \ET_Core_PageResource::remove_static_resources('all', 'all');
            }
        }
    }
}
