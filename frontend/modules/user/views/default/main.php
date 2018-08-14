<?php
use yii\helpers\Html;
use trntv\filekit\widget\Upload;
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
                    <?php $form = ActiveForm::begin(['action' =>['main'],'options' => ['enctype' => 'multipart/form-data']]); ?>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <ul class="process-label">
                                <a href="main"><li class="process-label2 active" id="label-1">Main <span><i class="fa fa-long-arrow-right"></i></span></li></a>
                                <a href="questions-n-schedule"><li class="process-label2" id="label-2">Questions & Schedule<span><i class="fa fa-long-arrow-right"></i></span></li></a>
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
                                        <h3 class="panel-title"><i class=""></i> Main</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <?= $form->field($model, 'picture')->widget(Upload::classname(), [
                                                'url'=>['avatar-upload']
                                            ])->label('Upload your image')?>
                                            <?= $form->field($model, 'address')->textInput(['required'=>'required']) ?>
                                            <?= $form->field($model, 'zip_code')->textInput(['required'=>'required']) ?>
                                            <?= $form->field($model, 'phone_home')->textInput(['required'=>'required']) ?>
                                            <?= $form->field($model, 'phone_cell')->textInput() ?>
                                            <?= $form->field($model, 'email')->textInput(['required'=>'required']) ?>
                                            <?//= $form->field($model, 'aviliable_for_interview')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                            <?= $form->field($model, 'over_18')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>     
                                            <?= $form->field($model, 'date_of_birth')->textInput() ?>
                                            <?//= $form->field($model, 'have_work_visa')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                            <?//= $form->field($model, 'personal_comments')->textArea() ?>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <?= $form->field($model, 'position_for')->checkboxList([
                                                '1' => 'Nanny',
                                                '2' => 'Babysitter',
                                                '3' => 'Newborn Specialist',
                                                '4' => 'Special Needs',
                                                '5' => 'Caregiver',
                                                '6' => 'Housekeeper',
                                            ], ['required' => 'required'])?>
                                            <?= $form->field($model, 'employed')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                            <?//= $form->field($model, 'may_contact_employer')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                            <?= $form->field($model, 'when_can_start')->textInput() ?>
                                            <?//= $form->field($model, 'hours_per_week')->input(['type' => 'number']) ?>
                                            <?= $form->field($model, 'hourly_rate')->textInput() ?>
                                            <?//= $form->field($model, 'weekly_salary')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                            <?//= $form->field($model, 'wage_comment')->textArea() ?>
                                            <?= $form->field($model, 'availability')->checkboxList([
                                                '1' => 'Full time',
                                                '2' => 'Part time',
                                                '3' => 'Live in',
                                                '4' => 'Babysitter',
                                                '5' => 'Temporary',
                                                '6' => 'Overnight care',
                                                ], ['required' => 'required'])?>
                                            <?= $form->field($model, 'eligible_to_work')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>

                                            <input type="hidden" name="step" value="1"/>    
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
