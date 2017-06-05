<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),    
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'
        ]
    ],
    'components' => [        
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'v1/country',
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
		                     
                ],
		[
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'v1/users',
		    'extraPatterns' => [
			'POST login' => 'login',
			'POST changepassword' => 'changepassword',
			'POST forgotpassword' => 'forgotpassword',
			'POST logout' => 'logout',
                        'POST updateprofile' => 'updateprofile',
                        'POST updatepettycash' => 'updatepettycash',
                        'POST pettycashlist' => 'pettycashlist',
                        'POST userdata' => 'userdata',
                        'POST tasklist' => 'tasklist',
		    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'v1/messages',
		    'extraPatterns' => [
			'POST login' => 'login',
			'POST getallmessages' => 'getallmessages',
                        'POST readmessages' => 'readmessages',
		    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'v1/lifts',
		    'extraPatterns' => [
			'POST liftlist' => 'liftlist',
                        'POST liftrecords' => 'liftrecords',
		    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'v1/ecalls',
		    'extraPatterns' => [
			'POST register' => 'register',
                        'POST updatestatus' => 'updatestatus',
		    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'v1/documents',
		    'extraPatterns' => [
			'POST documentcategorylist' => 'documentcategorylist',
                        'POST documentlist' => 'documentlist',                        
		    ]
                ]
                ,
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'v1/leaves',
		    'extraPatterns' => [
			'POST requestleave' => 'requestleave',
                        'POST documentlist' => 'documentlist',
                        'POST leavelist' => 'leavelist',
                        'POST updatestatus' => 'updatestatus',
                        'POST updatepettycash' => 'updatepettycash',
		    ]
                ]
            ],        
        ]
    ],
    'params' => $params,
];



