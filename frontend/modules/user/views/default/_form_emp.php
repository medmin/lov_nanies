<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Employment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'employer_name')->textInput() ?>

    <?= $form->field($model, 'employer_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'from_date')->textInput() ?>

    <?= $form->field($model, 'to_date')->textInput() ?>

    <?= $form->field($model, 'position_type')->textInput() ?>

    <?= $form->field($model, 'number_of_children')->textInput(['number']) ?>

    <?= $form->field($model, 'ages_of_children_started')->textInput() ?>

    <?= $form->field($model, 'ages_of_children_left')->textInput() ?>

    <?= $form->field($model, 'responsibilities')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'salary_starting')->textInput() ?>

    <?= $form->field($model, 'salary_ending')->textInput() ?>

    <?= $form->field($model, 'may_we_contact')->textInput() ?>

    <?= $form->field($model, 'contact_phone')->textInput() ?>

    <?= $form->field($model, 'contact_email')->textInput() ?>

    <?= $form->field($model, 'reason_for_leaving')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hours_worked')->textInput() ?>

    <?= $form->field($model, 'was_this_a_live_in_position')->textInput() ?>

    <?= $form->field($model, 'emloyer_comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
