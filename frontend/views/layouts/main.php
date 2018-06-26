<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use common\widgets\DbText;

/* @var $this \yii\web\View */
/* @var $content string */
\frontend\assets\FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php include(Yii::getAlias('@frontend/views/layouts/css.php'));?>
    <?php echo Html::csrfMetaTags() ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-25957518-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
</script>
<style>
    #footer-div-1 > h2 {
        font-size: 30px;
        line-height: 42px;
        font-weight: 700;
        color: #ffffff;
        font-family: 'Lato', sans-serif;
    }
    #footer-div-1 > p {
        font-size: 17px;
        font-weight: 400;
        color: #ffffff;
        line-height: 24px;
        margin-bottom: 37px;
    }

    #footer-div-2 > ul > li {
        display: inline-block;
        height: 63px;
        width: 63px;
        background: #ffffff;
        color: #6E6460;
        border-radius: 50%;
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        text-align: center;
        margin: 0 3px;
        font-size: 36px;
        line-height: 63px;
        border: 2px solid #6E6460;
        -webkit-transition: all .3s ease; 
        transition: all .3s ease; 
        -webkit-transition: 0.3s;
    }

    #footer-div-2 > ul > li > a {
        display: inline-block;
        height: 63px;
        width: 63px;
        background: #ffffff;
        color: #6E6460;
        border-radius: 50%;
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        text-align: center;
        margin: 0 3px;
        font-size: 36px;
        line-height: 63px;
        border: 2px solid #6E6460;
        -webkit-transition: all .3s ease;
        transition: all .3s ease;
        -webkit-transition: 0.3s;
        }
</style>
</head>
<body>
<?php $this->beginBody() ?>
    <?php include(Yii::getAlias('@frontend/views/layouts/menu.php'));?>
    <?php if(!isset($this->params['offslide']))
        {
            echo \common\widgets\DbCarousel::widget([
                'key'=>'top_banner',
                'options' => [
                    'class' => 'slide', // enables slide effect
                ],
            ]);
        }
        if(isset($this->params['slider'])){
            echo \common\widgets\DbCarousel::widget([
                'key'=>$this->params['slider'],
                'options' => [
                    'class' => 'slide', // enables slide effect
                ],
            ]);
        }
        
    
    
    ?>
     
    <div class="container" id="container">

        <?php //echo Breadcrumbs::widget([
            //'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
       // ]) ?>

        <?php if(Yii::$app->session->hasFlash('alert')):?>
            <?php echo \yii\bootstrap\Alert::widget([
                'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
            ])?>
        <?php endif; ?>

        <?php echo $content ?>
    </div>
    
    <section class="footer" >
        <div class="top-strip"></div>
        <div class="footer-container container">
            <div class="row-margin">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" id="footer-div-1">
                        <h2>It's easy to find what you need!</h2>
                        <p class="heading-tag">Are you seeking nannies and babysitters in your neighborhood? With us, it’s easy!</p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="footer-div-2">
                        <ul class="social-share">
                            <li><a href="https://www.facebook.com/NannyCareUSA" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com/NannyCareUSA" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/nannycareusa/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
              
                <hr>
                <div class="row">
                    <div class="footer-left col-md-5" >
                        <h2>Contact Us</h2>
                        <p style="color:white;">
                            Worldwide Nanny Inc.
                            <br>
                            P.O. Box 231968
                            <br>
                            Encinitas, CA 92023
                        </p>
                        <ul>
                            <li style="color:white;">Phone</li>
                            <li style="color:white;">(888) 638-0860</li>
                            <li style="color:white;">Email</li>
                            <li style="color:white;"><a href="mailto:support@nannycare.com">support@nannycare.com</a></li>
                        </ul>
                        <hr />
                        <h2>Disclaimer</h2>
                        <p style="color:white">NannyCare.com does not employ any caregiver ( nanny, babysitter, newborn specialist, elderly caregiver or housekeeper ) listed on our site and accepts no responsibility for provider's (client, family, user, parent) selection of a caregiver, or for any caregiver's conduct or performance. Provider is ultimately responsible for selecting a caregiver and for complying with all applicable laws that may apply when employing a household employee. Provider is fully responsible for their caregiver selection, checking references, interviewing and screening applicants and interpreting the background check results. NannyCare.com's screening services and background checks are not a substitution for a provider doing their own   thorough screening. Caregivers should never be hired on the spot or without being interviewed in-person first. Our site provides an abundance of helpful tools, articles and resources to help families make smart, safe hiring decisions.
                        </p>
                        <p style="color:white">
