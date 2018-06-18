<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\SignupForm */

$this->title = Yii::t('frontend', 'Sign Up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1 style="color: #000; margin-top:10px;"><?php echo Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?php echo $form->field($model, 'username') ?>
                <?php echo $form->field($model, 'email') ?>
                <?php echo $form->field($model, 'password')->passwordInput() ?>
                <?php echo $form->field($model, 'type')->hiddenInput(['value'=>$type])->label(false) ?>
                <?php echo $form->field($model, 'password_repeat')->passwordInput() ?>
                <p>
                 <a href="http://manage.lovingnannies.com/includes/LNTermsandConditions2016.pdf" target=_blank>Click here to read the Terms and Conditions and Privacy Policy</a>    
                </p>
                <?php echo $form->field($model, 'legal')->checkbox() ?>
                <div class="form-group">
                    <?php echo Html::submitButton(Yii::t('frontend', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button', 'id'=>'signup-submit-btn']) ?>
                </div>
                <h2><?php //echo Yii::t('frontend', 'Sign up with')  ?>:</h2>
                <div class="form-group">
                    <?php //echo yii\authclient\widgets\AuthChoice::widget([
                        //'baseAuthUrl' => ['/user/sign-in/oauth']
                    //]) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    
</div>
