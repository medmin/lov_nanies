<?php

use yii\helpers\Html;;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;


// article category
$article_category_models = \common\models\ArticleCategory::findAll(['status' => \common\models\ArticleCategory::STATUS_ACTIVE]);
$article_category = [];
foreach ($article_category_models as $c) {
    $article_category[] = ['label' => Yii::t('frontend', $c->title), 'url' => ['/article/index', 'c' => $c->slug]];
}

NavBar::begin([
        'brandLabel' => Html::img('@web/images/NannyCare-Logo.png', ['alt'=>Yii::$app->name]),
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
            ['label' => Yii::t('frontend', 'Find A Nanny <i class="fa fa-plus navicn"></i>'), 'url' => ['/nannies/index'], ],
            // [
            //     'label' => Yii::t('frontend', 'Find A Nanny'),
            //     'items' => [
            //         ['label' => Yii::t('frontend', 'All Nannies '), 'url' => ['/nannies/index']],
            //         ['label' => Yii::t('frontend', 'BabySitter '), 'url' => '/#'],
            //         ['label' => Yii::t('frontend', 'Newborn Specialist '), 'url' => '/#'],
            //         ['label' => Yii::t('frontend', 'Caregiver '), 'url' => '/#'],
            //         ['label' => Yii::t('frontend', 'Housekeeper '), 'url' => '/#'],
            //         ['label' => Yii::t('frontend', 'Special Needs '), 'url' => '/#'],
            //         ['label' => Yii::t('frontend', 'Elderly Care '), 'url' => '/#']
            //     ]
            // ],
            [
                'label' => Yii::t('frontend', 'Find A Job <i class="fa fa-plus navicn"></i>'),
                'url' => ['/find-a-job/list'],
                'visible' => !Yii::$app->user->isGuest && key_exists('nanny', Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))
            ],
            [
                'label' => Yii::t('frontend', 'Articles and Tools'),
                'items' => $article_category
            ],
            [
                'label' => Yii::t('frontend','Resources'),
                'items' => [
                    ['label' => Yii::t('frontend', 'Background Checks'), 'url' => ['/#']],
                    ['label' => Yii::t('frontend', 'Sample Forms'), 'url' => ['/#']],
                    ['label' => Yii::t('frontend', 'Nanny Taxes'), 'url' => ['/#']],
                    ['label' => Yii::t('frontend', 'CPR/First Aid'), 'url' => ['/#']],
                    ['label' => Yii::t('frontend', 'INA'), 'url' => ['/#']],
                    [
                        'label' => Yii::t('frontend', 'Recommended Practices For Screening Nannies'),
                        'url' => ['#'],
                        'options' => ['title' => Yii::t('frontend', 'Recommended Practices For Screening Nannies')]
                    ],
                ]
            ],
            [
                'label' => Yii::t('frontend','About Us'),
                'items'=>[
                          ['label' => Yii::t('frontend', 'About '), 'url' => ['/page/view', 'slug'=>'about']],
                          ['label' => Yii::t('frontend', 'Contact '), 'url' => ['/site/contact']],
                
                ]
            ],
            [
                'label' => Yii::t('frontend','My Account'),
                'visible'=>Yii::$app->user->isGuest,
                'items' => [
                    ['label' => Yii::t('frontend', 'Log In <i class="fa fa-plus navicn"></i>'), 'url' => ['/user/sign-in/login']],
                    ['label' => Yii::t('frontend', 'Sign Up <i class="fa fa-plus navicn"></i>'), 'url' => ['/user/sign-in/signup']],
                ]
            ],
            
            [
                'label' => Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->getPublicIdentity(),
                'visible'=>!Yii::$app->user->isGuest,
                'items'=>[
                    [
                        'label' => Yii::t('frontend', 'Account'),
                        'url' => ['/user/default/index']
                    ],
                    [
                        'label' => Yii::t('frontend', 'VIP Service'),
                        'url' => 'http://www.lovingnannies.com/',
                        'visible' => array_key_exists('seeker', Yii::$app->authManager->getRolesByUser(Yii::$app->user->id))
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
    

