<?php

return [
    'class' => 'yii\web\UrlManager',
    'hostInfo' => $params['frontendHostInfo'] ,
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        'contact' => 'contact/index',
        '<_a:login|logout>' => 'auth/auth/<_a>',
        'signup' => 'auth/signup/index',
        'signup/<_a:[\w-]+>' => 'auth/signup/<_a>',
        '<_a:[\w\-]+>' => 'site/<_a>',
        '' => 'site/index',



        '<_c:[\w\-]+>' => '<_c>/index',
        '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
        '<_c:[\w\-]+>/<_a:[\w-]+>' => '<_c>/<_a>',
        '<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_c>/<_a>',
        '<_a:about>' => 'site/<_a>',

    ],
];