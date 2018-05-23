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
        <h2 style="color: #414141;">Account Info</h2>
        
        <?php echo $form->field($model->getModel('account'), 'username') ?>
    
        <?php echo $form->field($model->getModel('account'), 'email') ?>
    
        <?php echo $form->field($model->getModel('account'), 'password')->passwordInput() ?>
    
        <?php echo $form->field($model->getModel('account'), 'password_confirm')->passwordInput() ?>
    
        <div class="form-group">
            <?php echo Html::submitButton(Yii::t('frontend', 'Update'), ['class' => 'nav-btn']) ?>
            
        </div>
    </div>
        <div class="col-md-6">
        <h2 style="color: #414141;">Profile details</h2>
            <h3><b>Personal data:</b><span style="float: right;"><a href="/user/sign-in/continue-family" class="btn btn-inverse">Edit</a></span></h3>
            <h3><b>Credits:</b> <?php echo $model->getModel('account')->credits; ?><span style="float: right;"><a href="get-credits" class="btn btn-inverse">Get Credits</a></span></h3>
            <h3><b>Nannies Selected:</b></h3>
        </div>
        
    <?php ActiveForm::end(); ?>

</div>
