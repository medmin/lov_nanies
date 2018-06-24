<?php
/**
 * User: xczizz
 * Date: 2018/6/16
 * Time: 23:49
 */

use yii\helpers\Html;
use common\models\Nannies;
use yii\helpers\Url;
use yii\helpers\StringHelper;

/* @var $model \common\models\ParentPost */
?>
<div class="job-item clearfix <?= $model->expired_at < time() ? 'job-disabled' : '' ?>">
    <h1 class="job-summary"><a href="<?= Url::to(['find-a-job/detail', 'id' => $model->id]) ?>"><?= Html::encode($model->summary) ?></a></h1>
    <aside class="job-schedule pull-right">
        <p class="job-type"><?= Nannies::jobType()[$model->job_type]; ?></p>
        <p class="job-type-of-help"><?= Nannies::typeOfHelp()[$model->type_of_help]; ?></p>
    </aside>
    <div class="clear-left"></div>
    <div class="job-data-group">
        <div class="job-date">
            Posted by <?= Html::encode(Yii::$app->user->identity->username) ?> on <?= date('n/j/Y', $model->created_at)?>
        </div>
        <div class="job-description">
            <?= StringHelper::truncate($model->description, 200, '...') ?>
        </div>
    </div>
    <?php if ($model->user_id == Yii::$app->user->id) : ?>
    <div class="job-show-detail clearfix">
        <form action="<?= Url::to(['find-a-job/update']) ?>" method="post">
            <?= Html::hiddenInput('_csrf', Yii::$app->request->csrfToken)?>
            <?= Html::hiddenInput('id', $model->id)?>
            <?=  $model->expired_at > time() ? Html::submitButton('Update') : Html::button('Expire', ['disabled' => 'disabled', 'class' => 'btn'])?>
        </form>
    </div>
    <div class="job-show-detail clearfix">
        <form action="<?= Url::to(['find-a-job/delete']) ?>" method="post">
            <?= Html::hiddenInput('_csrf', Yii::$app->request->csrfToken)?>
            <?= Html::hiddenInput('id', $model->id)?>
            <?= Html::submitButton('Delete', ['onclick' => 'return confirm("Are you sure delete?")', 'class' => 'job-delete-btn']) ?>
        </form>
    </div>
    <?php else: ?>
        <div class="job-show-detail clearfix">
            <a href=<?= Url::to(['find-a-job/detail', 'id' => $model->id]) ?>>See Job Details</a>
        </div>
    <?php endif; ?>
</div>
