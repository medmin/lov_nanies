<?php
/**
 * User: xczizz
 * Date: 2018/6/16
 * Time: 22:02
 */

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->registerJs(
    '
    $(document).ready(function () {
        $("html, body").animate({scrollTop: $(".slide").height()+$(".navbar").height()},"slow");
     });
    '
);
?>

<div class="job-list">
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
            'class'=>'tab-pane fade active in',
        ],
        'itemOptions' => [
            'tag' => false
        ],
        'summary'=>'',
        'itemView'=>'jobs_item'
    ])?>
</div>
