<?php
use trntv\filekit\widget\Upload;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\SignupForm */

$this->title = Yii::t('frontend', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="signup-process" style="margin-top:20px;">
                    <?php $form = ActiveForm::begin(['action' =>['update?id='.$model->id.'&step=1']]); ?>   
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
                                        <h3 class="panel-title"><i class=""></i> Main</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <?php echo $form->field($model, 'picture')->widget(
                                                Upload::classname(),
                                                [
                                                    'url' => ['avatar-upload'],
                                                ]
                                            )->label('Upload your image')?>
                                            <?= $form->field($model, 'name')->textInput(['required'=>'required']) ?>
                                            <?= $form->field($model, 'biography')->textArea() ?>
                                            <?= $form->field($model, 'address')->textInput(['required'=>'required']) ?>
                                            <?= $form->field($model, 'zip_code')->textInput(['required'=>'required']) ?>
                                            <?= $form->field($model, 'phone_home')->textInput(['required'=>'required']) ?>
                                            <?= $form->field($model, 'phone_cell')->textInput() ?>
                                            <?= $form->field($model, 'email')->textInput(['required'=>'required']) ?>
                                            <!-- <?//= $form->field($model, 'aviliable_for_interview')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?> -->
                                            <?= $form->field($model, 'over_18')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>     
                                            <?= $form->field($model, 'date_of_birth')->textInput() ?>
                                            <?= $form->field($model, 'eligible_to_work')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>             
                                            <!-- <?//= $form->field($model, 'have_work_visa')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                            <?//= $form->field($model, 'personal_comments')->textArea() ?> -->
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <?= $form->field($model, 'position_for')->checkboxList([
                                                '1' => 'Nanny',
                                                '2' => 'Babysitter',
                                                '3' => 'Newborn Specialist',
                                                '4' => 'Special Needs',
                                                '5' => 'Caregiver',
                                                '6' => 'Housekeeper',
                                            ])?>    
                                            <?= $form->field($model, 'employed')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                            <!-- <?//= $form->field($model, 'may_contact_employer')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?> -->
                                            <?= $form->field($model, 'when_can_start')->textInput() ?>
                                            <!-- <?//= $form->field($model, 'hours_per_week')->input(['type' => 'number']) ?> -->
                                            <?= $form->field($model, 'hourly_rate')->textInput() ?>
                                            <!-- <?//= $form->field($model, 'weekly_salary')->inline()->radioList(['1' => 'Yes', '0' => 'No'])?>
                                            <?//= $form->field($model, 'wage_comment')->textArea() ?> -->
                                            <?= $form->field($model, 'availability')->checkboxList([
                                                '1' => 'Full time',
                                                '2' => 'Part time',
                                                '3' => 'Live in',
                                                '4' => 'Babysitter',
                                                '5' => 'Temporary',
                                                '6' => 'Overnight care',
                                                ], ['required' => 'required'])?> 
                                           
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
                    <h2 style="color: #000;">References</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'email:ntext',
            'reference_name:ntext',
            'reference_address:ntext',
            'contact_number:ntext',
            // 'ref_contact_email:ntext',
            // 'how_do_you_know:ntext',
            // 'years_known:ntext',

            ['class' => 'yii\grid\ActionColumn',

              'template'  => '{view_ref} {update_ref}',
                'buttons' => [
                'view_ref' => function ($url, $model) {
                    return Html::a('<span class="fa fa-eye"></span> View', $url, [
                                'title' => Yii::t('app', 'View'),
                                'class' => 'btn btn-primary btn-xs',
                    ]);
                },
                'update_ref' => function ($url, $model) {
                    return Html::a('<span class="fa fa-edit"></span> Update', $url, [
                                'title' => Yii::t('app', 'View'),
                                'class' => 'btn btn-primary btn-xs',
                    ]);
                },
            ],
            ],
        ],
    ]); ?>
                    <!-- #FORM ENDS -->
</section>
