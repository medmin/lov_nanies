<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
// use trntv\filekit\widget\Upload;
use kartik\file\FileInput;
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

                                <li class="active">
                                    <a href="#step1" id="step-1">Step 1</a>
                                </li>

                                <li>
                                    <a href="#step2" id="step-2">Step 2</a>

                                </li>

                                <li>
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
                                <li class="process-label2 active" id="label-1">Main <span><i class="fa fa-long-arrow-right"></i></span></li>
                                <li class="process-label2" id="label-2">Questions & Schedule<span><i class="fa fa-long-arrow-right"></i></span></li>
                                <li class="process-label2" id="label-3">Education & Driving <span><i class="fa fa-long-arrow-right"></i></span></li>
                                <li class="process-label2" id="label-4">Housekeeping<span><i class="fa fa-long-arrow-right"></i></span></li>
                                <li class="process-label2" id="label-5">About you<span><i class="fa fa-long-arrow-right"></i></span></li>
                            </ul>
                        </div>

                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class=""></i> Main</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <?= $form->field($model, 'picture')
                                            ->widget(FileInput::classname(), [
                                                    'options' => ['accept' => 'image/*'],
                                                ])->label('Upload your image')?>
                                            <?= $form->field($model, 'name')->textInput(['required'=>'required']) ?>
                                            <?= $form->field($model, 'biography')->textArea(['rows' => '6']) ?>
                                            <?= $form->field($model, 'address')->textInput(['required'=>'required']) ?>
                                            <?= $form->field($model, 'zip_code')->textInput(['required'=>'required','type' => 'number']) ?>
                                            <?= $form->field($model, 'phone_home')->textInput(['required'=>'required']) ?>
                                            <?= $form->field($model, 'phone_cell')->textInput() ?>
                                            <?= $form->field($model, 'email')->textInput(['required'=>'required']) ?>
                                            <?= $form->field($model, 'aviliable_for_interview')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>     
                                            <?= $form->field($model, 'over_18')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>     
                                            <?= $form->field($model, 'date_of_birth')->textInput() ?>
                                            <?= $form->field($model, 'eligible_to_work')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>             
                                            <?= $form->field($model, 'have_work_visa')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?> 
                                            <?= $form->field($model, 'personal_comments')->textArea() ?>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <?= $form->field($model, 'position_for')->checkboxList(
                                                [
                                                    '1' => 'Part Time Nanny',
                                                    '2' => 'Full Time Nanny',
                                                    '3' => 'Live-in Nanny',
                                                    '4' => 'Babysitter',
                                                    '5' => 'Newborn Specialist',
                                                    '6' => 'Caregiver',
                                                    '7' => 'Housekeeper',
                                                    '8' => 'Special Needs Nanny',
                                                    '9' => 'Elderly Care',
                                                ]
                                            )?>    
                                            <?= $form->field($model, 'employed')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                            <?= $form->field($model, 'may_contact_employer')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?> 
                                            <?= $form->field($model, 'when_can_start')->textInput() ?>
                                            <?= $form->field($model, 'hours_per_week')->input(['type' => 'number']) ?>
                                            <?= $form->field($model, 'hourly_rate')->textInput() ?>
                                            <?= $form->field($model, 'weekly_salary')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                            <?= $form->field($model, 'wage_comment')->textArea() ?>  
                                            <?= $form->field($model, 'availability')->checkboxList([
                                                    '0' => 'Full time live in',
                                                    '1' => 'Full time live out',
                                                    '2' => 'Part time live out',
                                                    '3' => 'Part time live in',
                                                    '4' => 'Part Time Nanny',
                                                    '5' => 'Babysitting',
                                                    '6' => 'Evenings',
                                                    '7' => 'Weekends Only',
                                                    '8' => 'Overnights',
                                                    '9' => 'I`m flexible',
                                                ], ['required' => 'required'])?> 
                                           
                                            <input type="hidden" name="step" value="1"/>    
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
