<?php
/**
 * User: xczizz
 * Date: 2018/6/16
 * Time: 23:10
 */

/* @var $this yii\web\View */
/* @var $model \common\models\ParentPost */

$this->registerJs(
    '
    $(document).ready(function () {
        $("html, body").animate({scrollTop: $(".slide").height()+$(".navbar").height()},"slow");
     });
    '
);
?>
<div class="job-detail">
    <?= $model->description; ?>
</div>
