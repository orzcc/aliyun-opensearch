<?php
/*
 * This file is part of Laravel Opensearch.
 *
 * (c) orzcc <orzcczh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */
    'default' => 'main',
    /*
    |--------------------------------------------------------------------------
    | Opensearch Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */
    'connections' => [
        'main' => [
            'app'               => 'your-app-name',
            'host'              => 'your-host',
            'client_id'         => 'your-token',
            'client_secret'     => 'your-app'
        ],
        'alternative' => [
            'app'               => 'your-app-name',
            'host'              => 'your-host',
            'client_id'         => 'your-token',
            'client_secret'     => 'your-app'
        ],
    ],
];