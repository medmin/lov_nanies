<?php
/**
 * User: xczizz
 * Date: 2018/6/16
 * Time: 23:10
 */

use common\models\Nannies;
use yii\helpers\Html;
use common\models\UserOrder;

/* @var $this yii\web\View */
/* @var $model \common\models\ParentPost */

$this->title = Html::encode($model->summary);
$this->registerJs(
    '
    $(document).ready(function () {
        $("html, body").animate({scrollTop: $(".slide").height()+$(".navbar").height()},"slow");
     });
    '
);
?>
<div class="job-detail">
    <div class="media">
        <div class="media-left">
                <p class="job-type"><?= Nannies::jobType()[$model->job_type]; ?></p>
                <p class="job-type-of-help"><?= Nannies::typeOfHelp()[$model->type_of_help]; ?></p>
        </div>
        <div class="media-body">
            <h4 class="media-heading"><?= $model->summary?></h4>
            <div class="job-date">
                Posted by <?= Html::encode($model->user->username) ?> on <?= date('n/j/Y', $model->created_at)?>
                <?php if (!Yii::$app->user->isGuest && UserOrder::NannyListingFeeStatus(Yii::$app->user->id)) : ?>
                <span class="job-user-email" style="color:#2f628f;">Email: <?= Yii::$app->user->identity->email?></span>
                <?php endif; ?>
            </div>
            <div class="job-detail-container">
                <?= Html::decode($model->description) ?>
            </div>
        </div>
    </div>
</div>
