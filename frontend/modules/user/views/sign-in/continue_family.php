<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\models\Families */

$this->title = Yii::t('frontend', 'Sign Up');
$this->params['breadcrumbs'][] = $this->title;
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
<div class="site-signup">
    <h1 style="color: #000; margin-top:10px;">Family Information</h1>
    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'address')  ?>
                <?= $form->field($model, 'phone') ?>
                <?= $form->field($model, 'children')  ?>
                <?= $form->field($model, 'type_of_help')->textInput(
                    [
                        'placeholder' => 'Full time ? Part time ? Live in or out ? Babysitter? Or else?'
                    ]
                )  ?>
               <?= $form->field($model, 'what_hours') ?>
               <?= $form->field($model, 'pay_rate')    ?>     
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'work_out_of_home') ?>
                <?= $form->field($model, 'special_needs')  ?>
                <?= $form->field($model, 'driving') ?>
                <?= $form->field($model, 'when_start') ?>
                <?= $form->field($model, 'how_heared_about_us')  ?>
                <?= $form->field($model, 'housekeeping_or_cooking') ?>
            </div>
            
        
        </div>
        <div class="form-group" style="text-align: center;">
            <?= Html::submitButton(Yii::t('frontend', 'Save'), ['class' => 'btn btn-inverse', 'name' => 'signup-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
