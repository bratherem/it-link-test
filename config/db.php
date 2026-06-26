<?php

return [
    'class' => yii\db\Connection::class,
    'dsn' => sprintf(
        'pgsql:host=%s;port=%s;dbname=%s',
        getenv('DB_HOST') ?: 'localhost',
        getenv('DB_PORT') ?: '5432',
        getenv('DB_NAME') ?: 'car_ads'
    ),
    'username' => getenv('DB_USER') ?: 'car_user',
    'password' => getenv('DB_PASSWORD') ?: 'car_password',
    'charset' => 'utf8',
];
