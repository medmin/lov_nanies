<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserDiscount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-discount-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?//= $form->field($model, 'user_id')->textInput() ?> -->

    <?= $form->field($model, 'discount')->input('integer') ?>

    <!-- <?//= $form->field($model, 'created_at')->textInput() ?> -->

    <?= $form->field($model, 'expired_at')->input('integer') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
