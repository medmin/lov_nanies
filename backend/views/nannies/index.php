<?php

use common\grid\EnumColumn;
use common\models\UserProfile;
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Nannies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            'id',
            'name:text',
            'email:email',
            'address:text',
            [
                'class' => EnumColumn::className(),
                'attribute' => 'status',
                'enum' => UserProfile::statuses(),
                'filter' => UserProfile::statuses()
            ],
            /*'created_at:datetime',
            'logged_at:datetime',
            // 'updated_at',*/

            ['class' => 'yii\grid\ActionColumn',
             'buttons' => [
                'dereactivation' => function ($url, $model) {
                    return ($model->status==-1|| $model->status==-10) ? Html::a('<span class="glyphicon glyphicon-refresh"></span>', $url, [
                                'title' => Yii::t('app', 'Reactivate'),
                    ]) : "";
                    
                },
                 'approve' => function ($url, $model) {
                    return $model->status==0 ? Html::a('<span class="glyphicon glyphicon-check"></span>', $url, [
                                'title' => Yii::t('app', 'Approve'),
                    ]): "";
                },
                 'deactivate' => function ($url, $model) {
                    return $model->status==1 ? Html::a('<span class="glyphicon glyphicon-eye-close"></span>', $url, [
                                'title' => Yii::t('app', 'Deactivate'),
                    ]): "";
                },
            ],
             'template' => '{update} {approve} {dereactivation} {deactivate} {delete}'],
        ],
    ]); ?>

</div>
