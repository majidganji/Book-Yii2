<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'language' => 'fa',
    'basePath' => dirname(__DIR__),
    'homeUrl' => '/book/admin',
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\Admin',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_sajdaHJHSdb6utgajs78jbas', // unique for backend
            ]
        ],
        'session' => [
            'name' => 'JASDSBAKNN8YHAKJS',
            'savePath' => sys_get_temp_dir(),
        ],
        'request' => [
            'cookieValidationKey' => '_Sladlkadkja_Sakdja6auygjaYsgukYJh&8677rfgJSgJ',
            'csrfParam' => '_BHJjJh78ydhUhvCSRF',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request' => [
            'baseUrl' => '/book/admin',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'home/' => 'site/index',
                '' => 'site/index',
                '<action>' => 'site/<action>',
            ],
        ],
    ],
    'params' => $params,
];
