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
?>
<div class="columns">
  <ul class="price">
    <li class="header">Basic</li>
    <li class="grey">$74.99</li>
    <li>3 credits</li>
    <li>Contact 3 nannies</li>
    <li class="grey">
    <form action="/pay/parent/stripe" method="POST">
        <script
          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key=<?= env('STRIPE_PK') ?>
          data-amount="7499"
          data-zip-code="true"
          data-name="NannyCare.com"
          data-description="Basic Plan (3 credits)"
          data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
          data-locale="auto">
        </script>
        <input type="text" name="plan" value="Basic Plan (6 credits)" />
        <input type="hidden" name="money" value=7499 />
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
      </form>
    </li>
  </ul>
</div>
<div class="columns">
  <ul class="price">
    <li class="header" style="background-color: #DD980D;"><span style="display: block;font-size: 10px; line-height: 0;">Most Popular</span>Bronze</li>
    <li class="grey">$129.99</li>   
    <li>6 credits</li>
    <li>Contact 6 nannies</li>
    <li class="grey">
      <form action="/pay/parent/stripe" method="POST">
        <script
          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key=<?= env('STRIPE_PK') ?>
          data-amount="12999"
          data-zip-code="true"
          data-name="NannyCare.com"
          data-description="Bronze Plan (6 credits)"
          data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
          data-locale="auto">
        </script>
        <input type="text" name="plan" value="Bronze Plan (6 credits)" />
        <input type="hidden" name="money" value=12999 />
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
      </form>
    </li>
  </ul>
</div>
<div class="columns">
  <ul class="price">
    <li class="header">Gold</li>
    <li class="grey">$199.99</li>
    <li>10 credits</li>
    <li>Contact 10 nannies</li>
    <li class="grey">
      <form action="/pay/parent/stripe" method="POST">
        <script
          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key=<?= env('STRIPE_PK') ?>
          data-amount="19999"
          data-zip-code="true"
          data-name="NannyCare.com"
          data-description="Gold Plan (10 credits)"
          data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
          data-locale="auto">
        </script>
        <input type="text" name="plan" value="Gold Plan (10 credits)" />
        <input type="hidden" name="money" value=19999 />
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
      </form>
    </li>
  </ul>
</div>
<div class="columns">
  <ul class="price">
    <li class="header">Platinum</li>
    <li class="grey">$379.99</li>
    <li>20 credits</li>
    <li>Contact 20 nannies</li>
    <li class="grey">
      <form action="/pay/parent/stripe" method="POST">
        <script
          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key= <?= env('STRIPE_PK') ?>
          data-amount="37999"
          data-zip-code="true"
          data-name="NannyCare.com"
          data-description="Platinum Plan (20 credits)"
          data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
          data-locale="auto">
        </script>
        <input type="text" name="plan" value="Platinum Plan (20 credits)" />
        <input type="hidden" name="money" value=37999 />
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
      </form>
    </li>
  </ul>
</div>