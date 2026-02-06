<?php
/**
 * All modules.
 *
 * @package D5GravityFormModule\Modules;
 */

namespace WPT\DiviGravity\Divi5\Modules;

if ( !defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

use WPT\DiviGravity\Divi5\Modules\GravityFormModule\GravityFormModule;

add_action(
    'divi_module_library_modules_dependency_tree',
    function ( $dependency_tree ) {
        $dependency_tree->add_dependency( new GravityFormModule() );
    }
);
