<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

$this->title = Yii::t('frontend', 'Manually Activate My Account');
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

<div class="site-manual-activate">
    
<div class="container" style="margin:70px">

    <form class="form-inline" action="/user/sign-in/manual-activation" method="post">
        <div class="form-group">
            <label for="myEmail" class="sr-only">My Email</label>
            <input type="email" class="form-control" id="myEmail" name="myEmail" placeholder="email">
        </div>
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
        <button type="submit" class="btn btn-primary">Activate My Account</button>
    </form>
</div>
</div>