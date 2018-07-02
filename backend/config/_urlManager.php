<?php
return [
    'class' => yii\web\UrlManager::class,
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        'order/<action>' => 'user-order/<action>',
        'file/<action>' => 'user-file/<action>',
        'job/<action>' => 'parent-post/<action>',
        'discount/<action>' => 'user-discount/<action>'
    ]
];
