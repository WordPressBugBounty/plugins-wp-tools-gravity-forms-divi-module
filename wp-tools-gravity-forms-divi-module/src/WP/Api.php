<?php
namespace WPT\DiviGravity\WP;

use WP_REST_Request;
use WP_REST_Response;

/**
 * Api.
 */
class Api
{
    protected $container;

    /**
     * Constructor.
     */
    public function __construct( $container )
    {
        $this->container = $container;
    }

    /**
     * Get a list of gravity forms
     */
    public function gravityforms( WP_REST_Request $request )
    {
        $data = [];
        if ( class_exists( '\\GFAPI' ) ) {
            $forms = \GFAPI::get_forms();
            foreach ( $forms as $form ) {
                $data[sprintf('gf-%s', $form['id'])] = [
                    'label' => $form['title'],
                ];
            }
            return new WP_REST_Response( $data, 200 );
        } else {
            return new WP_REST_Response( 'No posts found', 404 );
        }
    }
}
