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
     $("#job-contact").click(function() {
        $(".job-contact-panel").removeClass("hidden").addClass("show")
     })
     $("#sendMessage").click(function() {
       var subject = $("input[name=subject]").val()
       var content = $("textarea[name=content]").val()
       var post_id = '.$model->id.'
       if (subject.trim() == "" || content.trim() == "") {
         return false;
       } else {
         $.post("contact", {subject:subject,content:content,post_id:post_id}, function(data){
           if (data.status) {
               location.reload()
           } else {
             console.log(data.message)
           }
         }, "json")
       }
     })
    '
);
?>
<div class="job-detail">
    <div class="media">
        <div class="media-left">
            <p class="job-type"><?= Nannies::jobType()[$model->job_type]; ?></p>
            <p class="job-type-of-help"><?= Nannies::typeOfHelp()[$model->type_of_help]; ?></p>
<!--            <div class="job-contact">-->
<!--                <button type="button" class="btn theme-bg-color" id="job-contact">Contact</button>-->
<!--            </div>-->
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

<!--<div class="panel panel-default hidden job-contact-panel">-->
<!--    <div class="panel-heading">-->
<!--        Send message-->
<!--    </div>-->
<!--    <div class="panel-body">-->
<!--        <div class="form-group">-->
<!--            <label for="messageSubject">Subject</label>-->
<!--            <input type="text" class="form-control" name="subject" id="messageSubject" placeholder="subject" maxlength="1000">-->
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <label for="messageText">Content</label>-->
<!--            <textarea name="content" class="form-control" id="messageText" rows="10"></textarea>-->
<!--        </div>-->
<!--        <button type="button" class="btn theme-bg-color" id="sendMessage">Send</button>-->
<!--    </div>-->
<!--</div>-->
