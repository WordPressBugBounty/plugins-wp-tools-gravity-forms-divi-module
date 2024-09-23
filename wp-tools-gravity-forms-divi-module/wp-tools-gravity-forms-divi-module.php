<?php
/**
 * Plugin Name:     WP Tools Gravity Forms Divi Module
 * Description:     A versatile divi module to integrate gravity forms with divi theme builder. Create custom-designed forms for your website using wide-range of style customization options. No programming experience needed.
 * Author:          WP Tools
 * Author URI:      https://wptools.app
 * Text Domain:     wp-tools-gravity-forms-divi-module
 * Domain Path:     /languages
 * Version:         8.5.0
 *
 * @package         Wp_Tools_Gravity_Divi_Module
 */

require_once __DIR__ . '/freemius.php';
wptools_gf_divi()->add_filter(
    'show_first_trial_after_n_sec',
    function ( $day_in_sec ) {
        return 1;
    }
);

require_once __DIR__ . '/vendor/autoload.php';

$loader = \WPT\DiviGravity\Loader::get_instance();

$loader['name']    = 'WP Tools Gravity Forms Divi Module';
$loader['version'] = '8.5.0';
$loader['dir']     = __DIR__;
$loader['url']     = plugins_url( '/' . basename( __DIR__ ) );
$loader['file']    = __FILE__;
$loader['slug']    = 'wp-tools-gravity-forms-divi-module';

$loader->run();
