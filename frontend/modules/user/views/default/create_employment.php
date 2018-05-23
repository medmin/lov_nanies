<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Employment */

$this->title = 'Create Employment';
$this->params['breadcrumbs'][] = ['label' => 'Employments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_emp', [
        'model' => $model,
    ]) ?>

</div>
