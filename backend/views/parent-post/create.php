<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ParentPost */

$this->title = 'Create Parent Post';
$this->params['breadcrumbs'][] = ['label' => 'Parent Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parent-post-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
