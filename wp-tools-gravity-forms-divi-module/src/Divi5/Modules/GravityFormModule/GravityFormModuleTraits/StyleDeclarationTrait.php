<?php

/**
 * BlogModule::icon_style_declaration().
 *
 * @package Builder\Packages\ModuleLibrary
 * @since ??
 */

namespace WPT\DiviGravity\Divi5\Modules\GravityFormModule\GravityFormModuleTraits;

if (! defined('ABSPATH')) {
    die('Direct access forbidden.');
}

use ET\Builder\Packages\StyleLibrary\Utils\StyleDeclarations;
use ET\Builder\Packages\IconLibrary\IconFont\Utils;

trait StyleDeclarationTrait
{
    /**
     * Style declaration for Blog Module If it has border radius set.
     *
     * This function is the equivalent of the `borderStyleDeclaration` JS function located in
     * visual-builder/packages/module-library/src/components/blog/style-declarations/border/index.ts.
     *
     * @param array $args {
     *     An array of arguments.
     *
     *     @type array      $attrValue  The value (breakpoint > state > value) of module attribute.
     *     @type bool|array $important  If set to true, the CSS will be added with !important.
     *     @type string     $returnType This is the type of value that the function will return. Can be either string or key_value_pair.
     * }
     *
     * @since ??
     */
    public static function grid_column_gap_declaration($args)
    {
        $value = '';

        $style_declarations = new StyleDeclarations(
            [
                'returnType' => 'string',
                'important'  => false,
            ]
        );

        if (is_string($args['attrValue'])) {
            $value = $args['attrValue'];
            $style_declarations->add('grid-column-gap', $value);
            return $style_declarations->value();
        }

        return '';
    }



    /* Grid row gap declaration */
    public static function grid_row_gap_declaration($args)
    {
        $value = '';

        $style_declarations = new StyleDeclarations(
            [
                'returnType' => 'string',
                'important'  => false,
            ]
        );

        if (is_string($args['attrValue'])) {
            $value = $args['attrValue'];
            $style_declarations->add('grid-row-gap', $value);
            return $style_declarations->value();
        }

        return '';
    }


    /* Height declaration */
    public static function height_declaration($args)
    {
        $value = '';

        $style_declarations = new StyleDeclarations(
            [
                'returnType' => 'string',
                'important'  => false,
            ]
        );

        if (is_string($args['attrValue'])) {
            $value = $args['attrValue'];
            if (!empty($value)) {
                $style_declarations->add('height', $value);
                return $style_declarations->value();
            }
        }

        return '';
    }

    /* Fill style */
    public static function fill_declaration($args)
    {
        $value = '';

        $style_declarations = new StyleDeclarations(
            [
                'returnType' => 'string',
                'important'  => false,
            ]
        );

        if (is_string($args['attrValue'])) {
            $value = $args['attrValue'];
            if (!empty($value)) {
                $style_declarations->add('fill', $value);
                return $style_declarations->value();
            }
        }

        return '';
    }


    /* Flex alignment for button container */
    public static function flex_alignment_declaration($args)
    {
        $value = '';

        $style_declarations = new StyleDeclarations(
            [
                'returnType' => 'string',
                'important'  => false,
            ]
        );

        if (isset($args['attrValue'], $args['attrValue']['alignment']) && is_string($args['attrValue']['alignment'])) {
            $value = $args['attrValue']['alignment'];
            if (!empty($value)) {
                $style_declarations->add('justify-content', $value);
                return $style_declarations->value();
            }
        }

        return '';
    }


    public static function button_alignment_declaration($args)
    {
        $value = '';

        $style_declarations = new StyleDeclarations(
            [
                'returnType' => 'string',
                'important'  => false,
            ]
        );

        if (isset($args['attrValue'], $args['attrValue']['alignment']) && is_string($args['attrValue']['alignment'])) {
            $value = $args['attrValue']['alignment'];
            if (!empty($value)) {
                $style_declarations->add('text-align', $value);
                return $style_declarations->value();
            }
        }

        return '';
    }

    /* Min width declaration */
    public static function min_width_declaration($args)
    {
        $value = '';

        $style_declarations = new StyleDeclarations(
            [
                'returnType' => 'string',
                'important'  => false,
            ]
        );

        if (is_string($args['attrValue'])) {
            $value = $args['attrValue'];
            if (!empty($value)) {
                $style_declarations->add('min-width', $value);
                return $style_declarations->value();
            }
        }

        return '';
    }


    /* Size declaration */
    public static function size_declaration($args)
    {
        $value = '';

        $style_declarations = new StyleDeclarations(
            [
                'returnType' => 'string',
                'important'  => false,
            ]
        );

        if (is_string($args['attrValue'])) {
            $value = $args['attrValue'];
            if (!empty($value)) {
                $style_declarations->add('width', $value);
                $style_declarations->add('height', $value);
                return $style_declarations->value();
            }
        }

        return '';
    }


    /* Color declaration */
    public static function color_declaration($args)
    {
        $value = '';

        $style_declarations = new StyleDeclarations(
            [
                'returnType' => 'string',
                'important'  => false,
            ]
        );

        if (is_string($args['attrValue'])) {
            $value = $args['attrValue'];
            if (!empty($value)) {
                $style_declarations->add('color', $value);
                return $style_declarations->value();
            }
        }

        return '';
    }
}
