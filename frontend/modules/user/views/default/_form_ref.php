<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Refs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="refs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reference_name')->textInput() ?>

    <?= $form->field($model, 'reference_address')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'contact_number')->textInput() ?>

    <?= $form->field($model, 'ref_contact_email')->textInput(['email']) ?>

    <?= $form->field($model, 'how_do_you_know')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'years_known')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-inverse' : 'btn btn-inverse']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
