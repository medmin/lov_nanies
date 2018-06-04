<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\widgets\ActiveForm */
$this->registerJs(
    '
    $(document).ready(function () {
        $("html, body").animate({scrollTop: $(".slide").height()+$(".navbar").height()},"slow");
        console.log($("slide").height());
        $("#reset_button").click(function(){
            $(this).addClass("hidden");
            $("#reset_pwd").removeClass("hidden");
        })
     });
    ',
    View::POS_READY,
    'my-button-handler'
);
$this->title = Yii::t('frontend', 'User Account')
?>

<div class="user-profile-form">

    <?php $form = ActiveForm::begin(); ?>
    <br>
    <div class="col-md-6">   
        <h2 style="color: #414141;">My NannyCare Account</h2>
        <div class="container">
            <div class="row">
                <div class="md-col-6">
                    <?= $form->field($model->getModel('account'), 'username')->textInput(['readOnly' => true]) ?>
                </div>
                <div class="md-col-6">
                    <?= $form->field($model->getModel('account'), 'email')->textInput(['readOnly' => true]) ?>
                </div>
            </div>
        </div>

        <div class="hidden" id="reset_pwd">
            <?= $form->field($model->getModel('account'), 'password')->passwordInput() ?>

            <?= $form->field($model->getModel('account'), 'password_confirm')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('frontend', 'Confirm Reset Password'), ['class' => 'nav-btn']) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::Button(Yii::t('frontend', 'Reset Password'), ['class' => 'nav-btn', 'id' => 'reset_button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

    <div class="col-md-6">
        <h2 style="color: #414141;">My Profile</h2>
        <h3><b>Personal data:</b><span style="float: right;"><a href="/user/sign-in/continue-family" class="btn btn-inverse">Edit Profile</a></span></h3>
        <h3><b>Credits:</b> <?= $model->getModel('account')->credits; ?><span style="float: right;"><a href="get-credits" class="btn btn-inverse">Get Credits</a></span></h3>
        <h3><b>Nannies Selected:</b><span style="float: right;"><a href="/nannies/index" class="btn btn-inverse">Select Nannies</a></span></h3>
        <div class="container">
            <ul>
                <?php
                  $model->getModel('account')->credits; 
                ?>
            </ul>
        </div>
    </div>
</div>
