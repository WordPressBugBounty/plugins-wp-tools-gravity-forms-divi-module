<?php

namespace WPT\DiviGravity\Divi5\Modules\GravityFormModule\GravityFormModuleTraits;

if ( !defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}
use ET\Builder\Packages\Module\Options\Text\TextClassnames;
use ET\Builder\Packages\Module\Options\Element\ElementClassnames;
trait ModuleClassnamesTrait
{
    public static function module_classnames( $args ) {
        $classnames_instance = $args['classnamesInstance'];
        $attrs = $args['attrs'];
        $isFreePlan = true;
        if ( $isFreePlan ) {
            $classnames_instance->add( 'free-plan' );
        }
        // Text Options.
        $classnames_instance->add( TextClassnames::text_options_classnames( $attrs['module']['advanced']['text'] ?? [], [
            'orientation' => false,
        ] ), true );
        // Module.
        $classnames_instance->add( ElementClassnames::classnames( [
            'attrs' => $attrs['module']['decoration'] ?? [],
            'attrs' => array_merge( $attrs['module']['decoration'] ?? [], [
                'link' => $attrs['module']['advanced']['link'] ?? [],
            ] ),
        ] ) );
    }

}