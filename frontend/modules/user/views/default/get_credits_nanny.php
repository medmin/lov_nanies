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
?>
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-left">
    <h2 style="color: #272727;background-color:yellow" class="text-center">Find Me Great Nanny Job!</h2>
    <p class="lead">NannyCare.com has been helping nannies and babysitters find awesome jobs since 2000. We are committed to raising the bar and making sure that all of our nannies are appreciated, treated respectfully and paid well for their services.</p>
</div>

<p>
Cost: $99.99 (one time fee includes background check & 90 day membership) Only $9.99/month (monthly subscription plan) thereafter if you'd still like to find jobs with us! 
</p>
<p>
    <form action="/pay/nanny/stripe-signup-fee" method="POST">
        <script
          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key= <?= env('STRIPE_PK') ?>
          data-amount="9999"
          data-zip-code="true"
          data-name="NannyCare.com"
          data-description="Nanny SignUp Fee (one time fee)"
          data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
          data-locale="auto">
        </script>
        <input type="hidden" name="plan" value="Nanny SignUp Fee" />
        <input type="hidden" name="money" value=9999 />
        <input type="hidden" name="userid" value=<?=Yii::$app->user->isGuest ? 0 : Yii::$app->user->id; ?> />
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
      </form>
</p>

<p>
<strong style="color:black">Please note: We do not accept anyone with misdemeanors (including DUI's and DWI's), arrests or convictions on their records. If that is you, please do not apply!
</strong></p>

<h2 style="color: #272727;background-color:yellow" class="text-center">Want to continue getting jobs through us?</h2>
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
        <input type="hidden" name="userid" value=<?=Yii::$app->user->isGuest ? 0 : Yii::$app->user->id; ?> />
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
      </form>
</p>


<p>
    <a href="/user/default/index" class="btn btn-primary btn-block">Skip</a>
</p>
