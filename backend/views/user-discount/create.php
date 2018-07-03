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

        <!-- <?//= $form->field($model, 'expired_at')->textInput() ?> -->

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
