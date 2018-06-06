<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserOrder */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="user-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'user_id')->textInput() ?>

    <?php echo $form->field($model, 'user_type')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'payment_gateway')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'payment_gateway_id')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'service_plan')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'service_money')->textInput() ?>

    <?php echo $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
