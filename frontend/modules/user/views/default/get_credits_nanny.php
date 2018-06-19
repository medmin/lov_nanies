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
    <p class="lead">NannyCare.com has been helping nannies and babysitters find awesome jobs since 2000. We are committed to raising the bar and making sure that all of our nannies are appreciated, treated respectfully and paid well for their services. </p>
</div>

<h3>$99.99 (one time fee) and $9.99/month listing fee (after FREE 3 month membership expires)
</h3>
<p>Pay the sign up fee and then we start doing your background check and verifying your references and CPR/Firt Aid.<br />If you have paid, click the button at the bottom to skip this step.</p>
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
We charge the nannies a one time sign up fee of $99.99 which includes the cost of their background check. The nanny will get a copy of the background check and be able to use it for any jobs obtained through our site as well as any jobs they find on their own. After you sign up, you will need to click on the background check link in your account area and fill out the quick background check form. Nannies also get a FREE 3 month listing on our site. After the 3 months is over, if you'd still like to find jobs through us, we charge a small monthly listing fee of $9.99. 
</p>
<p>
We feel that paying a small fee is very minimal when you're looking at the possibility of landing a great, high paying job (or jobs if seeking multiple babysitting gigs) with great families through our site. If you have been approved to be listed on our site, then you've past the hardest part and have a great chance of getting a great job through us. 
</p>
<p>
<strong style="color:black">Please note: We do not accept anyone with misdemeanors (including DUI's and DWI's), arrests or convictions on their records. If that is you, please do not apply!
</strong></p>

<p>
You will be charged a one time fee of $99.99 and then after 90 days you will be asked to pay a monthly subscription fee of $9.99/month if you want to continue with us. If you find a job before the 90 days ends, you can put your account on hold or cancel your account at anytime. There are no refunds since our fee goes towards your background check, verifying your references and screening you. We do not make any money off of our nannies. The families pay us a little something to contact you (just like a nanny agency). 
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

<p>
    <a href="/user/default/index" class="btn btn-primary btn-block">Skip</a>
</p>
