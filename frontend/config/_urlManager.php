<?php
return [
    'class'=>'yii\web\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
    'rules'=> [
        // Pages
        ['pattern'=>'page/<slug>', 'route'=>'page/view'],

        // Articles
        ['pattern'=>'article/index', 'route'=>'article/index'],
        ['pattern'=>'article/attachment-download', 'route'=>'article/attachment-download'],
        ['pattern'=>'article/<slug>', 'route'=>'article/view'],

        // Api
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/article', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/user', 'only' => ['index', 'view', 'options']],

        // City Search
        [
            'pattern' => 'find-a-nanny/<city:[\w-]+>-nanny',
            'route' => 'nannies/index',
            'suffix' => '/'         // 虽然能达到效果,但感觉这种方式不可取,相当于直接加了个后缀,并不是真正的 url 地址
        ],
        ['pattern' => 'find-a-nanny/<city:[\w-]+>', 'route' => 'nannies/index', 'suffix' => '/'],

        // Find Job
        'find-a-job/post' => 'post-job/create',
        'find-a-job/list' => 'post-job/index'
    ]
];
