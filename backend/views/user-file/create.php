<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\file\models\UserFile */

$this->title = 'Create User File';
$this->params['breadcrumbs'][] = ['label' => 'User Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-file-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
