<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'aZpreBUL6Jb8a0hE5SocM_H52CkTETo9',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'authManager' => [
            'class'=>'yii\rbac\DbManager',
        ],
        'urlManager' =>
        [
            'enablePrettyUrl'=>'true',
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'modules' => [
      'admin' => [
        'class' => 'mdm\admin\Module',
      ],
    ],
      'as access' => [
        'class'=>'mdm\admin\components\AccessControl',
        'allowActions'=> [
          'site/index',
          'site/datalogger',
          'site/about',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [ 'class' => 'yii\debug\Module',  /*'allowedIPs'=>['*']*/];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
    /*$config['modules']['gii'] = [
      'class'=>'yii\gii\Module',
      'allowedIPs'=>['10.0.1.15','10.0.1.8','10.0.1.6','10.0.1.7']
    ];*/
}

return $config;
