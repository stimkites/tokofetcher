<?php

namespace Tokofetcher;

// Basics
const
    PATH = __DIR__,
    URL = 'https://xn--80axjibeb.xn--80akidpbcg6n.xn--p1ai',  //мпстатс.наймименя.рф
    INCLUDES = PATH . '/includes',
    ASSETS_PATH = PATH . '/assets',
    ASSETS_URL = URL . '/assets',
    VIEWS = PATH . '/views',
    DEBUG = true,
    LOG_PATH = PATH . '/logs';

// Database
const
    DB_HOST = 'localhost',
    DB_USER = 'tokouser',
    DB_PASS = 'ro2jtgaes0g',
    DB_NAME = 'tokodb',
    DB_MAX  = 1000000; // Max records to fulfill in test purposes

// Source
const SOURCE = [
    'products' => [
        'url' => 'https://gql.tokopedia.com/graphql/SearchProductQuery',
        'query' => '[
              {
                "operationName":"SearchProductQuery",
                "variables":{
                  "params":"page=%PAGE%&sc=%CAT%&user_id=0&rows=60&start=0&source=directory&device=desktop&related=true&st=product&safe_search=false",
                  "adParams":""
                },
                "query":"query SearchProductQuery($params: String) {\n  CategoryProducts: searchProduct(params: $params) {\n    count\n    data: products {\n      id\n      url\n      imageUrl: image_url\n      catId: category_id\n      stock\n      discount: discount_percentage\n      preorder: is_preorder\n      name\n      price\n      original_price\n      rating\n      shop {\n        id\n        url\n        name\n      }\n          }\n      }\n  \n}\n"
              }]'
    ],
    'categories' => [
        'url' => 'https://gql.tokopedia.com/graphql/headerMainData',
        'query' => '[{"operationName":"headerMainData",
          "query":"query headerMainData {\n  categoryAllListLite {\n    categories {\n      id\n      name\n      url\n      children {\n        id\n        name\n        url\n        children {\n          id\n          name\n          url\n        }\n      }\n    }\n  }\n}\n"
        }]'
    ]
];