<?php

namespace Tokofetcher;

final class Front {

    static function init(){
        including( 'main', [ 'categories' => Fetcher::categories() ] );
    }

}