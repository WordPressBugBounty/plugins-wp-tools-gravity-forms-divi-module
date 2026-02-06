<?php

namespace WPT\DiviGravity\Divi5\Modules\GravityFormModule;

if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

require_once ABSPATH . 'wp-content/themes/Divi/includes/builder-5/server/Framework/Controllers/RESTController.php';

use WP_REST_Request;
use WP_REST_Response;
use ET\Builder\Framework\UserRole\UserRole;
use ET\Builder\Framework\Controllers\RESTController;

/**
 * Class for registering "Simple Quick Module"'s REST API Endpoint.
 */
class GravityFormModuleController extends RESTController
{

    /**
     * Return unordered list of recent posts.
     */
    public static function index(WP_REST_Request $request): WP_REST_Response
    {
        $args = [
            'id'              => $request->get_param('gravityFormId'),
            'showTitle'       => $request->get_param('showTitle'),
            'showDescription' => $request->get_param('showDescription'),
            'useAjax'         => $request->get_param('useAjax'),
            'tabIndex'        => $request->get_param('tabIndex'),
            'fieldValues'     => $request->get_param('fieldValues'),
        ];

        $response = [
            'html' => GravityFormModule::render_gravityform($args),
        ];


        return self::response_success($response);
    }

    /**
     * Index action arguments.
     * Endpoint arguments as used in `register_rest_route()`.
     */
    public static function index_args(): array
    {
        return [
            'gravityFormId'   => [
                'type'              => 'number',
                'required'          => true,
                'sanitize_callback' => function ($number) {
                    $number = str_replace('gf-', '', $number);
                    return intval($number);
                },
                'validate_callback' => 'esc_html',
            ],
            'tabIndex'        => [
                'type'              => 'number',
                'required'          => true,
                'sanitize_callback' => function ($number) {
                    return intval($number);
                },
                'validate_callback' => 'esc_html',
            ],
            'showTitle'       => [
                'type'              => 'string',
                'required'          => true,
                'validate_callback' => 'esc_html',
            ],
            'showDescription' => [
                'type'              => 'string',
                'required'          => true,
                'validate_callback' => 'esc_html',
            ],
            'useAjax'         => [
                'type'              => 'string',
                'required'          => true,
                'validate_callback' => 'esc_html',
            ],
            'fieldValues'     => [
                'type'              => 'string',
                'required'          => true,
                'validate_callback' => 'esc_html',
            ],
        ];
    }

    /**
     * Index action permission.
     * Endpoint permission callback as used in `register_rest_route()`.
     */
    public static function index_permission(): bool
    {
        return UserRole::can_current_user_use_visual_builder();
    }
}
