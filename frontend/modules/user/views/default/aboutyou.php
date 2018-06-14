<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\SignupForm */
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
$this->title = Yii::t('frontend', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="signup-process" style="margin-top:20px;">
        <div class="container">
                <div class="col-lg-12">
                    <!-- >>forms -->
                    <?php $form = ActiveForm::begin(); ?>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <ul class="process-label">
                                <a href="main"><li class="process-label2" id="label-1">Main <span><i class="fa fa-long-arrow-right"></i></span></li></a>
                                <a href="questions-n-schedule"><li class="process-label2" id="label-2">Questions & Schedule<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                                <a href="education-n-driving"><li class="process-label2" id="label-3">Education & Driving <span><i class="fa fa-long-arrow-right"></i></span></li></a>
                                <a href="housekeeping"><li class="process-label2" id="label-4">Housekeeping<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                                <a href="about-you"><li class="process-label2 active" id="label-5">About you<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                                <a href="upload-files"><li class="process-label2" id="label-6">Upload Files<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                            </ul>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class=""></i> About you</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                        <?= $form->field($model, 'crp_certified')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'first_aid_certified')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'need_crp_fa_renew')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'tb_test')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'pet_allergies')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'smoking')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'work_if_parent_smokes')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'trawel_with_family')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'travel_restrictions')->textArea() ?>
                                        <?= $form->field($model, 'states_lived_in')->textArea() ?> 
                                        <?= $form->field($model, 'valid_passport')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'work_if_parent_at_home')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'miles_to_commute')->input(['type' => 'number']) ?>
                                          
                                        </div>
                                        <div class="col-md-6">
                                        <?= $form->field($model, 'child_of_your_own')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'dog_cat_at_home')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'swim')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'uniform_dress_code')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'crime')->textArea() ?> 
                                        <?= $form->field($model, 'extra_activities')->textArea() ?> 
                                        <?= $form->field($model, 'type_of_family')->textArea() ?> 
                                        <?= $form->field($model, 'short_term_goals')->textArea() ?> 
                                        <?= $form->field($model, 'why_qualified')->textArea() ?> 
                                        <?= $form->field($model, 'languages')->textArea() ?> 
                                       
                                        <input type="hidden" name="step" value="5"/>    
                                        </div>
                                        
                                    </div>
                                        <div class="form-group">
                                                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-inverse next-step' : 'btn btn-inverse next-step']) ?>
                                        </div>
                                </div>
                                
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                    <!-- #FORM ENDS -->
                </div>
        </div>
</section>
