<?php

use yii\helpers\Html;;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

NavBar::begin([
        'brandLabel' => Html::img('@web/images/NannyCare-Logo.png', ['alt'=>Yii::$app->name, 'class' => 'logo']),
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions' => ['style' => 'height: 100%; padding: 0'],
        'options' => [
            'class' => 'navbar-default yamm',
        ],
        
    ]); ?>
    <?php echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right', 'style' => 'margin-top: 20px'],
        'encodeLabels' => false,
        'items' => [
            ['label' => Yii::t('frontend', 'Home <i class="fa fa-plus navicn"></i>'), 'url' => ['/site/index'], ],
            ['label' => Yii::t('frontend', 'Find A Nanny <i class="fa fa-plus navicn"></i>'), 'url' => ['/nannies/index'], ],

            [
                'label' => Yii::t('frontend', 'Find A Job <i class="fa fa-plus navicn"></i>'),
                'url' => ['/find-a-job/list'],
            ],
            [
                'label' => Yii::t('frontend', 'Articles and Tools'),
                'items' => [
                    ['label' => Yii::t('frontend', 'Family articles'), 'url' => 'http://nannycare.com/family-articles/'],
                    ['label' => Yii::t('frontend', 'Nanny articles'), 'url' => 'http://nannycare.com/nanny-articles/'],
                    ['label' => Yii::t('frontend', 'Forms for Families'), 'url' => 'http://nannycare.com/forms-for-families/'],
                    ['label' => Yii::t('frontend', 'Product and Services'), 'url' => 'http://nannycare.com/products-and-services/'],
                    ['label' => Yii::t('frontend', 'Blog'), 'url' => 'http://nannycare.com/blog/'],
                ],
            ],
            [
                'label' => Yii::t('frontend','Resources'),
                'items' => [
                    ['label' => Yii::t('frontend', 'Background Checks'), 'url' => 'http://nannycare.com/background-checks/'],
                    ['label' => Yii::t('frontend', 'Sample Forms'), 'url' => 'http://nannycare.com/sample-forms/'],
                    ['label' => Yii::t('frontend', 'Nanny Taxes'), 'url' => 'http://nannycare.com/nanny-taxes/'],
                    ['label' => Yii::t('frontend', 'CPR/First Aid'), 'url' => 'http://nannycare.com/cprfirst-aid/'],
                    ['label' => Yii::t('frontend', 'INA'), 'url' => 'http://nannycare.com/ina/'],
                    [
                        'label' => Yii::t('frontend', 'Recommended Practices For Screening Nannies'),
                        'url' => ['http://nannycare.com/recommended-practices-for-screening/'],
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
                'label' => Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->getPublicIdentity() . (($unread = \common\models\UserNotify::UnreadNotifyCount()) ? "<span class=\"badge theme-bg-color unread-badge\">$unread</span>" : ''),
                'visible'=>!Yii::$app->user->isGuest,
                'items'=>[
                    [
                        'label' => Yii::t('frontend', 'Account'),
                        'url' => ['/user/default/index']
                    ],
                    [
                        'label' => Yii::t('frontend', 'VIP Service'),
                        'url' => 'http://nannycare.com/nannycare-coms-vip-services/',
                        'visible' => array_key_exists('seeker', Yii::$app->authManager->getRolesByUser(Yii::$app->user->id))
                    ],
                    [
                        'label' => Yii::t('frontend', 'Messages') . (isset($unread) && $unread ? "($unread)" : ''),
                        'url' => ['/user/default/notify'],
                        'visible' =>  !Yii::$app->user->isGuest //&& (bool)$unread
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
        ],
    ]); ?>
<?php NavBar::end();  ?>
    

