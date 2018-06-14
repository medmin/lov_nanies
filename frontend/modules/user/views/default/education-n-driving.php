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
                                <a href="education-n-driving"><li class="process-label2 active" id="label-3">Education & Driving <span><i class="fa fa-long-arrow-right"></i></span></li></a>
                                <a href="housekeeping"><li class="process-label2" id="label-4">Housekeeping<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                                <a href="about-you"><li class="process-label2" id="label-5">About you<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                                <a href="upload-files"><li class="process-label2" id="label-6">Upload Files<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                            </ul>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class=""></i> Education & Driving</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-6">

                                        <?= $form->field($model, 'level_of_school')->textInput() ?>
                                        <?= $form->field($model, 'name_of_school')->textInput() ?>
                                        <?= $form->field($model, 'college')->textInput() ?>
                                        <?= $form->field($model, 'college_location')->textInput() ?>
                                        <?= $form->field($model, 'subjects_studied')->textInput() ?>
                                        <?= $form->field($model, 'spec_training')->textArea() ?>
                                        <?= $form->field($model, 'certificates')->textArea() ?>                                        
                                                
                                         
                                        </div>
                                        <div class="col-md-6">
                                        <?= $form->field($model, 'drive')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'have_car')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'car_model_year')->textInput() ?>
                                        <?= $form->field($model, 'state_licence')->textInput() ?>
                                        <?= $form->field($model, 'car_insurance')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'company_car_insurance')->textInput() ?>
                                        <?= $form->field($model, 'traffic_citations')->textInput() ?>
                                        <?= $form->field($model, 'valid_licence')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'use_car_for_work')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'traffic_citations_last5_yrs')->textArea() ?> 
                                        <input type="hidden" name="step" value="3"/>    
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
