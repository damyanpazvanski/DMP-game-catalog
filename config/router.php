<?php
return [
    'default' => [
        'path' => '/',
        'action' => 'Default/Default/index',
        'method' => 'GET'
    ],
    'login' => [
        'path' => '/login',
        'action' => 'Default/Login/index',
        'method' => 'GET'
    ],
    'processLogin' => [
        'path' => '/login',
        'action' => 'Default/Login/process',
        'method' => 'POST'
    ],
    'logout' => [
        'path' => '/logout',
        'action' => 'Default/Login/logout',
        'method' => 'GET'
    ],
    'add-game' => [
        'path' => '/add-game',
        'action' => 'Default/Game/AddForm',
        'method' => 'GET'
    ],
    'add-game-process' => [
        'path' => '/add-game-process',
        'action' => 'Default/Game/process',
        'method' => 'POST'
    ],
    'games' => [
        'path' => '/games',
        'action' => 'Default/Game/index',
        'method' => 'GET'
    ],
    'show-games-of-category' => [
        'path' => '/category',
        'action' => 'Default/Category/oneCategory',
        'method' => 'GET'
    ],
    'categories' => [
        'path' => '/categories',
        'action' => 'Default/Category/index',
        'method' => 'GET'
    ],
    'add-category' => [
        'path' => '/add-category',
        'action' => 'Default/Category/addCategory',
        'method' => 'GET'
    ],
    'process-add-category' => [
        'path' => '/process-add-category',
        'action' => 'Default/Category/processAddCategory',
        'method' => 'POST'
    ],
    'edit-category' => [
        'path' => '/edit-category',
        'action' => 'Default/Category/editCategory',
        'method' => 'GET'
    ],
    'show-game' => [
        'path' => '/game',
        'action' => 'Default/Game/showGame',
        'method' => 'GET'
    ],
    'edit-game' => [
        'path' => '/edit-game',
        'action' => 'Default/Game/editGame',
        'method' => 'GET'
    ],
    'delete-game' => [
        'path' => '/delete-game',
        'action' => 'Default/Game/deleteGame',
        'method' => 'POST'
    ],
    '404' => [
        'path' => '/404',
        'action' => 'Default/Exceptions/index',
        'method' => 'GET'
    ],
    'otherwise' => [
        'name' => '404'
    ]
];