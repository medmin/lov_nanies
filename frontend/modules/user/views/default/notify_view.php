<?php
use yii\web\View;

/* @var $model \common\models\UserNotify */

$this->registerJs(
    '
    $(document).ready(function () {
        $("html, body").animate({scrollTop: $(".slide").height()+$(".navbar").height()},"slow");
        console.log($("slide").height());
            });
     
     $("#sendMessage").click(function() {
       var subject = $("input[name=subject]").val()
       var content = $("textarea[name=content]").val()
       var post_id = '.$model->job_post_id.'
       var pid = '.$model->id.'
       if (subject.trim() == "" || content.trim() == "") {
         return false;
       } else {
         $.post("/find-a-job/contact", {subject:subject,content:content,post_id:post_id,pid:pid}, function(data){
           if (data.status) {
               location.reload()
           } else {
             console.log(data.message)
           }
         }, "json")
       }
     })
     
    ',
    View::POS_READY,
    'my-button-handler'
);
?>
<br>
<div class="panel panel-success user-notify">
    <div class="panel-heading">
        Subject: <?= $model->subject ?> 
    </div>
    <div class="panel-body">
        <?= \yii\helpers\Html::encode($model->content)?>
        <div class="notify-reply">

        </div>
    </div>
</div>

<div class="panel panel-default show job-contact-panel">
    <div class="panel-heading">
        Reply a message to the nanny: <?= \common\Models\User::findById($model->sender_id)->username ?> <br>
        Attention:<br>
        The nanny will get an email to notify her/him that you have sent a message.<br>
        If you send spam messages, your account will be suspended.
    </div>
    <div class="panel-body">
        <div class="form-group">
            <label for="messageSubject">Subject</label>
            <input type="text" class="form-control" name="subject" id="messageSubject" placeholder="subject" maxlength="1000">
        </div>
        <div class="form-group">
            <label for="messageText">Content</label>
            <textarea name="content" class="form-control" id="messageText" rows="10"></textarea>
        </div>
        <button type="button" class="btn theme-btn" id="sendMessage">Send</button>
    </div>
</div>
