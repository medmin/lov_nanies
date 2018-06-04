<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Employment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Employments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edit', ['update_emp', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'email:ntext',
            'employer_name:ntext',
            'employer_address:ntext',
            'from_date:ntext',
            'to_date:ntext',
            'position_type:ntext',
            'number_of_children',
            'ages_of_children_started:ntext',
            'ages_of_children_left:ntext',
            'responsibilities:ntext',
            'salary_starting:ntext',
            'salary_ending:ntext',
            'may_we_contact:ntext',
            'contact_phone:ntext',
            'contact_email:ntext',
            'reason_for_leaving:ntext',
            'hours_worked:ntext',
            'was_this_a_live_in_position:ntext',
            'emloyer_comment:ntext',
        ],
    ]) ?>

</div>
