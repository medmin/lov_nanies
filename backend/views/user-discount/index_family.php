<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\Models\User;

/* @var $this yii\web\View */
/* @var $offForAllFamiliesPost */
/* @var $searchModel backend\models\search\UserDiscountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Discounts For Families ( Only For Post Service, For Now)');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-discount-index">
    <div class="callout callout-<?= $offForAllFamiliesPost !== null ? 'success' : 'warning' ?>">
        <h4>
            <?php
            if ($offForAllFamiliesPost !== null) {
                echo 'Current Post-Discount ( For All Families ): ' . $offForAllFamiliesPost. '% off &nbsp;&nbsp;&nbsp;' . Html::a('Update Post-Discount For All Families ', ['create', 'type' => \common\models\UserDiscount::TYPE_FAMILY_POST], ['style' => 'font-size: 16px']);
            } else {
                echo 'You have not set(or already expired) the Post-Discount For All Families yet! ' . Html::a('Set the Post-Discount For All Families now', ['create', 'type' => \common\models\UserDiscount::TYPE_FAMILY_POST], ['style' => 'font-size: 16px']);
            }
            ?>
        </h4>
    </div>
    <hr>
    <div class="callout callout-info">
        <h3>List of Post-Discounts For Each Family <?= Html::a('Set A Post-Discount For A Family', ['/family/index'], ['style' => 'font-size: 16px']); ?></h3>
    </div>
    <br>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//         'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'user_id',
                'label' => 'User Info',
                'format' => 'html',
                'value' => function($model){
                    if ($model->user_id == 0) {
                        return Html::tag('span', 'All Nannies', ['style' => 'color: red']);
                    } else {
                        return Html::a(User::findById($model->user_id)->username, Yii::$app->urlManagerBackend->createAbsoluteUrl('/family/view?id='.$model->user_id), ['target' => '_blank']);
                    }
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
                'format' => 'html',
                'label' => 'Expired At ( Status )',
                'value' => function($model){
                    if ($model->expired_at  && $model->expired_at >= time() )
                    {
                        return date("F j, Y", $model->expired_at );
                    }
                    else if ($model->expired_at  && $model->expired_at < time())
                    {
                        return Html::tag('span', 'Expired', ['style' => 'color: red']);
                    }
                    else {
                        return Html::tag('span', 'Not set and thus discount invalid', ['style' => 'color: red']);
                    }
                
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        if ($model->user_id == 0) {
                            $url = 'create?type='.\common\models\UserDiscount::TYPE_FAMILY_POST;
                        }
                        return Html::a(Html::tag('span', '', ['class' => "glyphicon glyphicon-pencil"]), $url, ['title' => Yii::t('yii', 'Update'), 'aria-label' => Yii::t('yii', 'Update'), 'data-pjax' => '0',]);
                    }
                ]
            ],
        ],
    ]); ?>
</div>
