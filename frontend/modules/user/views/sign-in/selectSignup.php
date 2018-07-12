<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\SignupForm */

$this->title = Yii::t('frontend', 'Sign Up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="site-signup"  style="background: #669999; margin:20px 0 0 0;">
        <div class="row row-height" style=" padding: 60px 0 40px 0; margin: 0;">
            <div class="col-lg-12 text-center ">
                <h1>Sign Me Up</h1>
                <ul class="choose-signup">
                    <li>
                        <a href="<?= \yii\helpers\Url::to(['/user/sign-in/family-signup'])?>"><button class="btn btn-primary">I’m a Family</button></a>
                    </li>
                    <li>
                        <a href="<?= \yii\helpers\Url::to(['/user/sign-in/nanny-signup'])?>"><button class="btn btn-primary">I’m a Nanny</button></a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>
<br>