<?php
// routing.php
$routes = [
    'Item' => [ // Controller
        ['index', '/', 'GET'], // action, url, HTTP method
        ['add', '/item/add', ['GET', 'POST']], // action, url, HTTP method
        ['show', '/item/{id}', 'GET'], // action, url, HTTP method
        ['edit', '/item/edit/{id}', ['GET', 'POST']], // action, url, HTTP method
        ['delete', '/item/delete/{id}', 'GET'], // action, url, HTTP method

    ],
    'Category' => [
        ['indexCategories', '/categories', 'GET'],
        ['addCategory', '/category/add', ['GET','POST']],
        ['showCategory', '/category/{id}', 'GET'],
        ['edit', '/category/edit/{id}', ['GET', 'POST']],
        ['delete', '/category/delete/{id}', 'GET'],

    ]
];
?>