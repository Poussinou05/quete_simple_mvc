<?php
// routing.php
$routes = [
    'Item' => [ // Controller
        ['index', '/', 'GET'], // action, url, HTTP method
        ['show', '/item/{id}', 'GET'], // action, url, HTTP method
    ],
    'Category' => [
        ['indexCategories', '/categories', 'GET'],
        ['showCategory', '/category/{id}', 'GET'],
    ]
];