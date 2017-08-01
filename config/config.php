<?php

return [
    'templates.path' => __DIR__ . '/../Templates/',
    'database' => array(
        'default' => array(
            'database.type'       => 'mysql',
            'database.host'       => '127.0.0.1',
            'database.port'       => 3306,
            'database.name'       => 'university',
            'database.user'       => 'root',
            'database.pass'       => ''
        ),
    ),
    'log.path'=> __DIR__ . '/../Log',
    'images.path'=> __DIR__ . '/../public/assets/images',
];