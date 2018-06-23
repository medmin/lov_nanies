<?php

use yii\helpers\Html;;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

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
                'label' => Yii::t('frontend', 'Find A Job'),
                'items' => [
                    [
                        'label' => Yii::t('frontend', 'Post A Job '),
                        'url' => ['/find-a-job/post'],
                        'visible' => key_exists('seeker', Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))
                    ],
                    [
                        'label' => Yii::t('frontend', 'My Jobs'),
                        'url' => ['/find-a-job/list'],
                        'visible' => key_exists('seeker', Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))
                    ],
                    [
                        'label' => Yii::t('frontend', 'Job List '),
                        'url' => ['/find-a-job/list'],
                        'visible' => key_exists('nanny', Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))
                    ]
                ]
            ],
            [
                'label' => Yii::t('frontend', 'Articles and Tools'),
                'items' => [
//                    ['label' => Yii::t('frontend', 'All Articles'), 'url' => ['/article/index']],
                    ['label' => Yii::t('frontend', 'Family Articles'), 'url' => ['/article/index', 'c' => 'family']],
                    ['label' => Yii::t('frontend', 'Nanny Articles'), 'url' => ['/article/index', 'c' => 'nanny']],
                    ['label' => Yii::t('frontend', 'Forms For Families'), 'url' => ['/article/index', 'c' => 'forms']],
                    ['label' => Yii::t('frontend', 'Products and Services'), 'url' => ['/article/index', 'c' => 'products']],
                    ['label' => Yii::t('frontend', 'Blog'), 'url' => ['/article/index', 'c' => 'blog']]
                ]
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
    

