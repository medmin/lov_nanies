<?php
/* @var $this yii\web\View */
use yii\web\View;

$this->title = Yii::t('frontend', 'Get Credits');
//这段是干嘛的？原来是最下面的一个“Top”按钮，回到最上面
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
$this->registerCss('
.columns {
  width: 25% !important
}

#container {
  padding-top: 35px
}

');
?>
<div class="columns">
  <ul class="price">
    <li class="header">Job Posting</li>
    <li class="grey"><del> $99 </del>   $0</li>
    <li>90 Days Job Posting</li>
    <li>Reaching qualified nannies with background checks</li>
    <li>Hiding real email addresses</li>
    <li class="grey">
      <form action="/pay/parent/post-only" method="POST">
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
        <input type="hidden" name="money" value=0 />
        <button type="submit" class="stripe-button-el"><span style="display: block; min-height: 30px;">Pay 0 dollar</span></button>
      </form>
    </li>
  </ul>
</div>
<div class="columns">
  <ul class="price">
    <li class="header">1 month</li>
    <li class="grey">$59</li>
    <li>25 credits</li>
    <li>Contact 25  Pre-screened <br />Nannies and Babysitters</li>
    <li>Job Posting Not Included</li>
    <li class="grey">
    <form action="/pay/parent/stripe" method="POST">
        <script
          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key=<?= env('STRIPE_PK') ?>
          data-amount="5900"
          data-zip-code="true"
          data-name="NannyCare.com"
          data-description="1 Month ($59)"
          data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
          data-locale="auto">
        </script>
        <input type="hidden" name="plan" value="<?= \common\models\UserOrder::ParentServicePlans()['basic']?>" />
        <input type="hidden" name="money" value=5900 />
        <input type="hidden" name="credits" value=25 />
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
      </form>
    </li>
  </ul>
</div>
<div class="columns">
  <ul class="price">
    <li class="header" style="background-color: #DD980D;"><!--<span style="display: block;font-size: 20px; line-height: 0;">***Most Popular***</span>-->3 months</li>
    <li class="grey">$149</li>
    <li>100 credits</li>
    <li>Contact 100  Pre-screened <br />Nannies and Babysitters</li>
    <li>Free 3 Month Job Posting </li>
    <li class="grey">
      <form action="/pay/parent/stripe" method="POST">
        <script
          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key=<?= env('STRIPE_PK') ?>
          data-amount="14900"
          data-zip-code="true"
          data-name="NannyCare.com"
          data-description="3 Months ($149)"
          data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
          data-locale="auto">
        </script>
        <input type="hidden" name="plan" value="<?= \common\models\UserOrder::ParentServicePlans()['bronze']?>" />
        <input type="hidden" name="money" value=14900 />
        <input type="hidden" name="credits" value=50 />
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
      </form>
    </li>
  </ul>
</div>
<div class="columns">
  <ul class="price">
    <li class="header">12 months</li>
    <li class="grey">$479</li>
    <li>250 credits</li>
    <li>Contact 250  Pre-screened <br />Nannies and Babysitters</li>
    <li>Free 12 Month Job Posting</li>
    <li class="grey">
      <form action="/pay/parent/stripe" method="POST">
        <script
          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key=<?= env('STRIPE_PK') ?>
          data-amount="47900"
          data-zip-code="true"
          data-name="NannyCare.com"
          data-description="12 Months ($479)"
          data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
          data-locale="auto">
        </script>
        <input type="hidden" name="plan" value="<?= \common\models\UserOrder::ParentServicePlans()['gold']?>" />
        <input type="hidden" name="money" value=47900 />
        <input type="hidden" name="credits" value=250 />
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
      </form>
    </li>
  </ul>
</div>