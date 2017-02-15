<?php

return [
    'databaseLive' => [
        'name' => 'Namibmhz_app1',
        'username' => 'Namibmhz_app1',
        'password' => 'Nam1b987App',
        'connection' => 'sql26.jnb1.host-h.net',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ],
    ],
    'databaseLocal' => [
        'name' => 'namexapp',
        'username' => 'root',
        'password' => '',
        'connection' => 'localhost',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ],
    ]
];