<?php


/* @var $this yii\web\View */
/* @var $model common\models\ParentPost */

$this->title = 'Update Parent Post: '.' '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Parent Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="parent-post-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
