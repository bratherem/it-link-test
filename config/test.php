<?php

$params = require __DIR__ . '/params.php';
$container = require __DIR__ . '/container.php';

$config = [
    'id' => 'car-ads-test',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'container' => $container,
    'components' => [
        'db' => [
            'class' => yii\db\Connection::class,
            'dsn' => 'sqlite::memory:',
        ],
        'request' => [
            'cookieValidationKey' => 'test-key',
            'parsers' => [
                'application/json' => yii\web\JsonParser::class,
            ],
        ],
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'POST car/create' => 'car/create',
                'GET car/list' => 'car/list',
                'GET car/<id:\d+>' => 'car/view',
            ],
        ],
    ],
    'params' => $params,
];

return $config;
