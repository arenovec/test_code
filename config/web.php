<?php

    $params = require(__DIR__ . '/params.php');

    $config = [
        'id' => 'main',
        'basePath' => dirname(__DIR__),
        'bootstrap' => ['log'],
        'modules' => [
            'gridview' => [
                'class' => '\kartik\grid\Module'
            ],
        ],
        'components' => [
            'request' => [
                // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
                'cookieValidationKey' => 'caImjoDe-fd45FWW78igf|GsgogV4',
                'baseURL' => '',
                'class' => 'app\components\LangRequest',
            ],
            'authManager' => [
                'class' => 'yii\rbac\DbManager',
            //'cache' => 'cache' //Включаем кеширование 
            ],
            'cache' => [
                'class' => 'yii\caching\FileCache',
            ],
            'user' => [
                'identityClass' => 'app\models\Users',
                'enableAutoLogin' => true,
            ],
            'errorHandler' => [
                'errorAction' => 'site/error',
            ],
            'mailer' => [
                'useFileTransport' => TRUE,
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
            'db' => require(__DIR__ . '/db.php'),
            'urlManager' => [
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'class' => 'app\components\LangUrlManager',
                'rules' => [
                    [
                        'pattern' => '/page/<name:\w+>',
                        'route' => 'page/index',
                    //'suffix' => '.html'
                    ],
                ],
            ],
            'i18n' => [
                'translations' => [
                    '*' => [
                        'class' => 'yii\i18n\DbMessageSource',
                        'messageTable' => 'translations',
                        'sourceMessageTable' => 'translations_source',
                        'sourceLanguage' => 'ru',
                    ],
                ],
            ],
            'telegram' => [
                'class' => 'aki\telegram\Telegram',
                'botToken' => '970600660:AAHeTXE0ukXRnCSfI1n0jKV5Am1ZS45Z4i8',
            ],
        ],
        'controllerMap' => [
            'elfinder' => [
                'class' => 'mihaildev\elfinder\PathController',
                'access' => ['@', '?'],
                'root' => [
                    'path' => 'upload/page',
                    'name' => 'Page'
                ],
            ]
        ],
        'params' => $params,
    ];

    if(YII_ENV_DEV) {
        // configuration adjustments for 'dev' environment
        $config['bootstrap'][] = 'debug';
        $config['modules']['debug'] = [
            'class' => 'yii\debug\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            'allowedIPs' => ['127.0.0.1', '::1'],
        ];

        $config['bootstrap'][] = 'gii';
        $config['modules']['gii'] = [
            'class' => 'yii\gii\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            'allowedIPs' => ['127.0.0.1', '::1'],
        ];
    }

    return $config;
    