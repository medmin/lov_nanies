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
        return <<<HTML
<div class="panel panel-default">
    <div class="panel-heading">
        Subject: <a href="notify?id={$model->id}">$model->subject (Click it to see the full message)</a><br>
        <!-- Sender:  \common\Models\User::findById($model->sender_id)->username  -->
    </div>
    <div class="panel-body">
        $model->content
        <!-- 这里加上一个判断，只显示前20个字符或50个字符，反正不能显示全部，否则家长不点击查看全文，自然就看不到“Reply”按钮 -->
    </div>
</div>
HTML;

    }
])?>


