<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserDiscountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Discounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-discount-index">

    <div class="callout callout-<?= $allDiscount !== null ? 'success' : 'info' ?>">
        <h4>
            <?php
            if ($allDiscount !== null) {
                echo 'Current Discount (All Nannies): ' . $allDiscount . '&nbsp;&nbsp;&nbsp;' . Html::a('Update All Nannies Discount', ['create']);
            } else {
                echo 'Not Set All Nannies Discount ! ' . Html::a('Go To Set', ['create']);
            }
            ?>
        </h4>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            'discount',
//            'created_at',
//            'expired_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>
