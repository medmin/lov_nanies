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
<div class="job-item clearfix">
    <h1 class="job-summary"><a href="<?= Url::to(['post-job/view', 'id' => $model->id]) ?>"><?= Html::encode($model->summary) ?></a></h1>
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
    <div class="job-show-detail clearfix">
        <?php if ($model->user_id == Yii::$app->user->id) : ?>
            <form action="<?= Url::to(['post-job/update']) ?>" method="post">
                <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                <?= Html::hiddenInput('_csrf', Yii::$app->request->csrfToken)?>
                <?= Html::hiddenInput('id', $model->id)?>
                <button type="submit" >Update</button>
            </form>
        <?php else: ?>
            <a href=<?= Url::to(['post-job/view', 'id' => $model->id]) ?>>See Job Details</a>
        <?php endif; ?>
    </div>
</div>
