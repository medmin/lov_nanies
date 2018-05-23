<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Refs */

$this->title = 'Create Refs';
$this->params['breadcrumbs'][] = ['label' => 'Refs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="refs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_ref', [
        'model' => $model,
    ]) ?>

</div>
