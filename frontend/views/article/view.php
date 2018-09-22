<?php
/* @var $this yii\web\View */
/* @var $model common\models\Article */
use yii\helpers\Html;
use yii\web\View;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs(
    '
    $(document).ready(function () {
        $("html, body").animate({scrollTop: $(".slide").height()+$(".navbar").height()+100},"slow");
        console.log($("slide").height());
            });
    ',
    View::POS_READY,
    'my-button-handler'
);
?>
<div class="row row-margin article">
    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
        <div class="single-blog-post">
            <div class="blog-box">
                <h3 class="blog-title"><?= $model->title ?></h3>
                <p class="blog-date">21 - March - 2016</p>
                <?php if ($model->thumbnail_path): ?>
                    <div class="blog-img">
                        <?php echo Html::a(Html::img(
                            Yii::$app->glide->createSignedUrl([
                                'glide/index',
                                'path' => $model->thumbnail_path,
                            ], true),
                            ['class' => 'article-thumb img-rounded pull-left']
                        ), ['view', 'slug'=>$model->slug]); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?= $model->body ?>
        </div>
                
                
        <!-- side bar -->
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12"></div>
    </div>
</div>
