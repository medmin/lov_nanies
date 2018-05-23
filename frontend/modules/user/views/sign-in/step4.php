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
                   <!--TAB MENU LINKS-->
                        <div class="tab-div" id="processtabs">
                            <ul class="nav nav-pills" id="payment-ul">

                                <li>
                                    <a href="#step1" id="step-1">Step 1</a>
                                </li>

                                <li>
                                    <a href="#step2" id="step-2">Step 2</a>

                                </li>

                                <li>
                                    <a href="#step3" id="step-3">Step 3 </a>

                                </li>

                                <li class="active">
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
                                <li class="process-label2" id="label-3">Education & Driving <span><i class="fa fa-long-arrow-right"></i></span></li>
                                <li class="process-label2 active" id="label-4">Housekeeping<span><i class="fa fa-long-arrow-right"></i></span></li>
                                <li class="process-label2" id="label-5">About you<span><i class="fa fa-long-arrow-right"></i></span></li>
                            </ul>
                        </div>

                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class=""></i> Housekeeping (skip if you are not a housekeeper)</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-6">

                                        <?= $form->field($model, 'houskeep_years_exp')->textInput() ?>
                                        <?= $form->field($model, 'largest_house')->textInput() ?>
                                        <?= $form->field($model, 'laundry_and_ironing')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'best_describes_housekeeping')->checkboxList([
                                                        '1' => 'Extremely Thorough',
                                                        '2' => 'Neat & Orderly',
                                                        '3' => 'It`s Good, Not Great'
                                                        
                                                    ], ['required' => 'required'])?>
                                        <?= $form->field($model, 'housekeep_communication_skills')->input(['type' => 'number']) ?>
                                        <?= $form->field($model, 'housekeep_organization_skills')->input(['type' => 'number']) ?>
                                        
                                        </div>
                                        <div class="col-md-6">
                                        <?= $form->field($model, 'personal_style_of_service')->radioList([
                                                        '1' => 'Professional',
                                                        '2' => 'Laid Back but professional',
                                                        '3' => 'Part of Family'
                                                ])?>
                                        <?= $form->field($model, 'private_household')->textInput() ?>
                                        <?= $form->field($model, 'work_at_home_with_child')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'help_with_childcare')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'not_willing_housework')->textArea() ?>     
                                        <input type="hidden" name="step" value="2"/>    
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
