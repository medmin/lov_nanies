<?php

use common\grid\EnumColumn;
use common\models\UserProfile;
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Nannies');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs('
$(".user-discount").click(function() {
  var username = $(this).data("username")
  var userid = $(this).data("id")
  $("#discountModalLabel").html(username);
  $("#userDiscountModel .modal-body > input[name=user_id]").val(userid);
  $("#userDiscountModel").modal("show");
})
$("#discount-submit").click(function() {
  var user_id = $("#userDiscountModel .modal-body > input[name=user_id]").val();
  var discount = $("#userDiscountModel .modal-body > input[name=discount]").val();
  // console.log(user_id,discount);
  $.post("/discount/add", {user_id: user_id, discount: discount}, function(data) {
    if (data) {
      $("#userDiscountModel").modal("hide");
    }
  })
})
$("#userDiscountModel").on("hidden.bs.modal", function(e) {
  $("#userDiscountModel .modal-body > input[name=discount]").val("");
  console.log("model hidden")
})
', \yii\web\View::POS_END)
?>
<div class="user-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            'id',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->name, Yii::$app->urlManagerFrontend->createAbsoluteUrl('/nannies/view?id='.$model->id), ['target' => '_blank']);
                }
            ],
            'email:email',
            'address:text',
            [
                'class' => EnumColumn::className(),
                'attribute' => 'status',
                'enum' => UserProfile::statuses(),
                'filter' => UserProfile::statuses()
            ],
            /*'created_at:datetime',
            'logged_at:datetime',
            // 'updated_at',*/

            ['class' => 'yii\grid\ActionColumn',
             'buttons' => [
                'dereactivation' => function ($url, $model) {
                    return ($model->status==-1|| $model->status==-10) ? Html::a('<span class="glyphicon glyphicon-refresh"></span>', $url, [
                                'title' => Yii::t('app', 'Reactivate'),
                    ]) : "";
                    
                },
                 'approve' => function ($url, $model) {
                    return $model->status==0 ? Html::a('<span class="glyphicon glyphicon-check"></span>', $url, [
                                'title' => Yii::t('app', 'Approve'),
                    ]): "";
                },
                 'deactivate' => function ($url, $model) {
                    return $model->status==1 ? Html::a('<span class="glyphicon glyphicon-eye-close"></span>', $url, [
                                'title' => Yii::t('app', 'Deactivate'),
                    ]): "";
                },
                 'discount' => function ($url, $model) {
                    return Html::tag('span', '', ['style' => 'color: #3c8dbc; cursor: pointer', 'class' => 'glyphicon glyphicon-tag user-discount', 'title' => Yii::t('app', 'Set Discount'), 'data-username' => $model->name ,' data-id' => $model->id]);
                 }
            ],
             'template' => '{update} {approve} {dereactivation} {deactivate} {delete} {discount}'],
        ],
    ]); ?>

</div>

<div class="modal fade" id="userDiscountModel" tabindex="-1" role="dialog" aria-labelledby="discountModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="discountModalLabel">Set Discount</h4>
            </div>
            <div class="modal-body">
                <input type="number" name="discount" title="discount" placeholder="discount" class="form-control">
                <input type="hidden" name="user_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="discount-submit">Save changes</button>
            </div>
        </div>
    </div>
</div>

