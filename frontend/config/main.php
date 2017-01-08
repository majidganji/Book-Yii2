<?php

$params = array_merge(
	require (__DIR__ . '/../../common/config/params.php'), require (__DIR__ . '/../../common/config/params-local.php'), require (__DIR__ . '/params.php'), require (__DIR__ . '/params-local.php')
);
return [
	'id' => 'app-frontend',
	'language' => 'fa',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
	'homeUrl' => '/book',
	'name' => 'دانلود کتاب',
	'controllerNamespace' => 'frontend\controllers',
	'components' => [
		'user' => [
			'identityClass' => 'common\models\User',
			'enableAutoLogin' => true,
			'identityCookie' => [
				'name' => '_fromSHBAanjaJSAB',
			],
		],
		'session' => [
			'name' => '<SMNKJskCNS\\SALjnak',
			'savePath' => sys_get_temp_dir(),
		],
		'request' => [
			'cookieValidationKey' => 'lkefk.SKMDksJKKjakasdh35115446aksjdaKD__\\SAD//as',
			'csrfParam' => '_MJSdbnkms4sCSRF',
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
			'baseUrl' => '/book',
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [
				'gobank/<id:\d+>' => 'shop/gobank',
				'shop/<id:\d+>' => 'shop/shop',
				'change-password' => 'site/changepassword',
				'change-accunt' => 'site/changeaccunt',
				'search/<search:\w+>' => 'site/search',
				'category/<id:\d+>/<name:\w+>' => 'site/category',
				'more/<id:\d+>/<name:\w+>' => 'site/more',
				'<action>' => 'site/<action>',
				'' => 'site/index',
			],
		],
	],
	'params' => $params,
];
