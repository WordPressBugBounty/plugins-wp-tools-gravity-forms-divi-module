<?php

namespace WPT\DiviGravity\WP;

/**
 * Admin.
 */
class Admin
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
     * Admin notice = gf default theme check
     */
    public function default_theme_notice()
    {
        $theme_slug = get_option('rg_gforms_default_theme', 'gravity-theme');

        if ('gravity-theme' === $theme_slug || get_user_meta(get_current_user_id(), 'wpt_divi_gf_default_theme_check', true)) {
            return;
        }

        $gf_settings_page = sprintf('<a href="%s">Gravity Forms Settings</a>', admin_url('admin.php?page=gf_settings'));

        echo '<div class="notice notice-warning is-dismissible" data-notice="wpt_divi_gf_default_theme_check_notice">
        <p>
            <b>Important Update:</b> Gravity Forms has introduced a new default theme, "Orbital," designed for WordPress block builders.
        </p>
        <p>
            For optimal compatibility with our Divi Themes-based Gravity Forms plugin, <b>we strongly recommend using the "Gravity Forms 2.5 Theme." theme</b>. Please check your existing form styles, if any, after the switch.
        </p>
        <p>
            To switch to the "Gravity Forms 2.5 Theme," please follow this tutorial:
            <a href="https://youtu.be/59yvsReHgBc" target="_blank">Watch Video</a>.
        </p>
        <p><b>Note:</b> Your current gravity forms theme is <b>"' . esc_attr($theme_slug) . '"</b>. To change the setting visit ';

        echo $gf_settings_page; // phpcs:ignore
        echo '</p>;
    </div>';
    }

    /**
     * Load admin script
     */
    function default_theme_notice_enqueue_scripts()
    {
        wp_enqueue_script(
            'wpt-divi-gf-admin-notice',
            $this->container['url'] . '/js/admin-notice.js',
            ['jquery'],
            false,
            true
        );
        wp_localize_script(
            'wpt-divi-gf-admin-notice',
            'wptGfDiviAjax',
            [
                'ajax_url' => admin_url('admin-ajax.php'),
            ]
        );
    }

    /**
     * Ajax call to set that the notice has been acknowledged
     */
    function ajax_wpt_divi_gf_default_theme_check_notice()
    {
        update_user_meta(get_current_user_id(), 'wpt_divi_gf_default_theme_check', 1);
        wp_send_json_success();
    }
}
