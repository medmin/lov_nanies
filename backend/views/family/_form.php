<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Families */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="families-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'id')->textInput() ?>

    <?php echo $form->field($model, 'status')->textInput() ?>

    <?php echo $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'phone')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'children')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'type_of_help')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'work_out_of_home')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'special_needs')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'driving')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'when_start')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'how_heared_about_us')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
