<?php


/* @var $this yii\web\View */
/* @var $model common\models\UserOrder */

$this->title = 'Update User Order: '.' '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-order-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
