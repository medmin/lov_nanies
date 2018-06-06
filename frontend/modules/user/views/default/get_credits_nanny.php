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
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h2 style="color: #272727;">Find me a Nanny Job!</h2>
    <p class="lead">LovingNannies.com and NannyCare.com have been open for business since 2000. We are the most trustyworthy agency in the greater San Diego area.</p>
</div>

<h3>Cost: $49.99 (one time fee)</h3>
<p>Pay the sign up fee and then we start doing your background check and verifying your references and CPR/Firt Aid.<br />If you have paid, click the button at the bottom to skip this step.</p>
<p>
    <form action="/pay/nanny/stripe-signup-fee" method="POST">
        <script
          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key= <?= env('STRIPE_PK') ?>
          data-amount="4999"
          data-zip-code="true"
          data-name="NannyCare.com"
          data-description="Nanny SignUp Fee (one time fee)"
          data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
          data-locale="auto">
        </script>
        <input type="hidden" name="plan" value="Nanny SignUp Fee" />
        <input type="hidden" name="money" value=4999 />
        <input type="hidden" name="userid" value=<?=Yii::$app->user->isGuest ? 0 : Yii::$app->user->id; ?> />
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
      </form>
</p>
<p>This includes the cost of your background check. After you sign up, you will receive an email link to complete our background check form. You will also get a copy of the background check once it's completed. This is non refundable if your background check comes back with any misdemeanors, arrests or convictions on it.
</p>

<h3>Cost: $9.99 (monthly listing fee)</h3>
<p>Pay the monthly listing fee after we receive your background check and verified your references and CPR/First Aid.</p>
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
<p>This is a monthly subscription fee to be listed on our site. This can be put on hold status or cancelled at any time by the nanny. This will start only after we have received your background check and verified your references and CPR/First Aid. We will then accept you and list your profile on our site.
</p>

<div class="container">
    <p>
        <a href="/user/default/index" class="btn btn-primary btn-block">Skip</a>
    </p>
</div>