NannyCare.com and the slogan "We put care in finding a nanny" are registered trademarks
© 2000-<?=date('Y'); ?> NannyCare.com, Inc. All rights reserved.
                        </p>
                    </div>
                    <div class="footer-right col-md-7">
                        <div class="row">
                            <div class="col-md-4">
                                <h2>Resources</h2>
                                <ul>
                                    <li>Our Screening Process</li>
                                    Steps To Hiring a Nanny
                                    What To Pay The Nanny- By City
                                    Safety Guide For Families 
                                    Safety Guide For Nannies
                                    Family Articles
                                    Nanny Articles
                                    Nanny Forms
                                </ul>
                            </div>
                            <div class="col-md-4 footer-company">
                                <h2>The Company</h2>
                                <ul>
                                    <li><a href="/page/about">How it works</a></li>
                                    <li><a href="/page/about">FAQ</a></li>
                                    <li><a href="/page/about">Testimonials</a></li>
                                    <li><a href="/page/about">VIP Services</a></li>
                                    <li><a href="/page/about">Terms & Conditions</a></li>
                                    <li><a href="/page/about">Privacy Policy</a></li>
                                </ul>
                            </div>
                            <div class="col-md-4 ">
                                <h2>Instagram</h2>
                                <ul class="footer-instagram">
                                    <li>
                                        <a href="https://www.instagram.com/nannycareusa/"><img src="/images/insta1.jpg" alt=""></a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/nannycareusa/"><img src="/images/insta2.jpg" alt=""></a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/nannycareusa/"><img src="/images/insta3.jpg" alt=""></a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/nannycareusa/"><img src="/images/insta4.jpg" alt=""></a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/nannycareusa/"><img src="/images/insta5.jpg" alt=""></a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/nannycareusa/"><img src="/images/insta6.jpg" alt=""></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-12 footer-cities">
                                <h2 class="text-left">Cities</h2>
                                <ul>
                                    <li><a href="/find-a-nanny/atlanta-nanny/">Atlanta </a></li>
                                    <li><a href="/find-a-nanny/atlanta-nanny/">Atlanta </a></li>
                                    <li><a href="/find-a-nanny/atlanta-nanny/">Atlanta </a></li>
                                    <li><a href="/find-a-nanny/atlanta-nanny/">Atlanta </a></li>
                                    <li><a href="/find-a-nanny/atlanta-nanny/">Atlanta </a></li>
                                    <li><a href="/find-a-nanny/atlanta-nanny/">Atlanta </a></li>
                                    <li><a href="/find-a-nanny/atlanta-nanny/">Atlanta </a></li>
                                    <li><a href="/find-a-nanny/atlanta-nanny/">Atlanta </a></li>
                                    <li><a href="/find-a-nanny/atlanta-nanny/">Atlanta </a></li>
                                    <li><a href="/find-a-nanny/atlanta-nanny/">Atlanta </a></li>
                                    <li><a href="/find-a-nanny/atlanta-nanny/">Atlanta </a></li>
                                    <li><a href="/find-a-nanny/atlanta-nanny/">Atlanta </a></li>
                                    <li><a href="/find-a-nanny/atlanta-nanny/">Atlanta </a></li>
                                    <li><a href="/find-a-nanny/atlanta-nanny/">Atlanta </a></li>
                                    <li><a href="/find-a-nanny/atlanta-nanny/">Atlanta </a></li>
                                    <li><a href="/find-a-nanny/atlanta-nanny/">Atlanta </a></li>
                                    <li><a href="/find-a-nanny/atlanta-nanny/">Atlanta </a></li>
                                    <li><a href="/find-a-nanny/atlanta-nanny/">Atlanta </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--        <div class="container">-->
<!--            <div class="row-margin">-->
<!--                <div class="row ">-->
<!--                    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">-->
<!--                        <h2>It's easy to find what you need!</h2>-->
<!--                        <p class="heading-tag">Are you seeking nannies and babysitters in your neighborhood? With us, it’s easy!</p>-->
<!--                    </div>-->
<!--                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">-->
<!--                        <ul class="social-share">-->
<!--                            <li><a href="https://www.facebook.com/NannyCareUSA" target="_blank"><i class="fa fa-facebook"></i></a></li>-->
<!--                            <li><a href="https://twitter.com/NannyCareUSA" target="_blank"><i class="fa fa-twitter"></i></a></li>-->
<!--                            <li><a href="https://www.instagram.com/nannycareusa/" target="_blank"><i class="fa fa-instagram"></i></a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <hr>-->
<!--                <div class="row">-->
<!--                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">-->
<!--                        --><?php //echo DbText::widget(['key' => 'footer_column_1']) ?>
<!--                    </div>-->
<!--                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">-->
<!--                        --><?php //echo DbText::widget(['key' => 'footer_column_2']) ?>
<!---->
<!--                    </div>-->
<!--                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">-->
<!--                        --><?php //echo DbText::widget(['key' => 'footer_column_3']) ?>
<!---->
<!--                    </div>-->
<!--                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">-->
<!--                        --><?php //echo DbText::widget(['key' => 'footer_column_4']) ?>
<!---->
<!--                    </div>-->
<!--                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">-->
<!--                        --><?php //echo DbText::widget(['key' => 'footer_instagram']) ?>
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="row">-->
<!--                    <p style="color:white">NannyCare.com does not employ any caregiver (nanny, babysitter, newborn specialist, elderly caregiver or housekeeper) listed on our site and accepts no responsibility for provider's (client, family, user, parent) selection of a caregiver, or for any caregiver's conduct or performance. Provider is ultimately responsible for selecting a caregiver and for complying with all applicable laws that may apply when employing a household employee. Provider is fully responsible for their caregiver selection, checking references, interviewing and screening applicants and interpreting the background check results. NannyCare.com's screening services and background checks are not a substitution for a provider doing their own   thorough screening. Caregivers should never be hired on the spot or without being interviewed in-person first. Our site provides an abundance of helpful tools, articles and resources to help families make smart, safe hiring decisions.-->
<!--                    </p>-->
<!--                    <p style="color:white">NannyCare.com and the slogan "We put care in finding a nanny" are registered trademarks-->
<!--                    © 2000---><?//=date('Y'); ?><!-- NannyCare.com, Inc. All rights reserved.-->
<!--                    </p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <div class="back-to-top"><a href="#" title="Move to top">TOP</a> </div>
    </section>
<?php $this->endBody() ?>
<?php include(Yii::getAlias('@frontend/views/layouts/js.php'));?>
</body>
</html>
<?php $this->endPage() ?>