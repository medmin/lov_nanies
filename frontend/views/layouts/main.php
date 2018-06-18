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
    
    <section class="footer">
        <div class="top-strip"></div>
        <div class="container">
            <div class="row-margin">
                <div class="row ">
                    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                        <h2>It's easy to find what you need!</h2>
                        <p class="heading-tag">Are you seeking nannies and babysitters in your neighborhood? With us, it’s easy!</p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <ul class="social-share">
                            <li><a href="https://www.facebook.com/NannyCareUSA" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com/NannyCareUSA" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/nannycareusa/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <?php echo DbText::widget(['key' => 'footer_column_1']) ?>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <?php echo DbText::widget(['key' => 'footer_column_2']) ?>
                        
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <?php echo DbText::widget(['key' => 'footer_column_3']) ?>
                        
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <?php echo DbText::widget(['key' => 'footer_column_4']) ?>
                        
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <?php echo DbText::widget(['key' => 'footer_instagram']) ?>
                    </div>
                </div>
                <div class="copyright">
                    <p>&copy; 2000 - <?=date('Y'); ?> Nannycare | All rights reserved </p>
                </div>
            </div>
        </div>
        <div class="back-to-top"><a href="#" title="Move to top">TOP</a> </div>
    </section>
<?php $this->endBody() ?>
<?php include(Yii::getAlias('@frontend/views/layouts/js.php'));?>
</body>
</html>
<?php $this->endPage() ?>