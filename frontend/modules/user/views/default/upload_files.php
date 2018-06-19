<?php

use yii\bootstrap\ActiveForm;
use yii\web\View;

/* @var $model \common\modules\file\models\UserFile */
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

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
            <?php $form = ActiveForm::begin([
                    'options' => [
                        'enctype' => 'multipart/form-data',
                    ],
                'action' => '/file/user/upload'
            ]); ?>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <ul class="process-label">
                    <a href="main"><li class="process-label2" id="label-1">Main <span><i class="fa fa-long-arrow-right"></i></span></li></a>
                    <a href="questions-n-schedule"><li class="process-label2" id="label-2">Questions & Schedule<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                    <a href="education-n-driving"><li class="process-label2" id="label-3">Education & Driving <span><i class="fa fa-long-arrow-right"></i></span></li></a>
                    <a href="housekeeping"><li class="process-label2" id="label-4">Housekeeping<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                    <a href="about-you"><li class="process-label2" id="label-5">About you<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                    <a href="upload-files"><li class="process-label2 active" id="label-6">Upload Files<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                </ul>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class=""></i> Upload Files</h3>
                        </div>
                        <div class="panel-body">
                            <?= $form->field($model, 'title')->label(Yii::t('frontend','File Name'))->textInput(['maxlength' => 300]) ?>
                            <?= $form->field($model, 'file')->label(Yii::t('frontend', 'Choose File'))->fileInput() ?>
                            <p class="text-muted well well-sm no-shadow">
                                Attention: <br />
                                You can upload only 1 file at once and the total size should be no more than 10M. <br>
                                Supported formats are tif, png, jpg, doc, docx, xls, xlsx, ppt, pptx, pdf, zip, rar, 7z, txt.
                            </p>
                            <div class="form-group">
                                <?= \yii\helpers\Html::submitInput(Yii::t('frontend', 'Upload'), ['class' => 'btn btn-inverse', 'name' => 'upload-files-button'])?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>
