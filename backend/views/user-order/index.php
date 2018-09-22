<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-order-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'user_id',
                'format'    => 'raw',
                'value'     => function ($model) {
                    if (!($model->user) || $model->user->status == \common\models\User::STATUS_DELETED) {
                        return '<span style="color: red;" title="Invalid user">'.$model->user_id.'</span>';
                    } else {
                        return Html::a($model->user->username, ['/user/view', 'id' => $model->user_id]);
                    }
                },
            ],
            'user_type',
            'attribute' => 'payment_gateway',
            'payment_gateway_id',
             'service_plan',
             [
                 'attribute'  => 'service_money',
                 'label'      => 'Amount',
                 'value'      => function ($model) {
                     return $model->service_money / 100;
                 },
             ],

             'timestamp:datetime',
             'expired_at:datetime',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
