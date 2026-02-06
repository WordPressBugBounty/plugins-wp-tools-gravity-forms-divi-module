<?php
namespace WPT\DiviGravity\Divi5\Modules\GravityFormModule\GravityFormModuleTraits;

if ( !defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

use ET\Builder\Packages\Module\Module;
use ET\Builder\FrontEnd\BlockParser\BlockParserStore;
use WPT\DiviGravity\Divi5\Modules\GravityFormModule\GravityFormModule;

trait RenderCallbackTrait
{
    /**
     * Render callback
     */
    public static function render_callback(
        $attrs,
        $content,
        $block,
        $elements
    ) {

        $gravityformHtml = self::render_gravityform( [
            'id'              => $attrs['gravityform']['advanced']['desktop']['value']['id'],
            'showTitle'       => $attrs['gravityform']['advanced']['desktop']['value']['showTitle'],
            'showDescription' => $attrs['gravityform']['advanced']['desktop']['value']['showDescription'],
            'useAjax'         => $attrs['gravityform']['advanced']['desktop']['value']['useAjax'],
            'tabIndex'        => $attrs['gravityform']['advanced']['desktop']['value']['tabIndex'],
            'fieldValues'     => $attrs['gravityform']['advanced']['desktop']['value']['fieldValues'],
        ] );

        $parent = BlockParserStore::get_parent( $block->parsed_block['id'], $block->parsed_block['storeInstance'] );

        return Module::render(
            [
                // FE only.
                'orderIndex'          => $block->parsed_block['orderIndex'],
                'storeInstance'       => $block->parsed_block['storeInstance'],

                // VB equivalent.
                'attrs'               => $attrs,
                'elements'            => $elements,
                'id'                  => $block->parsed_block['id'],
                'name'                => $block->block_type->name,
                'classnamesFunction'  => [GravityFormModule::class, 'module_classnames'],
                'moduleCategory'      => $block->block_type->category,
                'stylesComponent'     => [GravityFormModule::class, 'module_styles'],
                'scriptDataComponent' => [GravityFormModule::class, 'module_script_data'],
                'parentAttrs'         => $parent->attrs ?? [],
                'parentId'            => $parent->id ?? '',
                'parentName'          => $parent->blockName ?? '',
                'children'            => $elements->style_components(
                    [
                        'attrName' => 'module',
                    ]
                ) 
                . sprintf('<div class="et_pb_module_inner"><div class="d5-divi-gravity-form">%s</div></div>', $gravityformHtml)                ,
            ]
        );
    }

    /*
     * Render the gravity form based on the ID
     */
    public static function render_gravityform( $args )
    {
        $args['id'] = str_replace('gf-', '', $args['id']);
        $gravityform_shortcode = sprintf(
            '[gravityform id=%1$s title="%2$s" description="%3$s" ajax="%4$s" tabindex="%5$s" field_values="%6$s" theme="gravity"/]',
            $args['id'],
            'on'  === $args['showTitle'] ? 'true' : 'false',
            'on'  === $args['showDescription'] ? 'true' : 'false',
            'on'  === $args['useAjax'] ? 'true' : 'false',
            $args['tabIndex'],
            $args['fieldValues']
        );
    
        $html = do_shortcode( $gravityform_shortcode );

        return $html;
    }
}
