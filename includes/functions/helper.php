<?php

namespace Tokofetcher;

function including( $template, $params ){
    $tfn = VIEWS . '/' . $template . '.php';
    if( ! file_exists( $tfn ) )
        die( 'Template ' . $tfn . ' does not exist!' );
    extract( $params );
    include_once $tfn;
}
