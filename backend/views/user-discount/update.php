<?php

use yii\helpers\Html;
use common\models\UserDiscount;

/* @var $this yii\web\View */
/* @var $model common\models\UserDiscount */

$this->title = 'Update User Discount: ' . $model->user_id . '('. Yii::$app->user->identity->username .')';
$this->params['breadcrumbs'][] = ['label' => 'User Discounts', 'url' => [Yii::$app->request->getQueryParam('type', UserDiscount::TYPE_NANNY) == UserDiscount::TYPE_FAMILY_POST ? 'family' : 'nanny']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-discount-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
