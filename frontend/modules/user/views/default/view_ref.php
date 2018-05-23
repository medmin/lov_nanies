<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Refs */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Refs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="refs-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update_ref', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'reference_name:ntext',
            'reference_address:ntext',
            'contact_number:ntext',
            'ref_contact_email:ntext',
            'how_do_you_know:ntext',
            'years_known:ntext',
        ],
    ]) ?>

</div>
