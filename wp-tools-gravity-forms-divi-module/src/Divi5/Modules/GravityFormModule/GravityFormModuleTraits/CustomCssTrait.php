<?php
namespace WPT\DiviGravity\Divi5\Modules\GravityFormModule\GravityFormModuleTraits;

if ( !defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

trait CustomCssTrait
{
    public static function custom_css()
    {
        return \WP_Block_Type_Registry::get_instance()
            ->get_registered( 'd5-gravity-form-module/divi-gravity-form' )
            ->customCssFields;
    }
}
