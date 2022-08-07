<?php

namespace Tokofetcher;

/**
 * @global array $categories
 */

// We are responding as a test JSON here only

header( "Content-Type: application/json; charset=utf-8" );

$response = [
    'all_categories' => $categories,
];

$total_products = 0;

foreach ( $categories as $category ){
    $response[ 'cat_' . $category['id'] ] = Fetcher::products( $category['id'] );
    $total_products += $response[ 'cat_' . $category['id'] ]['count'];
}

$response['total_found'] = $total_products;

die( json_encode( $response ) );
