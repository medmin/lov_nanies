<?php

use yii\web\View;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider */

$this->registerJs(
    '
    $(document).ready(function () {
        $("html, body").animate({scrollTop: $(".slide").height()+$(".navbar").height()},"slow");
        console.log($("slide").height());
            });
    ',
    View::POS_READY,
    'my-button-handler'
);

$this->title = Yii::t('frontend', 'Parent Notifications');
?>
<br>
<?= \yii\widgets\ListView::widget([
    'dataProvider'=>$dataProvider,
    'pager'=>[
        'hideOnSinglePage'=>true,
        'prevPageLabel'=>'Prev',
        'nextPageLabel'=>'Next',
        'options'=>[
            'class'=>'pagination',
        ],
    ],
    'options'=>[
        'class'=>'user-notify fade active in',
    ],
    'itemOptions' => [
        'tag' => false
    ],
    'summary'=>'',
    'itemView'=> function ($model, $key, $index, $widget) {
        $sender = \common\models\User::findById($model->sender_id);
        $msg_created_at = date('Y-F-d H:i:s', $model->created_at);
        $url = \yii\helpers\Url::to(['/user/default/notify', 'id' => $model->id]);
        $content = \yii\helpers\StringHelper::truncate($model->content, 10, Html::a(' . . .', $url, ['title' => 'Full Message']), null, true);
        return <<<HTML
<div class="panel panel-default">
    <div class="panel-heading">
        <p style="padding: 0 0 5px 0">Subject: <a href="{$url}">$model->subject</a></p>
        <p style="padding: 0 0 5px 0">Sender: {$sender->username} </p>
        <p style="padding: 0">Time: {$msg_created_at} </p>
    </div>
    <div class="panel-body">
        $content
        <div class="notify-reply">
            <a href="{$url}"><button type="button" class="btn theme-btn pull-right">Reply</button></a>
        </div>
    </div>
</div>
HTML;

    }
])?>


