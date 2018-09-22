<?php

use common\grid\EnumColumn;
use common\models\Families;
use common\models\User;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\FamilySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Families';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs('
$(".user-discount").click(function() {
  var username = "Set A Special Post-Discount For " + $(this).data("username");
  var userid = $(this).data("id");
  $("#discountModalLabel").html(username);
  $("#userDiscountModel .modal-body > input[name=user_id]").val(userid);
  $("#userDiscountModel").modal("show");
})
$("#discount-submit").click(function() {
  var user_id = $("#userDiscountModel .modal-body > input[name=user_id]").val();
  var off = $("#userDiscountModel .modal-body > input[name=discount]").val();
  var expired_at = $("#userDiscountModel .modal-body input[name=expired_at]").val();

  if (!expired_at){
      alert("Please Set the expiration date!");
  }
  else{
        $.post("/discount/add?type='.\common\models\UserDiscount::TYPE_FAMILY_POST.'", {user_id: user_id, off : off, expired_at : expired_at}, function(data) {
            if (data) {
            $("#userDiscountModel").modal("hide");
            }
        })
    }
})
$("#userDiscountModel").on("hidden.bs.modal", function(e) {
  $("#userDiscountModel .modal-body > input[name=discount]").val("");
  $("#userDiscountModel .modal-body input[name=expired_at]").val("");
  console.log("model hidden")
})
', \yii\web\View::POS_END)
?>
<div class="families-index">



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'options'      => [
            'class' => 'grid-view table-responsive',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'content'=> function ($data) {
                    return User::findById($data->id) ? User::findById($data->id)->email : '';
                },
                'attribute' => 'email',
            ],

//            [
//                'class' => EnumColumn::className(),
//                'attribute' => 'status',
//                'enum' => Families::statuses(),
//                'filter' => Families::statuses()
//            ],
            'name:ntext',
            'address:ntext',
            'phone:ntext',
            // 'children:ntext',
            // 'type_of_help:ntext',
            // 'work_out_of_home:ntext',
            // 'special_needs:ntext',
            // 'driving:ntext',
            // 'when_start:ntext',
            // 'how_heared_about_us:ntext',

            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {discount}',
                'buttons'  => [
                    'discount' => function ($url, $model) {
                        return Html::tag('span', '', ['style' => 'color: #3c8dbc; cursor: pointer', 'class' => 'glyphicon glyphicon-tag user-discount', 'title' => Yii::t('app', 'Set Discount'), 'data-username' => $model->name, ' data-id' => $model->id]);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
<div class="modal fade" id="userDiscountModel" tabindex="-1" role="dialog" aria-labelledby="discountModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="discountModalLabel">Set Post-Discount</h4>
            </div>
            <div class="modal-body">
                <input type="number" min="0" max="100" name="discount" title="discount" placeholder="how many percentage off ? " class="form-control" style="margin-bottom: 15px;">
                <?= \kartik\datetime\DateTimePicker::widget([
                    'name' => 'expired_at',
//                    'value' => date('Y-m-d H:i:s', strtotime('+1 day')),
                    'options' => [
                        'placeholder' => 'select expired_at',
                    ],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format'    => 'yyyy-mm-dd hh:ii:ss',
                    ],
                ]) ?>
                <input type="hidden" name="user_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="discount-submit">Save changes</button>
            </div>
        </div>
    </div>
</div>