<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\SignupForm */

$this->title = Yii::t('frontend', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup"  style="background: #6E6460; margin:20px 0 0 0;">
            <div class="row row-height" style=" padding: 60px 0 40px 0; margin: 0;">
                <div class="col-lg-12 text-center ">
                    <h1>I'm signing up as...</h1>
                    <ul class="choose-signup">
                        <li>
                            <form method="get" action="family-signup">
                            <button class="btn ">a parent </button></form>
                        </li>
                        <li>
                            <form method="get" action="nanny-signup">
                            <button class="btn ">a babysitter</button></form>
                        </li>
                    </ul>

                </div>
            </div> 
</div>
<br>
<ul class="process-label">
<li class="process-label2" id="label-1">Proceed to signup <span><i class="fa fa-long-arrow-right"></i></span></li>
</ul>