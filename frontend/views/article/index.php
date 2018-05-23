<?php
/* @var $this yii\web\View */
use yii\web\View;
$this->title = Yii::t('frontend', 'Articles');
$this->registerJs(
    '
    $(document).ready(function () {
        $("html, body").animate({scrollTop: $(".slide").height()+$(".navbar").height()+100},"slow");
        console.log($("slide").height());
            });
    ',
    View::POS_READY,
    'my-button-handler'
);
?>
<section class="our-blog">
    <div class="row row-margin article">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <?php echo \yii\widgets\ListView::widget([
            'dataProvider'=>$dataProvider,
            'pager'=>[
                'hideOnSinglePage'=>true,
            ],
            'summary'=>'',
            'itemView'=>'_item'
        ])?>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    
    </div>
</section>