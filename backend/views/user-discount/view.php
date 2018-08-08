<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UserDiscount;

/* @var $this yii\web\View */
/* @var $model common\models\UserDiscount */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'User Discounts', 'url' => [Yii::$app->request->getQueryParam('type', UserDiscount::TYPE_NANNY) == UserDiscount::TYPE_FAMILY_POST ? 'family' : 'nanny']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-discount-view">

    <p>
        <?= Html::a('Update', ['update', 'user_id' => $model->user_id, 'type' => Yii::$app->request->getQueryParam('type', UserDiscount::TYPE_NANNY)], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'user_id' => $model->user_id, 'type' => Yii::$app->request->getQueryParam('type', UserDiscount::TYPE_NANNY)], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'discount',
            'created_at',
            'expired_at',
        ],
    ]) ?>

</div>
