<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\Models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserDiscountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-discount-index">
    <div class="callout callout-<?= $offForAllNannies !== null ? 'success' : 'warning' ?>">
        <h4>
            <?php
            if ($offForAllNannies !== null) {
                echo 'Current Discount ( For All Nannies ): ' . ( 100 - $offForAllNannies ). '% off &nbsp;&nbsp;&nbsp;' . Html::a('Update Discount For All Nannies ', ['create']);
            } else {
                echo 'You have not set the Discount For All Nannies yet! ' . Html::a('Set the Discount For All Nannies now', ['create']);
            }
            ?>
        </h4>
    </div>
    <hr>
    <div class="callout callout-info">
        <h3>List of Discounts For Each Nanny <?= Html::a('Set A Discount For A Nanny', ['#']); ?></h3>
    </div>
    <br>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'user_id',
                'label' => 'User Info',
                'format' => 'html',
                'value' => function($model){
                    //这里根据角色来输出不同的名字
                    // return '<a href="">Username: ' . User::findById($model->user_id)->username . '</a>';
                    return Html::a(User::findById($model->user_id)->username, Yii::$app->urlManagerFrontend->createAbsoluteUrl('/nannies/view?id='.$model->user_id), ['target' => '_blank']);
                }
            ],
            
            'discount',
            
            [
                'attribute' => 'created_at',
                'format' =>'date',
                'label' => 'Created At'
            ],
            [
                'attribute' => 'expired_at',
                'format' => 'text',
                'label' => 'Expired At ( Status )',
                'value' => function($model){
                    if ($model->expired_at  && $model->expired_at >= time() )
                    {
                        return date("F j, Y", $model->expired_at );
                    }
                    else if ($model->expired_at  && $model->expired_at < time())
                    {
                        return "Expired";
                    }
                    else {
                        return "Valid Forever";
                    }
                
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>
