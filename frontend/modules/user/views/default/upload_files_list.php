<?php

use yii\bootstrap\ActiveForm;
use yii\web\View;

/* @var $model \common\modules\file\models\UserFile */
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->registerJs(
    '
    $(document).ready(function () {
        $("html, body").animate({scrollTop: $(".slide").height()+$(".navbar").height()},"slow");
        console.log($("slide").height());
            });
    ',
    View::POS_READY,
    'my-button-handler'
);

$this->title = Yii::t('frontend', 'Upload Files');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="signup-process" style="margin-top:20px;">
    <div class="container">
        <div class="col-lg-12">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <ul class="process-label">
                    <a href="main"><li class="process-label2" id="label-1">Main <span><i class="fa fa-long-arrow-right"></i></span></li></a>
                    <a href="questions-n-schedule"><li class="process-label2" id="label-2">Questions & Schedule<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                    <a href="education-n-driving"><li class="process-label2" id="label-3">Education & Driving <span><i class="fa fa-long-arrow-right"></i></span></li></a>
                    <a href="housekeeping"><li class="process-label2" id="label-4">Housekeeping<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                    <a href="about-you"><li class="process-label2" id="label-5">About you<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                    <a href="upload-files"><li class="process-label2" id="label-6">Upload Files<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                    <a href="upload-files-list"><li class="process-label2 active" id="label-7">Files List<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                </ul>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class=""></i> Upload Files</h3>
                        </div>
                        <div class="panel-body">
                            <?php if ($dataProvider->count == 0) : ?>
                                <p class="text-center" style="margin-bottom: 20px"><?= Yii::t('frontend', 'Not File Found')?></p>
                                <a href="upload-files"><button class="btn btn-inverse"><?= Yii::t('frontend', 'Go to upload') ?></button></a>
                            <?php else :
                            echo \yii\grid\GridView::widget([
                                'dataProvider' => $dataProvider,
                                'tableOptions' => ['class' => 'table'],
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    'title',
                                    [
                                        'attribute' => 'created_at',
                                        'label' => Yii::t('frontend', 'Upload Date'),
                                        'format' => ['date', 'php:Y-m-d H:i']
                                    ],
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'header' => Yii::t('frontend', 'Download Link'),
                                        'template' => '{download}',
                                        'buttons' => [
                                            'download' => function ($url, $model, $key) {
                                                return \yii\helpers\Html::a(Yii::t('frontend', 'Download'), \yii\helpers\Url::to(['/file/user/download', 'user_id' => $model->user_id, 'file_uuid' => $model->file_uuid]));
                                            }
                                        ]
                                    ]
                                ]
                            ]);

                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
