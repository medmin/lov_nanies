<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-order-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'user_id',
            'user_type',
            'attribute' => 'payment_gateway',
            'payment_gateway_id',
             'service_plan',
             [
                'attribute'  =>'service_money',
                'label' => 'Amount'
             ],
             
             'timestamp:datetime',
             'expired_at:datetime'

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
