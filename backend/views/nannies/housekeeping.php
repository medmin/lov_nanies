<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\SignupForm */

$this->title = Yii::t('frontend', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="signup-process" style="margin-top:20px;">
                    <?php $form = ActiveForm::begin(['action' =>['update?id='.$model->id.'&step=4']]); ?>   
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <ul class="process-label">
                                <a href="update?id=<?php echo $model->id; ?>&step=1"><li class="process-label2" id="label-1">Main </li></a>
                                <a href="update?id=<?php echo $model->id; ?>&step=2"><li class="process-label2 active" id="label-2">Questions & Schedule</li></a>
                                <a href="update?id=<?php echo $model->id; ?>&step=3"><li class="process-label2" id="label-3">Education & Driving</li></a>
                                <a href="update?id=<?php echo $model->id; ?>&step=4"><li class="process-label2" id="label-4">Housekeeping</li></a>
                                <a href="update?id=<?php echo $model->id; ?>&step=5"><li class="process-label2" id="label-5">About you</li></a>
                                <br>
                                <a href="update?id=<?php echo $model->id; ?>&step=tag"><li class="process-label2" id="label-tag">Nanny Tag</li></a>
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
                                                        '3' => 'Brisk Clean',

                                                    ], ['required' => 'required'])?>
                                        <?= $form->field($model, 'housekeep_communication_skills')->input(['type' => 'number']) ?>
                                        <?= $form->field($model, 'housekeep_organization_skills')->input(['type' => 'number']) ?>
                                        
                                        </div>
                                        <div class="col-md-6">
                                        <?= $form->field($model, 'personal_style_of_service')->radioList([
                                                        '1' => 'Professional',
                                                        '2' => 'Laid Back but professional',
                                                        '3' => 'Part of Family',
                                                ])?>
                                        <?= $form->field($model, 'private_household')->textInput() ?>
                                        <?= $form->field($model, 'work_at_home_with_child')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'help_with_childcare')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'not_willing_housework')->textArea() ?>     
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
</section>
