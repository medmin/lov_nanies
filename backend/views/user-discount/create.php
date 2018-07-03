<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\UserDiscount */

$this->title = 'Create User Discount';
$this->params['breadcrumbs'][] = ['label' => 'User Discounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-discount-create">

    <h1>Discount ( % off ) For All Nannies</h1>

    <div class="user-discount-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'discount')->input('integer') ?>

         <?= $form->field($model, 'expired_at')->widget(\kartik\datetime\DateTimePicker::className(), [
                 'options' => [
                     'placeholder' => 'select date',
                     'value' => date('Y-m-d H:i:s', $model->expired_at ?: strtotime('+1 day'))
                 ],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii:ss',
                    'initialDate' => date('Y-m-d H:i:s', $model->expired_at ?: strtotime('+1 day')),
                    'todayHighlight' => true
                ]
         ]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->user_id], ['class' => 'btn btn-warning', 'style' => 'margin-left: 20px', 'title' => 'cancel discount for all nannies', 'data-pjax' => 0, 'data-confirm' => 'Are you sure you want to cancel discount for all nannies?', 'data-method' => 'post'])?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
