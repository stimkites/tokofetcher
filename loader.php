<?php

namespace Tokofetcher;

// Configuration and constants
require_once "config.php";

// Simple loader
new class {

    function __construct(){
        $this->load();
    }

    private function load( $dir = PATH . '/includes' ){
        foreach( glob( $dir . '/*' ) as $fn )
            if( is_dir( $fn ) )
                $this->load( $fn );
            else
                require_once $fn;
    }

};
