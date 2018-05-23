<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\SignupForm */

$this->title = Yii::t('frontend', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>




<section class="signup-process">
        <div class="container">
            <div class="row row-margin">
                <div class="col-lg-12  ">
                    <!-- >>forms -->
                    <?php $form = ActiveForm::begin(['action' =>['sign-in/continue-registration']]); ?>
                        <?= $form->field($model, 'status')->textInput() ?>
                        <!--TAB MENU LINKS-->
                        <div class="tab-div" id="processtabs">
                            <ul class="nav nav-pills" id="payment-ul">

                                <li>
                                    <a href="#step1" id="step-1">Step 1</a>
                                </li>

                                <li>
                                    <a href="#step2" id="step-2">Step 2</a>

                                </li>

                                <li class="active">
                                    <a href="#step3" id="step-3">Step 3 </a>

                                </li>

                                <li>
                                    <a href="#step4" id="step-4">Step 4</a>

                                </li>

                                <li>
                                    <a href="#step5" id="step-5">Step 5</a>

                                </li>

                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <ul class="process-label">
                                <li class="process-label2" id="label-1">Main <span><i class="fa fa-long-arrow-right"></i></span></li>
                                <li class="process-label2" id="label-2">Questions & Schedule<span><i class="fa fa-long-arrow-right"></i></span></li>
                                <li class="process-label2 active" id="label-3">Education & Driving <span><i class="fa fa-long-arrow-right"></i></span></li>
                                <li class="process-label2" id="label-4">Housekeeping<span><i class="fa fa-long-arrow-right"></i></span></li>
                                <li class="process-label2" id="label-5">About you<span><i class="fa fa-long-arrow-right"></i></span></li>
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
                                                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Next', ['class' => $model->isNewRecord ? 'btn btn-inverse next-step' : 'btn btn-inverse next-step']) ?>
                                        </div>
                                </div>
                                
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                    <!-- #FORM ENDS -->
                </div>
            </div>
        </div>
</section>
