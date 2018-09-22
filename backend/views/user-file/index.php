<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserFileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Files';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-file-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'title',
            [
                'attribute' => 'user_id',
                'format'    => 'raw',
                'value'     => function ($model) {
                    return Html::a($model->user_id, \yii\helpers\Url::to(['/user/view', 'id' => $model->user_id]));
                },
            ],
//            [
//                'label' => 'Family/Nanny',
//                'value' => function ($model) {
//                    $userRoles = Yii::$app->authManager->getRolesByUser($model->user_id);
//                    if (array_key_exists('nanny', $userRoles)) {
//                        return 'Nanny';
//                    } elseif (array_key_exists('seeker', $userRoles)){
//                        return 'Family';
//                    } else {
//                        return 'Other';
//                    }
//                }
//            ],
//            'file_uuid',
            'ext',
            // 'link',
//             'status',
            'created_at:datetime',
//             [
//                 'attribute' => 'created_at',
//                 'format' => ['date', 'php:Y-m-d H:i:s']
//             ],
            // 'updated_at',
            // 'deleted_at',

            [
                'class'    => 'yii\grid\ActionColumn',
                'header'   => Yii::t('backend', 'Operate'),
                'template' => '{download} &nbsp;&nbsp; {delete}',
                'buttons'  => [
                        'download' => function ($url, $model, $key) {
                            return Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-download-alt']), \yii\helpers\Url::to(['/file/user/download', 'user_id' => $model->user_id, 'file_uuid' => $model->file_uuid]), ['title' => 'Download']);
                        },
                ],
            ],
        ],
    ]); ?>

</div>
