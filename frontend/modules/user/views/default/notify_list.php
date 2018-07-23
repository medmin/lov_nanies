<?php

use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider */

$this->registerJs(
    '
    $(document).ready(function () {
        $("html, body").animate({scrollTop: $(".slide").height()+$(".navbar").height()},"slow");
    });
    ',
    View::POS_READY,
    'my-button-handler'
);

$this->title = Yii::t('frontend', 'Parent Notifications');
?>
<br>
<ul class="nav nav-tabs nav-justified message-nav">
    <?= Yii::$app->request->getQueryParam('role') === 'send' ? Html::tag('li', Html::a('Received', Url::to("message"))) : Html::tag('li', Html::a('Received', "javascript:void(0)"), ['class' => 'active'])?>
    <?= Yii::$app->request->getQueryParam('role') === 'send' ? Html::tag('li', Html::a('Sent', Url::to("javascript:void(0)")), ['class' => 'active']) : Html::tag('li', Html::a('Sent', Url::to(["message", 'role' => 'send'])))?>
</ul>
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
        $msg_created_at = date('Y-F-d H:i:s', $model->created_at);
        $receiver = \common\models\User::findById($model->receiver_id);
        $url = \yii\helpers\Url::to(['/user/default/notify', 'id' => $model->id]);
        if (Yii::$app->request->getQueryParam('role') === 'send') {
            $url = \yii\helpers\Url::to(['/user/default/notify', 'id' => $model->id, 'role' => 'send']);
            $content = \yii\helpers\StringHelper::truncate($model->content, 350, Html::a(' . . .', $url, ['title' => 'Full Message']), null, true);
            return <<<HTML
<div class="panel panel-default">
    <div class="panel-heading">
        <p style="padding: 0 0 5px 0">Subject: <a href="{$url}">$model->subject</a></p>
        <p style="padding: 0 0 5px 0">Recipient: {$receiver->username} </p>
        <p style="padding: 0">Time: {$msg_created_at} </p>
    </div>
    <div class="panel-body">
        $content
        <div class="notify-reply">
            <a href="{$url}"><button type="button" class="btn theme-btn pull-right">Full Message</button></a>
        </div>
    </div>
</div>
HTML;
        } else {
            $sender = \common\models\User::findById($model->sender_id);
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
            <a href="{$url}#reply"><button type="button" class="btn theme-btn pull-right">Reply</button></a>
        </div>
    </div>
</div>
HTML;
        }
    }
])?>


