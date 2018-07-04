<?php
/* @var $this yii\web\View */
use yii\web\View;
use yii\helpers\Html;;

$this->title = Yii::t('frontend', 'Get credits');
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

$discount = \common\models\UserDiscount::getCurrentDiscount();
if ($discount === null) {
    // 没有折扣
    $correct_price = 99.99;
} elseif ($discount === 0) {
    // 0 元单
    $correct_price = 0;
} else {
    // 打折
    $correct_price = round(99.99 * $discount / 100, 2);
}
?>
<!--<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-left">
    <h2 style="color: #272727;background-color:#E49A7D" class="text-center">Find Me A Great Nanny Job!</h2>
    <p class="lead">NannyCare.com has been helping nannies and babysitters find awesome jobs since 2000. We are committed to raising the bar and making sure that all of our nannies are appreciated, treated respectfully and paid well for their services.</p>
</div>

<h3>Cost: <?= $discount === null ? '$99.99' : $discount == 0 ? '$'.$correct_price.' (<span style="text-decoration: line-through">$99.99</span>)' : ('$' . $correct_price . ' (<span style="text-decoration: line-through">$99.99</span>)') ?> (one time fee includes background check & 90 day membership)</h3> -->
<p>
<?= Html::img('@web/images/Nanny-Prices-2.png', ['alt'=>'Nanny-Prices-2' , 'style' => "width:100%;" , 'align' => "middle"]) ?>
</p>
<div class="container">
    <div class="row">
        <div class="col-md-6" style="text-align: center;">
            <?php if ($correct_price === (float)0) : ?>
            <form action="/pay/nanny/stripe-signup-fee" method="POST">
                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                <button type="submit" class="stripe-button-el"><span style="display: block; min-height: 30px;">Pay 0 dollar</span></button>
            </form>
            <?php else : ?>
            <form action="/pay/nanny/stripe-signup-fee" method="POST">
                <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key= <?= env('STRIPE_PK') ?>
                data-amount="<?= $correct_price * 100 ?>"
                data-zip-code="true"
                data-name="NannyCare.com"
                data-description="Nanny SignUp Fee (one time fee)"
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                data-locale="auto">
                </script>
                <input type="hidden" name="plan" value="Nanny SignUp Fee" />
                <input type="hidden" name="money" value=<?= $correct_price * 100 ?> />
                <input type="hidden" name="userid" value=<?= Yii::$app->user->id // 删掉 isGuest 是因为支付页面不允许游客访问 ?> />
                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            </form>
            <?php endif; ?>
        </div>
        <div class="col-md-6" style="text-align: center;">
            <form action="/pay/nanny/stripe-listing-fee" method="POST">
                <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key= <?= env('STRIPE_PK') ?>
                data-amount="999"
                data-zip-code="true"
                data-name="NannyCare.com"
                data-description="Listing Fee (Monthly Fee)"
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                data-locale="auto">
                </script>
                <input type="hidden" name="plan" value="Listing Fee (Monthly Fee)" />
                <input type="hidden" name="money" value=999 />
                <input type="hidden" name="userid" value=<?= Yii::$app->user->id ?> />
                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            </form>
        </div>
    </div>
</div>
<hr>
<div class="container" style="text-align: center;">
    <a href="/user/default/index" class="btn btn-primary"><h1>Skip For Now</h1></a>
</div>
