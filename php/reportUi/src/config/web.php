<?php

$db = require __DIR__ . '/db.php';

$config = [
    'name' => 'Report UI',
    'defaultRoute' => 'index',
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'LbnVS-0vsY5RIxn3o6b5ebyOHi9JmoSU',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'error/error',
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
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],

    'modules' => [
        'gridview' => [
            'class' => \kartik\grid\Module::class,
        ],

        'datecontrol' => [
            'class' => \kartik\datecontrol\Module::class,
            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                'date' => 'dd.MM.yyyy',
                'time' => 'HH:mm',
                'datetime' => 'dd.MM.yyyy HH:mm',
            ],
            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                'date' => 'php:Y-m-d', // saves as unix timestamp
                'time' => 'php:H:i:s',
                'datetime' => 'php:Y-m-d H:i:s',
            ],
            // default settings for each widget from kartik\widgets used when autoWidget is true
            'autoWidgetSettings' => [
                'date' => ['pluginOptions' => ['autoclose' => true, 'todayBtn' => 'linked']],
                // example
                'datetime' => ['pluginOptions' => ['autoclose' => true, 'todayBtn' => 'linked']],
                // setup if needed
                'time' => [],
                // setup if needed
            ],
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '172.18.0.2', '::1'],
    ];
}

return $config;
