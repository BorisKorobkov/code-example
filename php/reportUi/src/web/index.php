<?php

define(
    'YII_DEBUG',
    empty($_ENV['YII_DEBUG']) ? false : $_ENV['YII_DEBUG']
);

define(
    'YII_ENV',
    empty($_ENV['YII_ENV']) ? 'prod' : $_ENV['YII_ENV']
);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
