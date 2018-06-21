<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\file\models\UserFile */

$this->title = 'Update User File: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'User Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-file-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
