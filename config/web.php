<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'=>'en', // back to English
    'components' => [
      'urlManager' => [
              'showScriptName' => false,
              'enablePrettyUrl' => true,
                'rules' => [
                                  'status' => 'status/index',
                                  'status/index' => 'status/index',
                                  'status/create' => 'status/create',
                                  'status/view/<id:\d+>' => 'status/view',  
                                  'status/update/<id:\d+>' => 'status/update',  
                                  'status/delete/<id:\d+>' => 'status/delete',  
                                  'status/<slug>' => 'status/slug',
                    		            'defaultRoute' => '/site/index',
                              ],              
                      ],    
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'kO8iHt9xUGpPne1zGgy0rqncBNmHnc86',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'modelMap' => [
                    'User' => 'app\models\User',
              ],
            'admins' => ['admin']
        ],        
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
                'class' => 'yii\swiftmailer\Mailer',
                'viewPath' => '@app/mailer',
                'useFileTransport' => false,
                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => 'your-smtp-host-domain',
                    'username' => 'your-email-or-username',
                    'password' => 'your-password',
                    'port' => '587',
                    'encryption' => 'tls',
                                ],
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
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
