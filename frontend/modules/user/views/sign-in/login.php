<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\LoginForm */

$this->title = Yii::t('frontend', 'Login');
$this->params['breadcrumbs'][] = $this->title;
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
?>
<div class="site-login">
    <?php if (Yii::$app->session->getFlash('LOGIN_ERROR')) : ?>
        <p class="bg-warning">
            Your account is not activated yet. <br />
            <a href="/user/sign-in/manual-activation">Please click here to activate it!</a>
        </p>
    <?php endif ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'identity') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <div style="color:#999;margin:1em 0">
                    <?= Yii::t('frontend', 'If you forgot your password you can reset it <a href="{link}">here</a>', [
                        'link'=>yii\helpers\Url::to(['sign-in/request-password-reset'])
                    ]) ?>
                </div>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('frontend', 'Login'), ['class' => 'btn btn-inverse', 'name' => 'login-button']) ?>
                </div>
                <div class="form-group">
                    <?= Html::a(Yii::t('frontend', 'Need an account? Sign up.'), ['signup']) ?>
                </div>
                
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
