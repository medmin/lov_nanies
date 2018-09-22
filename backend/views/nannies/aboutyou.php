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
                    <?php $form = ActiveForm::begin(['action' =>['update?id='.$model->id.'&step=5']]); ?>   
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <ul class="process-label">
                                <a href="update?id=<?php echo $model->id; ?>&step=1"><li class="process-label2" id="label-1">Main </li></a>
                                <a href="update?id=<?php echo $model->id; ?>&step=2"><li class="process-label2" id="label-2">Questions & Schedule</li></a>
                                <a href="update?id=<?php echo $model->id; ?>&step=3"><li class="process-label2" id="label-3">Education & Driving</li></a>
                                <a href="update?id=<?php echo $model->id; ?>&step=4"><li class="process-label2" id="label-4">Housekeeping</li></a>
                                <a href="update?id=<?php echo $model->id; ?>&step=5"><li class="process-label2 active" id="label-5">About you</li></a>
                                <br>
                                <a href="update?id=<?php echo $model->id; ?>&step=tag"><li class="process-label2" id="label-tag">Nanny Tag</li></a>
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
                                        <!-- <?//= $form->field($model, 'work_if_parent_smokes')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?> -->
                                        <?= $form->field($model, 'trawel_with_family')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <!-- <?//= $form->field($model, 'travel_restrictions')->textArea() ?> -->
                                        <?= $form->field($model, 'valid_passport')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'work_if_parent_at_home')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>

                                          
                                        </div>
                                        <div class="col-md-6">
                                        <!-- <?//= $form->field($model, 'child_of_your_own')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?> -->
                                        <?= $form->field($model, 'dog_cat_at_home')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'swim')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'uniform_dress_code')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                        <?= $form->field($model, 'miles_to_commute')->input(['type' => 'number']) ?>
                                        <?= $form->field($model, 'states_lived_in')->textArea() ?>
                                        <?= $form->field($model, 'crime')->textArea() ?>
                                        <!-- <?//= $form->field($model, 'extra_activities')->textArea() ?> -->
                                        <?= $form->field($model, 'type_of_family')->textArea() ?> 
                                        <!-- <?//= $form->field($model, 'short_term_goals')->textArea() ?>
                                        <?//= $form->field($model, 'why_qualified')->textArea() ?> -->
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
</section>
