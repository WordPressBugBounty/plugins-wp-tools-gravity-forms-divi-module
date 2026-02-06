<?php

namespace WPT\DiviGravity\Divi5\Conversion;

class Conversion {
    protected $container;

    public function __construct( $container ) {
        $this->container = $container;
    }

    /**
     * Conversion map
     */
    public function map( $map ) {
        return $map;
    }

}
