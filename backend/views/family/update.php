<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Families */

$this->title = 'Update Families: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Families', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="families-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
