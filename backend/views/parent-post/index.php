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
             'expired_at:date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
