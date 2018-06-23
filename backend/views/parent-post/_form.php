<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ParentPost */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="parent-post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'zip_code')->textInput() ?>

    <?php echo $form->field($model, 'job_type')->dropDownList([
        '1' => 'Full time',
        '2' => 'Part time',
        '3' => 'Live in',
        '4' => 'Babysitter',
        '5' => 'Temporary',
        '6' => 'Overnight care',
    ]) ?>

    <?php echo $form->field($model, 'type_of_help')->dropDownList([
        '1' => 'Nanny',
        '2' => 'Babysitter',
        '3' => 'Newborn Specialist',
        '4' => 'Special Needs',
        '5' => 'Caregiver',
        '6' => 'Housekeeper',
    ]) ?>

    <?php echo $form->field($model, 'summary')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php // echo $form->field($model, 'status')->textInput() ?>

    <?php // echo $form->field($model, 'expired_at')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
