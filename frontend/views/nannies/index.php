<?php
/* @var $this yii\web\View */
use yii\web\View;

if (isset($_GET['city'])){
    $this->title = Yii::t('frontend', 'Nannies in '.$_GET['city']);
}else{
    $this->title = Yii::t('frontend', 'Nannies');
}
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
?>
<section class="our-blog">
    <div class="row">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <div class="row row-margin">
            <div class="tab-content tabpill-content">
            <div id="babysitters-tab" class="tab-pane fade active in">
            <?php echo \yii\widgets\ListView::widget([
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
                'itemView'=>'list_item'
            ])?>
            </div>
            </div>
        </div>
    </div>
    <?php require_once('sidebar.php');?>
    </div>
</section>