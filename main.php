<?php
 return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' =>'zh-CN',
    'sourceLanguage'=>'zh-CN',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'mdm\admin\models\User',
            'loginUrl' => ['admin/user/login'],
            //'identityClass' => 'common\models\User',
            //'enableAutoLogin' => true,
            //'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'authManager' => [
            'class' => 'mdm\admin\components\DbManager',
        ],
        'i18n' => [
            'translations' => [
                'rbac-admin' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'zh_CN',
                    'basePath' => '@mdm/admin/messages'
                ],
            ],
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            //'sourceLanguage'=>'zh-CN',
            'layout' => 'left-menu',
            'mainLayout' => '@frontend/views/layouts/main.php',
            'menus' => [
                'assignment' => [
                    'label' => '授权访问' // change label
                ],
                //'route' => null, // disable menu
            ],
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'common\models\User',
                    'idField' => 'id',
                    'usernameField' => 'username',
                    //'fullnameField' => 'profile.full_name',
                    //'extraColumns' => [
                    //    [
                    //        'attribute' => 'full_name',
                    //        'label' => 'Full Name',
                    //        'value' => function($model, $key, $index, $column) {
                    //            return $model->profile->full_name;
                    //        },
                    //    ],
                    //    [
                    //        'attribute' => 'dept_name',
                    //        'label' => 'Department',
                    //        'value' => function($model, $key, $index, $column) {
                    //            return $model->profile->dept->name;
                    //        },
                    //    ],
                    //    [
                    //        'attribute' => 'post_name',
                    //        'label' => 'Post',
                    //        'value' => function($model, $key, $index, $column) {
                    //            return $model->profile->post->name;
                    //        },
                    //    ],
                    //],
                    //'searchClass' => 'frontend\models\UserSearch'
                ],
            ],
        ]
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'admin/*',
            'site/*',
            'debug/*',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],
    'params' => $params,
];