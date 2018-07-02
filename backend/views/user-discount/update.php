<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserDiscount */

$this->title = 'Update User Discount: ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'User Discounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-discount-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
