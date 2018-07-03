<?php
/* @var $this yii\web\View */
use yii\web\View;

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
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-left">
    <h2 style="color: #272727;background-color:#E49A7D" class="text-center">Find Me A Great Nanny Job!</h2>
    <p class="lead">NannyCare.com has been helping nannies and babysitters find awesome jobs since 2000. We are committed to raising the bar and making sure that all of our nannies are appreciated, treated respectfully and paid well for their services.</p>
</div>

<p>
Cost: <?= $discount === null ? '$99.99' : $discount == 0 ? '$'.$correct_price.' (<span style="text-decoration: line-through">$99.99</span>)' : ('$' . $correct_price . ' (<span style="text-decoration: line-through">$99.99</span>)') ?> (one time fee includes background check & 90 day membership) Only $9.99/month (monthly subscription plan) thereafter if you'd still like to find jobs with us!
</p>
<p>
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
</p>

<p>
<strong style="color:black">Please note: We do not accept anyone with misdemeanors (including DUI's and DWI's), arrests or convictions on their records. If that is you, please do not apply!
</strong></p>

<h2 style="color: #272727;background-color:#E49A7D" class="text-center">Want To Continue Getting Jobs Through Us?</h2>
<h3>Cost: $9.99 (monthly listing fee)</h3>
<p>After your 90 day membership expires, you can opt to remain on our site for just $9.99/month. This is a monthly subscription fee to be listed on our site. This can be put on a “hold status” or cancelled at any time.
</p>
<p>
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
</p>


<p>
    <a href="/user/default/index" class="btn btn-primary btn-block">Skip</a>
</p>
