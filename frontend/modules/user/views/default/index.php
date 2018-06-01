<?php

// use trntv\filekit\widget\Upload;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\widgets\ActiveForm */
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
$this->title = Yii::t('frontend', 'User Settings')
?>

<div class="user-profile-form">
    <?php $form = ActiveForm::begin(); ?>
    <br>
    <div class="row">
    <div class="col-md-6">   
    <h2 style="color: #414141;">Account setup</h2>
    <!--<h2><?php //echo Yii::t('frontend', 'Account Settings') ?></h2>-->
        <?= $form->field($model->getModel('account'), 'username')->textInput(['readOnly' => true]) ?>

        <?= $form->field($model->getModel('account'), 'email')->textInput(['readOnly' => true]) ?>

        <?= $form->field($model->getModel('account'), 'password')->passwordInput() ?>
    
        <?= $form->field($model->getModel('account'), 'password_confirm')->passwordInput() ?>
        <?= $form->field($model->getModel('profile'), 'picture')
                ->widget(FileInput::classname(), [
                    'options' => ['accept' => 'image/*'],
                ])->label("Photo");?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('frontend', 'Update'), ['class' => 'nav-btn']) ?>
        </div>
    </div>
        <div class="col-md-6">
        <h2 style="color: #414141;">Profile Details (click to view and edit it)</h2>
            <ul class="process-label">
                <a href="main"><li class="process-label2 active" id="label-1">Main <span><i class="fa fa-long-arrow-right"></i></span></li></a>
                <a href="questions-n-schedule"><li class="process-label2 active" id="label-2">Questions & Schedule<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                <a href="education-n-driving"><li class="process-label2 active" id="label-3">Education & Driving <span><i class="fa fa-long-arrow-right"></i></span></li></a>
                <a href="housekeeping"><li class="process-label2 active" id="label-4">Housekeeping<span><i class="fa fa-long-arrow-right"></i></span></li></a>
                <a href="about-you"><li class="process-label2 active" id="label-5">About you<span><i class="fa fa-long-arrow-right"></i></span></li></a>
            </ul>
            <div style="text-align: center; margin: 30px 0 0 0;">
            <a href="create-employment"> <span class="nav-btn">Add prev job</span><i class="fa fa-plus-circle nav-mob-btn"></i></a>
            <a href="create-reference"> <span class="nav-btn">Add reference</span><i class="fa fa-plus-circle nav-mob-btn"></i></a>
        </div>
        </div>
    </div>
    
    <h2 style="color: #000;">References</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
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
             
              'template' => '{view_ref} {update_ref}',
                'buttons' => [
                'view_ref' => function ($url, $model) {
                    return Html::a('<span class="fa fa-eye"></span> View', $url, [
                                'title' => Yii::t('app', 'View'),
                                'class'=>'btn btn-primary btn-xs',                                  
                    ]);
                },
                'update_ref' => function ($url, $model) {
                    return Html::a('<span class="fa fa-edit"></span> Update', $url, [
                                'title' => Yii::t('app', 'View'),
                                'class'=>'btn btn-primary btn-xs',                                  
                    ]);
                },
            ],
            ],
        ],
    ]); ?>
     <h2 style="color: #000;">Prev job places</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider1,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'email:ntext',
            'employer_name:ntext',
            'employer_address:ntext',
            // 'to_date:ntext',
            'position_type:ntext',
            // 'number_of_children',
            // 'ages_of_children_started:ntext',
            // 'ages_of_children_left:ntext',
            // 'responsibilities:ntext',
            // 'salary_starting:ntext',
            // 'salary_ending:ntext',
            // 'may_we_contact:ntext',
            // 'contact_phone:ntext',
            // 'contact_email:ntext',
            // 'reason_for_leaving:ntext',
            // 'hours_worked:ntext',
            // 'was_this_a_live_in_position:ntext',
            // 'emloyer_comment:ntext',

            ['class' => 'yii\grid\ActionColumn',
             
              'template' => '{view_emp} {update_emp}',
                'buttons' => [
                'view_emp' => function ($url, $model) {
                    return Html::a('<span class="fa fa-eye"></span> View', $url, [
                                'title' => Yii::t('app', 'View'),
                                'class'=>'btn btn-primary btn-xs',                                  
                    ]);
                },
                'update_emp' => function ($url, $model) {
                    return Html::a('<span class="fa fa-edit"></span> Update', $url, [
                                'title' => Yii::t('app', 'View'),
                                'class'=>'btn btn-primary btn-xs',                                  
                    ]);
                },
            ],
            ],
        ],
    ]); ?>
    <?php ActiveForm::end(); ?>

</div>
