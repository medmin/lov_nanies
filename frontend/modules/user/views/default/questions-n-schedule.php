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
                    <?php $form = ActiveForm::begin(['action' =>['questions-n-schedule']]); ?>   
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <ul class="process-label">
                                <a href="main"><li class="process-label2" id="label-1">Main <span><i class="fa fa-long-arrow-right"></i></span></li></a>
                                <a href="questions-n-schedule"><li class="process-label2 active" id="label-2">Questions & Schedule<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                                <a href="education-n-driving"><li class="process-label2" id="label-3">Education & Driving <span><i class="fa fa-long-arrow-right"></i></span></li></a>
                                <a href="housekeeping"><li class="process-label2" id="label-4">Housekeeping<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                                <a href="about-you"><li class="process-label2" id="label-5">About you<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                                <a href="upload-files"><li class="process-label2" id="label-6">Upload Files<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                                <a href="upload-files-list"><li class="process-label2" id="label-7">Files List<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                                <a href="/user/default/index"><li class="process-label2" id="label-7">Back to my account<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                            </ul>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class=""></i> Questions & Schedule</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-6">

                                        <?= $form->field($model, 'childcare_exp')->textInput() ?>
                                        <?= $form->field($model, 'ages_to_work_with')->textInput() ?>
                                        <?= $form->field($model, 'most_exp_with')->textInput() ?>
                                        <?= $form->field($model, 'cared_of_twins')->textInput() ?>
                                        <?= $form->field($model, 'special_needs_exp')->textInput() ?>
                                        <?= $form->field($model, 'tutor')->textInput() ?>
                                        <?= $form->field($model, 'houskeeping')->checkboxList([
                                                        '0' => 'I will not do ANY housekeeping',
                                                        '1' => 'Clean main living areas',
                                                        '2' => 'Clean bathrooms',
                                                        '3' => 'Clean children`s rooms',
                                                        '4' => 'Vacuum',
                                                        '5' => 'Wipe down kitchen counters',
                                                        '6' => 'Clean dishes/put dishes away',
                                                        '7' => 'Mop floors',
                                                        '8' => 'I am fine with heavy cleaning',
                                                        '9' => 'I will only do light housekeeping',
                                                    ], ['required' => 'required'])?> 
                                        <?= $form->field($model, 'why_want_be_nanny')->textArea() ?>
                                        <?= $form->field($model, 'type_of_activities')->textArea() ?>
                                        <?= $form->field($model, 'characteristics_look_for')->textArea() ?>
                                        <?= $form->field($model, 'background_in_child_dev')->textArea() ?>
                                        <?= $form->field($model, 'number_of_children_care_for')->textArea() ?>
                                        <?= $form->field($model, 'sick_children')->textArea() ?>                                        
                                                
                                         
                                        </div>
                                        <div class="col-md-6">
                                        
                                        <?= $form->field($model, 'assist_homework')->textArea() ?>
                                        <?= $form->field($model, 'family_life')->textArea() ?>
                                        <?= $form->field($model, 'interests')->textArea() ?>
                                        <?= $form->field($model, 'philosophy')->textArea() ?>
                                        <?= $form->field($model, 'most_important')->textArea() ?>
                                        <?= $form->field($model, 'rate_communication_skills')->input(['type' => 'number']) ?>
                                        <h2 style="color: #565656;">Schedule</h2>If you are flexible on the hours for that day write `Flexible`. If you have specific hours write those in. For e.g. 8-5. 
                                        <?= $form->field($model, 'sun')->textInput() ?>
                                        <?= $form->field($model, 'mon')->textInput() ?>
                                        <?= $form->field($model, 'tue')->textInput() ?>
                                        <?= $form->field($model, 'wed')->textInput() ?>
                                        <?= $form->field($model, 'thu')->textInput() ?>
                                        <?= $form->field($model, 'fri')->textInput() ?>
                                        <?= $form->field($model, 'sat')->textInput() ?>
                                        <?= $form->field($model, 'schedule_comment')->textArea() ?> 
                                        <input type="hidden" name="step" value="2"/>    
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
