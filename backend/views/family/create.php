<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Families */

$this->title = 'Create Families';
$this->params['breadcrumbs'][] = ['label' => 'Families', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="families-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
