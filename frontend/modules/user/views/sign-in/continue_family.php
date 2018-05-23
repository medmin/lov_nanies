<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\SignupForm */

$this->title = Yii::t('frontend', 'Signup');
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
                <?php echo $form->field($model, 'name') ?>
                <?php echo $form->field($model, 'address')->textarea(['rows' => 2])  ?>
                <?php echo $form->field($model, 'phone') ?>
                <?php echo $form->field($model, 'children')->textarea(['rows' => 2])  ?>
                <?php echo $form->field($model, 'type_of_help')->textarea(['rows' => 2])  ?>
               
            
            </div>
            <div class="col-lg-6">
                <?php echo $form->field($model, 'work_out_of_home') ?>
                <?php echo $form->field($model, 'special_needs')->textarea(['rows' => 2])  ?>
                <?php echo $form->field($model, 'driving') ?>
                <?php echo $form->field($model, 'when_start') ?>
                <?php echo $form->field($model, 'how_heared_about_us')->textarea(['rows' => 2])  ?>
            </div>
            
        
        </div>
        <div class="form-group" style="text-align: center;">
            <?php echo Html::submitButton(Yii::t('frontend', 'Save'), ['class' => 'btn btn-inverse', 'name' => 'signup-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
