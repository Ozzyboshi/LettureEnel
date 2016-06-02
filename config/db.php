<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => getenv('DB_STRING'),
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASS'),
    'charset' => 'utf8',
];
