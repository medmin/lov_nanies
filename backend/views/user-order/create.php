<?php


/* @var $this yii\web\View */
/* @var $model common\models\UserOrder */

$this->title = 'Create User Order';
$this->params['breadcrumbs'][] = ['label' => 'User Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-order-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
