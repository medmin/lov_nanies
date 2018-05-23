<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Families;
use common\grid\EnumColumn;
use common\models\User;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Families';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="families-index">



    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'content'=>function($data){
                 return User::find()->where(['id'=>$data->id])->one()->email;
                },
                'attribute' => 'email',
            ],
             
            [
                'class' => EnumColumn::className(),
                'attribute' => 'status',
                'enum' => Families::statuses(),
                'filter' => Families::statuses()
            ],
            'name:ntext',
            'address:ntext',
            'phone:ntext',
            // 'children:ntext',
            // 'type_of_help:ntext',
            // 'work_out_of_home:ntext',
            // 'special_needs:ntext',
            // 'driving:ntext',
            // 'when_start:ntext',
            // 'how_heared_about_us:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
