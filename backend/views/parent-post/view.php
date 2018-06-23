<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ParentPost */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Parent Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parent-post-view">

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'zip_code',
            'job_type',
            'type_of_help',
            'summary',
            'description:ntext',
            'status',
            'created_at',
            'expired_at',
        ],
    ]) ?>

</div>
