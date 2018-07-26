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

// 通过 url 参数来判断展示什么
$params_role = Yii::$app->request->getQueryParam('role', 'received');
$params_group_bool = (boolean)Yii::$app->request->getQueryParam('group_id');
?>
<br>
<ul class="nav nav-tabs nav-justified message-nav">
    <li class="<?= $params_role == "received" ? 'active' : '' ?>">
        <a href="<?= $params_role == "received" ? 'javascript:void(0)' : Url::to(['/user/default/notify', 'role' => 'received'])?>">Received</a>
    </li>
    <li class="<?= $params_role == "grouped_by_senders" ? 'active' : '' ?>">
        <a href="<?= $params_role == "grouped_by_senders" ? 'javascript:void(0)' : Url::to(['/user/default/notify', 'role' => 'grouped_by_senders'])?>">Grouped By Senders</a>
    </li>
    <li class="<?= $params_role == "sent" ? 'active' : '' ?>">
        <a href="<?= $params_role == "sent" ? 'javascript:void(0)' : Url::to(['/user/default/notify', 'role' => 'sent'])?>">Sent</a>
    </li>
    <li class="<?= $params_role == "all" ? 'active' : '' ?>">
        <a href="<?= $params_role == "all" ? 'javascript:void(0)' : Url::to(['/user/default/notify' , 'role' => 'all'])?>">All messages</a>
    </li>
    <li class="<?= $params_role == "grouped_by_receivers" ? 'active' : '' ?>">
        <a href="<?= $params_role == "grouped_by_receivers" ? 'javascript:void(0)' : Url::to(['/user/default/notify' , 'role' => 'grouped_by_receivers'])?>">Grouped By Receivers</a>
    </li>
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
    'itemView'=> function ($model, $key, $index, $widget) use ($params_role, $params_group_bool) {
        if ($params_role == 'grouped_by_receivers' && !$params_group_bool) {
            $url = Url::to(['/user/default/notify', 'role' => $params_role, 'group_id' => $model['receiver_id']]);
            return <<<HTML
<a href="{$url}" class="list-group-item">
    {$model['username']}
    <span class="badge pull-right theme-bg-color">{$model['count']}</span>
</a>
HTML;
        }
        if ($params_role == 'grouped_by_senders' && !$params_group_bool) {
            $url = Url::to(['/user/default/notify', 'role' => $params_role, 'group_id' => $model['sender_id']]);
            return <<<HTML
<a href="{$url}" class="list-group-item">
    {$model['username']}
    <span class="badge pull-right theme-bg-color">{$model['count']}</span>
</a>
HTML;
        }
        if ($params_role == "sent" || ($params_role == 'grouped_by_receivers' && $params_group_bool)) {
            $msg_created_at = date('Y-F-d H:i:s', $model->created_at);
            $receiver = \common\models\User::findById($model->receiver_id);
            $url = Url::to(['/user/default/notify', 'role' => $params_role, 'id' => $model->id]);
            $user_link = array_key_exists('nanny', Yii::$app->authManager->getRolesByUser($receiver->id)) ? Html::a($receiver->username, Url::to(['/nannies/view', 'id' => $receiver->id]), ['class' => 'theme-a']) : $receiver->username;
            $content = \yii\helpers\StringHelper::truncate($model->content, 350, Html::a(' . . .', $url, ['title' => 'Full Message']), null, true);
            return <<<HTML
<div class="panel panel-default">
    <div class="panel-heading">
        <p style="padding: 0 0 5px 0">Subject: <a href="{$url}">$model->subject</a></p>
        <p style="padding: 0 0 5px 0">Recipient: {$user_link} </p>
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
        }
        if ($params_role == 'all') {
            $msg_created_at = date('Y-F-d H:i:s', $model->created_at);
            $user = \common\models\User::findById(Yii::$app->user->id == $model->sender_id ? $model->receiver_id : $model->sender_id);
            $user_des = Yii::$app->user->id == $model->sender_id ? 'Recipient' : 'Sender';
            $user_link = array_key_exists('nanny', Yii::$app->authManager->getRolesByUser($user->id)) ? Html::a($user->username, Url::to(['/nannies/view', 'id' => $user->id]), ['class' => 'theme-a']) : $user->username;
            $url = Url::to(['/user/default/notify', 'role' => $params_role, 'id' => $model->id]);
            $reply_url = $url . (Yii::$app->user->id == $model->sender_id ? '' : '#reply');
            $reply_text = Yii::$app->user->id == $model->sender_id ? 'Full Message' : 'Reply';
            $content = \yii\helpers\StringHelper::truncate($model->content, 350, Html::a(' . . .', $url, ['title' => 'Full Message']), null, true);
            return <<<HTML
<div class="panel panel-default">
    <div class="panel-heading">
        <p style="padding: 0 0 5px 0">Subject: <a href="{$url}">$model->subject</a></p>
        <p style="padding: 0 0 5px 0">{$user_des}: {$user_link} </p>
        <p style="padding: 0">Time: {$msg_created_at} </p>
    </div>
    <div class="panel-body">
        $content
        <div class="notify-reply">
            <a href="{$reply_url}"><button type="button" class="btn theme-btn pull-right">{$reply_text}</button></a>
        </div>
    </div>
</div>
HTML;
        }
        if ($params_role == 'received' || ($params_role == 'grouped_by_senders' && $params_group_bool)) {
            $msg_created_at = date('Y-F-d H:i:s', $model->created_at);
            $sender = \common\models\User::findById($model->sender_id);
            $user_link = array_key_exists('nanny', Yii::$app->authManager->getRolesByUser($model->sender_id)) ? Html::a($sender->username, Url::to(['/nannies/view', 'id' => $model->sender_id]), ['class' => 'theme-a']) : $sender->username;
            $url = Url::to(['/user/default/notify', 'role' => $params_role, 'id' => $model->id]);
            $content = \yii\helpers\StringHelper::truncate($model->content, 10, Html::a(' . . .', $url, ['title' => 'Full Message']), null, true);
            return <<<HTML
<div class="panel panel-default">
    <div class="panel-heading">
        <p style="padding: 0 0 5px 0">Subject: <a href="{$url}">$model->subject</a></p>
        <p style="padding: 0 0 5px 0">Sender: {$user_link} </p>
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


