<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ParentPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Parent Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parent-post-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?php // echo Html::a('Create Parent Post', ['create'], ['class' => 'btn btn-success']) ?>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'user_id',
            'zip_code',
//            'job_type',
//            'type_of_help',
             'summary',
            // 'description:ntext',
            // 'status',
             'created_at:date',
            [
                'attribute' => 'expired_at',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->expired_at < time()) {
                        return Html::tag('tag', date('M j,Y', $model->expired_at), ['style' => 'color: red']);
                    } else {
                        return date('M j,Y', $model->expired_at);
                    }
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {approved}',
                'buttons' => [
                    'approved' => function ($url, $model, $key) {
                        $html = '';
                        if ($model->status == \common\models\ParentPost::STATUS_PENDING) {

                            $html .= Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-ok']), $url, ['title' => 'approved']);
                            $html .= ' ';
                            $html .= Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-remove']), \yii\helpers\Url::to(['un-approved', 'id' => $model->id]), ['title' => 'unapproved']);
                        }
                        return $html;
                    }
                ]
            ],
        ],
    ]); ?>

</div>
