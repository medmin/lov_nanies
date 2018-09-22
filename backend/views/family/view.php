<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Families */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Families', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="families-view">

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method'  => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            'status',
            'name:ntext',
            'address:ntext',
            'phone:ntext',
            'children:ntext',
            'type_of_help:ntext',
            'work_out_of_home:ntext',
            'special_needs:ntext',
            'driving:ntext',
            'when_start:ntext',
            'how_heared_about_us:ntext',
        ],
    ]) ?>

</div>
