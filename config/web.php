<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name'=>'SGHS UEES',
//    'defaultRoute' => 'user/security/login',
    'defaultRoute' => 'site/index',
    'language' => 'es',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
                    'log',
                    'app\components\Bootstrap',
        ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],        
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'UTYD1SpckgqrAS93W__C7k0BroZED5gh',
//            'enableCsrfValidation' => false,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//        'user' => [
//            'identityClass' => 'app\models\User',
//            'enableAutoLogin' => true,
//        ],
        'user' => [
            'identityClass' => 'johnitvn\userplus\basic\models\UserAccounts',
            'loginUrl'=>['/user/security/login'],
        ],        
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => require(__DIR__ . '/mailer.php'),        
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
            'rules' => [
            ],
        ],
        
    ],
    'as beforeRequest' => [  //if guest user access site so, redirect to login page.
        'class' => 'yii\filters\AccessControl',
        'rules' => [
            [
                'actions' => ['login', 'error'],
                'allow' => true,
            ],
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
    ],    
    'params' => $params,
    'modules' => [ 
        'gridview' => [ 'class' => '\kartik\grid\Module' ] ,
        'rbac' =>  [
            'class' => 'johnitvn\rbacplus\Module'
        ],
        'user'=>[
            'class'=>'johnitvn\userplus\basic\Module',
            // You can add other config after
        ]        
    ]
];

$config['bootstrap'][] = 'catalogs';
$config['modules']['catalogs'] = [
    'class' => 'app\modules\catalogs\Module',
]; 


if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
