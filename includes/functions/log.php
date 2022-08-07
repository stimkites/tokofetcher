<?php

namespace Tokofetcher;

/**
 * Custom logging function
 *
 * Keeps logs for 2 weeks maximum
 *
 * @param mixed $log
 * @param string $suffix
 *
 * @return mixed returns data being passed for logging
 */
function log ( $log, $suffix = 'api' ) {
    if( ! DEBUG ) return $log;
    if( ! is_dir( LOG_PATH ) && ! mkdir( LOG_PATH, 0775, true ) ) return $log;
    $fn         = LOG_PATH . '/' . strftime( "%Y_%m_%d_api.log" );
    $outdated   = time() - 14 * 24 * 3600;
    if( ! file_exists( $fn ) )
        if( $files = glob( LOG_PATH . '/*.log' ) )
            foreach( $files as $file )
                if( $outdated > filemtime( $file ) )
                    unlink( $file );
    $output = strftime( "[%Y-%m-%d_%H:%M:%S]" ) . "[$suffix] " . print_r( $log, true ) . "\n";
    file_put_contents( $fn, $output, FILE_APPEND );
    return $log;
}