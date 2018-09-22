<?php
/** @var yii\web\View
 * @var $searchModel  backend\models\search\NannySearch
 * @var $error        string 如果有的话，就是抛出的异常
 * @var $dataProvider Object
 */
use yii\web\View;

if (isset($_GET['city'])) {
    $this->title = Yii::t('frontend', 'Nannies in '.$_GET['city']);
} else {
    $this->title = Yii::t('frontend', 'Nannies');
}
$this->registerJs(
    '
    $(document).ready(function () {
        $("html, body").animate({scrollTop: $(".slide").height()+$(".navbar").height()},"slow");
//        console.log($("slide").height());
            });
    ',
    View::POS_READY,
    'my-button-handler'
);
$js = <<<'JS'
  $(function() {
    $('#babysitters-tab .card').each(function() {
        let _this = $(this);
        $.get('/tag/default/user-tag', {user_id: _this.data('user-id')}, function(data){
           let str = '';
           $.each(data, function(index, item) {
             str += generateUserTagHtml(item.name, item.icon, item.info, item.id);
           });
           if (str.length > 0) {
             _this.find('.tags-list').html(str);
           }
        }, 'json');
    })
  });
  $("body").tooltip({
    selector: '[data-toggle="tooltip"]'
  });
  function generateUserTagHtml(name, icon, info, id) {
    return '<li title="'+ info +'" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-'+ icon +'"></i></li>'
  }
JS;
$this->registerJs($js, View::POS_END)
?>

<section class="our-blog">

    <div class="row">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <div class="row row-margin">
            <div class="tab-content tabpill-content">
            <div id="babysitters-tab" class="tab-pane fade active in">
            <?= $error !== '' ? $error : \yii\widgets\ListView::widget([
                'dataProvider'=> $dataProvider,
                'pager'       => [
                    'hideOnSinglePage'=> true,
                    'prevPageLabel'   => 'Prev',
                    'nextPageLabel'   => 'Next',
                    'options'         => [
                      'class'=> 'pagination',
                    ],
                ],
                'options'=> [
                    'class'=> 'tab-pane fade active in',
                ],
                'itemOptions' => [
                    'tag' => false,
                ],
                'summary' => '',
                'itemView'=> 'list_item',
            ])?>
            </div>
            </div>
        </div>
    </div>
    <?php require_once 'sidebar.php'; ?>
    </div>
</section>