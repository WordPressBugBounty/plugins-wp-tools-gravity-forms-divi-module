<?php

namespace WPT\DiviGravity\Divi5\Modules\GravityFormModule\GravityFormModuleTraits;

if ( !defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}
use ET\Builder\FrontEnd\Module\Style;
use ET\Builder\Packages\Module\Options\Css\CssStyle;
use ET\Builder\Packages\Module\Options\Text\TextStyle;
use ET\Builder\Packages\Module\Layout\Components\StyleCommon\CommonStyle;
trait ModuleStylesTrait
{
    use CustomCssTrait;
    use StyleDeclarationTrait;
    public static function module_styles( $args ) {
        $attrs = $args['attrs'] ?? [];
        $elements = $args['elements'];
        $settings = $args['settings'] ?? [];
        $styles = [];
        Style::add( [
            'id'            => $args['id'],
            'name'          => $args['name'],
            'orderIndex'    => $args['orderIndex'],
            'storeInstance' => $args['storeInstance'],
            'styles'        => $styles,
        ] );
    }

}