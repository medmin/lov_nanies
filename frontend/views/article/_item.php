<?php
/**
 * @var yii\web\View
 * @var $model       common\models\Article
 */
use yii\helpers\Html;

?>
<hr/>
<div class="full-width-blog-post">
    <div class="blog-box">
        <h3 class="blog-title"><a href="/<?= $model->slug?>"><?php echo $model->title; ?></a></h3>
        <p class="blog-date"><?= date('j - F - Y', $model->created_at)?></p>

        <?php if ($model->thumbnail_path): ?>
            <div class="blog-img">
            <?= Html::a(Html::img(
                Yii::$app->glide->createSignedUrl([
                    'glide/index',
                    'path' => $model->thumbnail_path,
                ], true),
                ['class' => 'article-thumb img-rounded pull-left']
            ), ['view', 'slug'=>$model->slug]); ?>
            </div>
        <?php endif; ?>

        <?= \yii\helpers\StringHelper::truncate($model->body, 350, '...', null, true) ?>
        <ul>
            <li>
                <?php echo Html::a($model->title, ['view', 'slug'=>$model->slug], ['class'=>'btn btn-inverse btn-link', 'title' => $model->title]) ?>
            </li>  
        </ul>
    </div>
</div>
