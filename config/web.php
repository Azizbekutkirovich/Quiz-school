<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'quiz-school',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'uz-UZ',
    'sourceLanguage' => 'uz-UZ',
    'layout' => 'school',
    'defaultRoute' => 'main/index',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'quiz-school',
            'baseUrl' => '/quiz-school',
        ],
        'session' => [
            'name' => 'quiz-school'
        ],
        'cache' => [
            'class' => 'yii\redis\Cache',
            'redis' => [
                'hostname' => '127.0.0.1',
                'port' => 6379,
                'database' => 0,
            ],
        ],
        'minio' => [
            'class' => 'app\components\MinioComponent',
            'accessKey' => 'minioadmin',
            'secretKey' => 'minioadmin123',
            'endpoint' => 'http://localhost:9000',
            'bucket' => 'test-files'
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
            'loginUrl' => ['main/login']
        ],
        'security' => [
            'class' => 'yii\base\Security',
            'passwordHashCost' => 8,
        ],
        'errorHandler' => [
            'errorAction' => 'main/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                "home" => "main/index",
                "settings" => "main/settings",
                "about-us" => "main/about",
                "test/<test_id:\d+>/" => "test/test",
                "select-test/<sciense:[^/]+>" => "test/selecttest",
                "results" => "users/results",
                "detail-result/<info:\d+>" => "users/detail-result"
            ],
        ],
    ],
    'params' => $params,
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
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;