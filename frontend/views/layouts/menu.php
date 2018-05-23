<?php
use yii\widgets\Menu;
use yii\helpers\Html;;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
NavBar::begin([
        'brandLabel' => Html::img('@web/images/logoHN.png', ['alt'=>Yii::$app->name]),
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions' => ['class' => 'logo-style'],
        'options' => [
            'class' => 'navbar-default yamm',
        ],
        
    ]); ?>
    <?php echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right',],
        'encodeLabels' => false,
        'items' => [
            ['label' => Yii::t('frontend', 'Home <i class="fa fa-plus navicn"></i>'), 'url' => ['/site/index'], ],
            ['label' => Yii::t('frontend', 'Nanny Search <i class="fa fa-plus navicn"></i>'), 'url' => ['/nannies/index'], ],
            ['label' => Yii::t('frontend', 'For Families <i class="fa fa-plus navicn"></i>'), 'url' => ['/page/view', 'slug'=>'families']],
            ['label' => Yii::t('frontend', 'For Nannies <i class="fa fa-plus navicn"></i>'), 'url' => ['/page/view', 'slug'=>'nannies']],
            
                
            ['label' => Yii::t('frontend', 'Articles/Tools <i class="fa fa-plus navicn"></i>'), 'url' => ['/article/index']],
            [
                'label' =>'About Us',
                'items'=>[
                          ['label' => Yii::t('frontend', 'About '), 'url' => ['/page/view', 'slug'=>'about']],
                          ['label' => Yii::t('frontend', 'Contact '), 'url' => ['/site/contact']],
                
                ]
            ],
            ['label' => Yii::t('frontend', 'Signup <i class="fa fa-plus navicn"></i>'), 'url' => ['/user/sign-in/signup'], 'visible'=>Yii::$app->user->isGuest],
            ['label' => Yii::t('frontend', 'Login <i class="fa fa-plus navicn"></i>'), 'url' => ['/user/sign-in/login'], 'visible'=>Yii::$app->user->isGuest],
            [
                'label' => Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->getPublicIdentity(),
                'visible'=>!Yii::$app->user->isGuest,
                
                'items'=>[
                    [
                        'label' => Yii::t('frontend', 'Account'),
                        'url' => ['/user/default/index']
                    ],
                    [
                        'label' => Yii::t('frontend', 'Backend'),
                        'url' => Yii::getAlias('@backendUrl'),
                        'visible'=>Yii::$app->user->can('manager')
                    ],
                    [
                        'label' => Yii::t('frontend', 'Logout'),
                        'url' => ['/user/sign-in/logout'],
                        'linkOptions' => ['data-method' => 'post']
                    ]
                ]
            ],
            /*[
                'label'=>Yii::t('frontend', 'Language'),
                'dropDownOptions' =>[
                 'class' => 'vertical-megamenu'                     
                ],
                'items'=>array_map(function ($code) {
                    return [
                        'label' => Yii::$app->params['availableLocales'][$code],
                        'url' => ['/site/set-locale', 'locale'=>$code],
                        'active' => Yii::$app->language === $code,
                        
                    ];
                }, array_keys(Yii::$app->params['availableLocales'])),
                
            ]*/
        ],
    ]); ?>
<?php NavBar::end();  ?>
    

