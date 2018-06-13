<?php
/**
 * @var $model common\models\TimelineEvent
 */
?>
<div class="timeline-item">
    <span class="time">
        <i class="fa fa-clock-o"></i>
        <?php echo Yii::$app->formatter->asRelativeTime($model->created_at) ?>
    </span>

    <h3 class="timeline-header" style="background-color:gainsboro;">
        <?php echo Yii::t('backend', 'You have new nanny listing!') ?>
    </h3>

    <div class="timeline-body">
        <?php echo Yii::t('backend', 'New nanny ({identity}) listing order was created at {created_at}', [
            'identity' => $model->data['public_identity'],
            'created_at' => Yii::$app->formatter->asDatetime($model->data['created_at'])
        ]) ?>
    </div>

    <div class="timeline-footer">
        <?php echo \yii\helpers\Html::a(
            Yii::t('backend', 'View order'),
            ['/order/view', 'id' => $model->data['order_id']],
            ['class' => 'btn bg-maroon btn-sm']
        ) ?>
    </div>
</div>